<?php

/**
 * Class TRP_Query
 *
 * Queries for translations in custom trp tables.
 *
 */
class TRP_Query{

    protected $table_name;
    protected $db;
    protected $settings;
    protected $translation_render;

    const NOT_TRANSLATED = 0;
    const MACHINE_TRANSLATED = 1;
    const HUMAN_REVIEWED = 2;

    const BLOCK_TYPE_REGULAR_STRING = 0;
    const BLOCK_TYPE_ACTIVE = 1;
    const BLOCK_TYPE_DEPRECATED = 2;

    /**
     * TRP_Query constructor.
     * @param $settings
     */
    public function __construct( $settings ){
        global $wpdb;
        $this->db = $wpdb;
        $this->settings = $settings;
    }

    /**
     * Trim unwanted characters from string.
     *
     * @param string $string      String to trim.
     * @return string           Trimmed string.
     */
    protected function full_trim( $string ) {
	    $trp = TRP_Translate_Press::get_trp_instance();
	    if ( ! $this->translation_render ) {
		    $this->translation_render = $trp->get_component( 'translation_render' );
	    }
	    
	    return $this->translation_render->full_trim( $string );
    }

	/**
	 * Return an array of all the active translation blocks
	 *
	 * @param $language_code
	 *
	 * @return array|null|object
	 */
    public function get_all_translation_blocks( $language_code ){
    	$query = "SELECT original, id, block_type, status FROM `" . sanitize_text_field( $this->get_table_name( $language_code ) ) . "` WHERE block_type = " . self::BLOCK_TYPE_ACTIVE . " OR block_type = " . self::BLOCK_TYPE_DEPRECATED;
	    $dictionary = $this->db->get_results( $query, OBJECT_K );
	    return $dictionary;
    }

    /**
     * Returns the translations for the provided strings.
     *
     * Only returns results where there actually is a translation ( != NOT_TRANSLATED )
     *
     * @param array $strings_array      Array of original strings to search for.
     * @param string $language_code     Language code to query for.
     * @return object                   Associative Array of objects with translations where key is original string.
     */
    public function get_existing_translations( $strings_array, $language_code, $block_type = null ){
        if ( !is_array( $strings_array ) || count ( $strings_array ) == 0 ){
            return array();
        }
        if ( $block_type == null ){
	        $and_block_type = "";
        }else {
	        $and_block_type = " AND block_type = " . $block_type;
        }
        $query = "SELECT original,translated FROM `" . sanitize_text_field( $this->get_table_name( $language_code ) ) . "` WHERE status != " . self::NOT_TRANSLATED . $and_block_type . " AND original IN ";

        $placeholders = array();
        $values = array();
        foreach( $strings_array as $string ){
            $placeholders[] = '%s';
            $values[] = $this->full_trim( $string );
        }

        $query .= "( " . implode ( ", ", $placeholders ) . " )";
        $dictionary = $this->db->get_results( $this->db->prepare( $query, $values ), OBJECT_K  );
        return $dictionary;
    }

    /**
     * Return constant used for entries without translations.
     *
     * @return int
     */
    public function get_constant_not_translated(){
        return self::NOT_TRANSLATED;
    }

    /**
     * Return constant used for entries with machine translation.
     *
     * @return int
     */
    public function get_constant_machine_translated(){
        return self::MACHINE_TRANSLATED;
    }

    /**
     * Return constant used for entries edited by humans.
     *
     * @return int
     */
    public function get_constant_human_reviewed(){
        return self::HUMAN_REVIEWED;
    }

	/**
	 * Return constant used for individual strings, not part of a translation block
	 *
	 * @return int
	 */
	public function get_constant_block_type_regular_string(){
		return self::BLOCK_TYPE_REGULAR_STRING;
	}

	/**
	 * Return constant used for a translation block
	 *
	 * @return int
	 */
	public function get_constant_block_type_active(){
		return self::BLOCK_TYPE_ACTIVE;
	}

	/**
	 * Return constant used for a translation block, no longer in use (i.e. after being split )
	 *
	 * @return int
	 */
	public function get_constant_block_type_deprecated(){
		return self::BLOCK_TYPE_DEPRECATED;
	}

	/**
     * Check if table for specific language exists.
     *
     * If the table does not exists it is created.
     *
     * @param string $language_code
     */
    public function check_table( $default_language, $language_code ){
        $table_name = sanitize_text_field( $this->get_table_name( $language_code, $default_language ) );
        if ( $this->db->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
            // table not in database. Create new table
            $charset_collate = $this->db->get_charset_collate();

            $sql = "CREATE TABLE `" . $table_name . "`(
                                    id bigint(20) AUTO_INCREMENT NOT NULL PRIMARY KEY,
                                    original  longtext NOT NULL,
                                    translated  longtext,
                                    status int(20) DEFAULT " . $this::NOT_TRANSLATED .",
                                    block_type int(20) DEFAULT " . $this::BLOCK_TYPE_REGULAR_STRING .",
                                    UNIQUE KEY id (id) )
                                     $charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            $sql_index = "CREATE INDEX index_name ON `" . $table_name . "` (original(100));";
            $this->db->query( $sql_index );

	        //syncronize all translation blocks.
            $this->copy_all_translation_blocks_into_table( $default_language, $language_code );
        }else{
	        $this->check_for_block_type_column( $language_code, $default_language );
        }
    }

    public function copy_all_translation_blocks_into_table( $default_language, $language_code ){
    	$all_table_names = $this->get_all_table_names( $default_language, array( $language_code ) );
    	if ( count( $all_table_names ) > 0 ){
		    $source_table_name = $all_table_names[0];

		    // copy translation blocks from table name of this language
		    $source_language = apply_filters( 'trp_source_language_translation_blocks', '', $default_language, $language_code );
		    if ( $source_language != '' ){
			    $source_table_name = $this->get_table_name( $source_language, $default_language );
		    }

		    $destination_table_name = $this->get_table_name( $language_code, $default_language );

		    // get all tb from $source_table_name and copy to $destination_table_name
		    $sql = 'INSERT INTO `' . $destination_table_name . '` SELECT NULL, original, "", ' . $this::NOT_TRANSLATED . ', block_type FROM `' . $source_table_name . '` WHERE block_type = ' . self::BLOCK_TYPE_ACTIVE . ' OR block_type = ' . self::BLOCK_TYPE_DEPRECATED;
		    $this->db->query( $sql );
	    }
    }

	/**
	 * Check if gettext table for specific language exists.
	 *
	 * If the table does not exists it is created.
	 *
	 * @param string $language_code
	 */
    public function check_gettext_table( $language_code ){
        $table_name = sanitize_text_field( $this->get_gettext_table_name($language_code) );
        if ( $this->db->get_var( "SHOW TABLES LIKE '$table_name'" ) != $table_name ) {
            // table not in database. Create new table
            $charset_collate = $this->db->get_charset_collate();

            $sql = "CREATE TABLE `" . $table_name . "`(
                                    id bigint(20) AUTO_INCREMENT NOT NULL PRIMARY KEY,
                                    original  longtext NOT NULL,
                                    translated  longtext,
                                    domain  longtext,
                                    status int(20),
                                    UNIQUE KEY id (id) )
                                     $charset_collate;";
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta( $sql );

            $sql_index = "CREATE INDEX index_name ON `" . $table_name . "` (original(100));";
            $this->db->query( $sql_index );
        }
    }

	/**
	 * When changing plugin version, call certain database upgrade functions.
	 *
	 */
    public function check_for_necessary_updates(){
        $stored_database_version = get_option('trp_plugin_version');
        if( empty($stored_database_version) || version_compare( TRP_PLUGIN_VERSION, $stored_database_version, '>' ) ){
            $this->check_if_gettext_tables_exist();
            $this->check_for_block_type_column();
        }

        update_option( 'trp_plugin_version', TRP_PLUGIN_VERSION );
    }

	/**
	 * Iterates over all languages to call gettext table checking
	 */
    public function check_if_gettext_tables_exist(){
        if( !empty( $this->settings['translation-languages'] ) ){
            foreach( $this->settings['translation-languages'] as $site_language_code ){
                $this->check_gettext_table($site_language_code);
            }
        }
    }

	/**
	 * Add block_type column to dictionary tables, if it doesn't exist.
	 *
	 * Affects all existing tables, including deactivated languages
	 *
	 * @param null $language_code
	 * @param null $default_language
	 */
    public function check_for_block_type_column( $language_code = null, $default_language = null ){
    	if ( $default_language == null ){
		    $default_language = $this->settings['default-language'];
	    }

    	if ( $language_code ){
    		// check only this language
    		$array_of_table_names = array( $this->get_table_name( $language_code, $default_language ) );
	    }else {
		    // check all languages, including deactivated ones
		    $array_of_table_names = $this->get_all_table_names( $default_language, array() );
	    }

	    foreach( $array_of_table_names as $table_name ){
		    if ( ! $this->table_column_exists( $table_name, 'block_type' ) ) {
			    $this->db->query("ALTER TABLE " . $table_name . " ADD block_type INT(20) DEFAULT " . $this::BLOCK_TYPE_REGULAR_STRING );
		    }
	    }
    }

	/**
	 * Returns true if a database table column exists. Otherwise returns false.
	 *
	 * @link http://stackoverflow.com/a/5943905/2489248
	 * @global wpdb $wpdb
	 *
	 * @param string $table_name Name of table we will check for column existence.
	 * @param string $column_name Name of column we are checking for.
	 *
	 * @return boolean True if column exists. Else returns false.
	 */
	public function table_column_exists( $table_name, $column_name ) {
		$column = $this->db->get_results( $this->db->prepare(
			"SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
			DB_NAME, $table_name, $column_name
		) );
		if ( ! empty( $column ) ) {
			return true;
		}
		return false;
	}

    /**
     * Insert translations and new strings in DB.
     *
     * @param array $new_strings            Array of strings for which we do not have a translation. Only inserts original.
     * @param array $update_strings         Array of arrays, each containing an entry to update.
     * @param string $language_code         Language code of table where it should be inserted.
     */
    public function insert_strings( $new_strings, $update_strings, $language_code, $block_type = self::BLOCK_TYPE_REGULAR_STRING ){
	    if ( $block_type == null ){
		    $block_type = self::BLOCK_TYPE_REGULAR_STRING;
	    }
        if ( count( $new_strings ) == 0 && count( $update_strings ) == 0 ){
            return;
        }
        $query = "INSERT INTO `" . sanitize_text_field( $this->get_table_name( $language_code ) ) . "` ( id, original, translated, status, block_type ) VALUES ";

        $values = array();
        $place_holders = array();
        $new_strings = array_unique( $new_strings );

        foreach ( $new_strings as $string ) {
            array_push( $values, NULL, $string, NULL, self::NOT_TRANSLATED, $block_type );
            $place_holders[] = "( '%d', '%s', '%s', '%d', '%d')";
        }
        foreach ( $update_strings as $string ) {
        	if ( ! isset( $string['block_type'] ) ){
        		$string['block_type'] = self::BLOCK_TYPE_REGULAR_STRING;
	        }
            array_push( $values, $string['id'], $string['original'], $string['translated'], $string['status'], $string['block_type'] );
            $place_holders[] = "( '%d', '%s', '%s', '%d', '%d')";
        }

        $on_duplicate = ' ON DUPLICATE KEY UPDATE translated=VALUES(translated), status=VALUES(status), block_type=VALUES(block_type)';

        $query .= implode(', ', $place_holders);
        $query .= $on_duplicate;

        // you cannot insert multiple rows at once using insert() method.
        // but by using prepare you cannot insert NULL values.
        $this->db->query( $this->db->prepare($query . ' ', $values) );
    }

    public function insert_gettext_strings( $new_strings, $language_code ){
        if ( count( $new_strings ) == 0  ){
            return;
        }
        $query = "INSERT INTO `" . sanitize_text_field( $this->get_gettext_table_name( $language_code ) ) . "` ( id, original, translated, domain, status ) VALUES ";

        $values = array();
        $place_holders = array();

        foreach ( $new_strings as $string ) {
            if( $string['original'] == $string['translated'] || $string['translated'] == '' ){
                $translated = NULL;
                $status = self::NOT_TRANSLATED;
            }
            else{
                $translated = $string['translated'];
                $status = self::HUMAN_REVIEWED;
            }
                
            array_push( $values, NULL, $string['original'], $translated, $string['domain'], $status );
            $place_holders[] = "( '%d', '%s', '%s', '%s', '%d')";
        }



        $query .= implode(', ', $place_holders);
        $this->db->query( $this->db->prepare($query . ' ', $values) );
        
        if( count( $new_strings ) == 1 )
            return $this->db->insert_id;
        else
            return null;
    }

    public function update_gettext_strings( $updated_strings, $language_code ){
        if ( count( $updated_strings ) == 0  ){
            return;
        }
        $query = "INSERT INTO `" . sanitize_text_field( $this->get_gettext_table_name( $language_code ) ) . "` ( id, original, translated, domain, status ) VALUES ";

        $values = array();
        $place_holders = array();

        $status = !empty( $string['status'] ) ? $string['status'] : self::NOT_TRANSLATED;

        foreach ( $updated_strings as $string ) {
            array_push( $values, $string['id'], $string['original'], $string['translated'], $string['domain'], $status );
            $place_holders[] = "( '%d', '%s', '%s', '%s', '%d')";
        }

        $on_duplicate = ' ON DUPLICATE KEY UPDATE translated=VALUES(translated), status=VALUES(status)';

        $query .= implode(', ', $place_holders);
        $query .= $on_duplicate;
        $this->db->query( $this->db->prepare($query . ' ', $values) );
    }

    /**
     * Returns the DB ids of the provided original strings
     *
     * @param array $original_strings       Array of original strings to search for.
     * @param string $language_code         Language code to query for.
     * @return object                       Associative Array of objects with translations where key is original string.
     */
    public function get_string_ids( $original_strings, $language_code, $output = OBJECT_K ){
        if ( !is_array( $original_strings ) || count ( $original_strings ) == 0 ){
            return array();
        }
        $query = "SELECT original,id FROM `" . sanitize_text_field( $this->get_table_name( $language_code ) ) . "` WHERE original IN ";

        $placeholders = array();
        $values = array();
        foreach( $original_strings as $string ){
            $placeholders[] = '%s';
            $values[] = $this->full_trim( $string );
        }

        $query .= "( " . implode ( ", ", $placeholders ) . " )";
        $dictionary = $this->db->get_results( $this->db->prepare( $query, $values ), $output  );
        return $dictionary;
    }

    /**
     * Returns the entries for the provided strings.
     *
     * Only returns results where there is no translation ( == NOT_TRANSLATED )
     *
     * @param array $strings_array      Array of original strings to search for.
     * @param string $language_code     Language code to query for.
     * @return object                   Associative Array of objects with translations where key is original string.
     */
    public function get_untranslated_strings( $strings_array, $language_code ){
        if ( !is_array( $strings_array ) || count ( $strings_array ) == 0 ){
            return array();
        }
        $query = "SELECT original,id FROM `" . sanitize_text_field( $this->get_table_name( $language_code ) ) . "` WHERE status = " . self::NOT_TRANSLATED . " AND original IN ";

        $placeholders = array();
        $values = array();
        foreach( $strings_array as $string ){
            $placeholders[] = '%s';
            $values[] = $this->full_trim( $string );
        }

        $query .= "( " . implode ( ", ", $placeholders ) . " )";
        $dictionary = $this->db->get_results( $this->db->prepare( $query, $values ), OBJECT_K );

        return $dictionary;
    }

    /**
     * Return custom table name for given language code.
     *
     * @param string $language_code         Language code.
     * @param string $default_language      Default language. Defaults to the one from settings.
     * @return string                       Table name.
     */
    protected function get_table_name( $language_code, $default_language = null ){
        if ( $default_language == null ) {
            $default_language = $this->settings['default-language'];
        }
        return $this->db->prefix . 'trp_dictionary_' . strtolower( $default_language ) . '_'. strtolower( $language_code );
    }

    public function get_language_code_from_table_name( $table_name, $default_language = null ){
	    if ( $default_language == null ) {
		    $default_language = $this->settings['default-language'];
	    }
	    $language_code = str_replace($this->db->prefix . 'trp_dictionary_' . strtolower( $default_language ) . '_', '', $table_name );
	    return $language_code;
    }

    public function get_all_gettext_strings(  $language_code ){
        $dictionary = $this->db->get_results( "SELECT id, original, translated, domain FROM `" . sanitize_text_field( $this->get_gettext_table_name( $language_code ) ) . "`", ARRAY_A );

        return $dictionary;
    }

    public function get_all_gettext_translated_strings(  $language_code ){
        $dictionary = $this->db->get_results("SELECT id, original, translated, domain FROM `" . sanitize_text_field( $this->get_gettext_table_name( $language_code ) ) . "` WHERE translated <>'' AND status != " . self::NOT_TRANSLATED, ARRAY_A );

        return $dictionary;
    }

    protected function get_gettext_table_name( $language_code ){
		global $wpdb;
        return $wpdb->get_blog_prefix() . 'trp_gettext_' . strtolower( $language_code );
    }

     /**
     * Return entire rows for given ids or original strings.
     *
     * @param array $id_array           Int array of db ids.
     * @param array $original_array     String array of originals.
     * @param string $language_code     Language code of table.
     * @return object                   Associative Array of objects with translations where key is id.
     */
    public function get_string_rows( $id_array, $original_array, $language_code, $output = OBJECT_K ){

        $select_query = "SELECT id, original, translated, status, block_type FROM `" . sanitize_text_field( $this->get_table_name( $language_code ) ) . "` WHERE ";

        $prepared_query1 = '';
        if ( is_array( $original_array ) && count ( $original_array ) > 0 ) {
            $placeholders = array();
            $values = array();
            foreach ($original_array as $string) {
                $placeholders[] = '%s';
                $values[] = $this->full_trim($string);
            }

            $query1 = "original IN ( " . implode(", ", $placeholders) . " )";
            $prepared_query1 = $this->db->prepare($query1, $values);
        }

        $prepared_query2 = '';
        if ( is_array( $id_array ) && count ( $id_array ) > 0 ) {
            $placeholders = array();
            $values = array();
            foreach ($id_array as $id) {
                $placeholders[] = '%d';
                $values[] = intval($id);
            }

            $query2 = "id IN ( " . implode(", ", $placeholders) . " )";
            $prepared_query2 = $this->db->prepare($query2, $values);
        }


        $query = '';
        if ( empty ( $prepared_query1 ) && empty ( $prepared_query2 ) ){
            return array();
        }
        if ( empty( $prepared_query1 ) ){
            $query = $select_query . $prepared_query2;
        }
        if ( empty( $prepared_query2 ) ){
            $query = $select_query . $prepared_query1;
        }
        if ( !empty ( $prepared_query1 ) && !empty ( $prepared_query2 ) ){
            $query = $select_query . $prepared_query1 . " OR " . $prepared_query2;
        }


        $dictionary = $this->db->get_results( $query, $output );
        return $dictionary;
    }

    public function get_gettext_string_rows_by_ids( $id_array, $language_code ){
        if ( !is_array( $id_array ) || count ( $id_array ) == 0 ){
            return array();
        }
        $query = "SELECT id, original, translated, domain, status  FROM `" . sanitize_text_field( $this->get_gettext_table_name( $language_code ) ) . "` WHERE id IN ";

        $placeholders = array();
        $values = array();
        foreach( $id_array as $id ){
            $placeholders[] = '%d';
            $values[] = intval( $id );
        }

        $query .= "( " . implode ( ", ", $placeholders ) . " )";
        $dictionary = $this->db->get_results( $this->db->prepare( $query, $values ), ARRAY_A );
        return $dictionary;
    }

    public function get_gettext_string_rows_by_original( $original_array, $language_code ){
        if ( !is_array( $original_array ) || count ( $original_array ) == 0 ){
            return array();
        }
        $query = "SELECT id, original, translated, domain, status  FROM `" . sanitize_text_field( $this->get_gettext_table_name( $language_code ) ) . "` WHERE original IN ";

        $placeholders = array();
        $values = array();
        foreach( $original_array as $string ){
            $placeholders[] = '%s';
            $values[] = $this->full_trim( $string );
        }

        $query .= "( " . implode ( ", ", $placeholders ) . " )";
        $dictionary = $this->db->get_results( $this->db->prepare( $query, $values ), ARRAY_A );
        return $dictionary;
    }

    public function get_all_table_names ( $original_language, $exception_translation_languages = array() ){
	    foreach ( $exception_translation_languages as $key => $language ){
		    $exception_translation_languages[$key] = $this->get_table_name( $language, $original_language );
	    }
	    $return_tables = array();
	    $table_name = $this->get_table_name( ''  );
	    $table_names = $this->db->get_results( "SHOW TABLES LIKE '$table_name%'", ARRAY_N );
	    foreach ( $table_names as $table_name ){
	    	if ( isset( $table_name[0]) && ! in_array( $table_name[0], $exception_translation_languages ) ) {
			    $return_tables[] = $table_name[0];
		    }
	    }
	    return $return_tables;
    }

	public function update_translation_blocks_by_original( $table_names, $original_array, $block_type ) {

		$values = array();
		foreach( $table_names as $table_name ){
			$placeholders = array();
			foreach( $original_array as $string ){
				$placeholders[] = '%s';
				$values[] = $this->full_trim( $string );
			}
		}

		$placeholders = "( " . implode ( ", ", $placeholders ) . " )";
		$query = 'UPDATE `' . implode( $table_names, '`, `' ) . '` SET `' . implode( $table_names, '`.block_type=' . $block_type . ', `' ) . '`.block_type=' . $block_type . ' WHERE `' . implode( $table_names, '`.original IN ' . $placeholders . ' AND `' ) . '`.original IN ' . $placeholders ;

		return $this->db->query( $this->db->prepare( $query, $values ) );
	}
}
