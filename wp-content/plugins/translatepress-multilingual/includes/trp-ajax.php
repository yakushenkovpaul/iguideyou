<?php

/**
 * Class TRP_Ajax
 *
 * Custom Ajax to get translation of dynamic elements.
 */
class TRP_Ajax{

    protected $connection;
    protected $table_prefix;

    /**
     * TRP_Ajax constructor.
     *
     * Establishes db connection and triggers function to output translations.
     */
    public function __construct( ){

        if ( !isset( $_POST['action'] ) || $_POST['action'] !== 'trp_get_translations' || empty( $_POST['strings'] ) || empty( $_POST['language'] ) || empty( $_POST['original_language'] ) ) {
            die();
        }

        if ( $this->connect_to_db() ){

            $this->output_translations( $this->sanitize_strings( $_POST['strings'] ), filter_var( $_POST['language'], FILTER_SANITIZE_STRING ), filter_var( $_POST['original_language'], FILTER_SANITIZE_STRING ) );
            //Successful connection to DB
            mysqli_close($this->connection);
        }else{
            //Error connecting to DB
            $this->return_error();

        }

    }

    /**
     * Sanitize posted strings.
     *
     * @param array $posted_strings     Array of strings.
     * @return array                    Sanitized array of strings.
     */
    protected function sanitize_strings( $posted_strings){
        $strings = json_decode( $posted_strings );
        $original_array = array();
        if ( is_array( $strings ) ) {
            foreach ($strings as $key => $string) {
                if ( isset($string->original ) ) {
                    $original_array[$key] = filter_var( $string->original, FILTER_SANITIZE_STRING );
                }
            }
        }
        return $original_array;
    }

    /**
     * Finds db credentials in wp-config file and tries to connect to db.
     *
     * @return bool     Whether connection was succesful or not.
     */
    protected function connect_to_db(){

        $file = dirname(dirname(dirname(dirname(dirname(__FILE__))))) . '/wp-config.php';

        try {
            $content = @file_get_contents($file);
            if ($content == false) {
                return false;
            }
        } catch (Exception $e) {
            return false;
        }


        // remove single line and multi-line /* Comments */
        $content = preg_replace('!/\*.*?\*/!s', '', $content);
        $content = preg_replace('/\n\s*\n/', "\n", $content);

        // remove single line double slashes
        $content = preg_replace('#^\s*//.+$#m', "", $content);

        $credentials = array(
            'db_name'       => 'DB_NAME',
            'db_user'       => 'DB_USER',
            'db_password'   => 'DB_PASSWORD',
            'db_host'       => 'DB_HOST',
            'db_charset'    => 'DB_CHARSET'
        );

        foreach ( $credentials as $credential => $constant_name ) {
            if ( preg_match_all( "/define\s*\(\s*['\"]" . $constant_name . "['\"]\s*,\s*['\"](.*?)['\"]\s*\)/", $content, $result ) ) {
                $credentials[ $credential ] = $result[1][0];
            } else {
                return false;
            }
        }


        $this->connection = mysqli_connect( $credentials['db_host'], $credentials['db_user'], $credentials['db_password'], $credentials['db_name'] );
        mysqli_set_charset ( $this->connection , $credentials['db_charset'] );

        // Check connection
        if ( mysqli_connect_errno() ) {
            //Failed to connect to MySQL.
            return false;
        }

        if ( preg_match_all( '/\$table_prefix\s*=\s*[\'"](.*?)[\'"]/', $content, $results ) ) {
            $this->table_prefix = end( $results[1] );
        }else{
            $this->table_prefix = $this->sql_find_table_prefix();
            if ( $this->table_prefix === false ){
                return false;
            }
        }

        return true;
    }

    /**
     * Get WP table prefix.
     *
     * @return string       Table prefix.
     */
    protected function sql_find_table_prefix(){
        $sql = "SELECT DISTINCT SUBSTRING(`TABLE_NAME` FROM 1 FOR ( LENGTH(`TABLE_NAME`)-8 ) ) as prefix FROM information_schema.TABLES WHERE `TABLE_NAME` LIKE '%postmeta'";
        $result = mysqli_query( $this->connection, $sql );
        if ( mysqli_num_rows( $result ) > 0 ) {
            $result_object = mysqli_fetch_assoc($result);
            return $result_object['prefix'];
        } else {
            return false;
        }
    }

    /**
     * Trim strings.
     *
     * @param string $word      String to trim.
     * @return string           Trimmed string.
     */
    protected function full_trim( $word ) {
        return trim( $word," \t\n\r\0\x0B\xA0�" );
    }

    /**
     * Output translation for given strings.
     *
     * @param array $strings            Array of string to translate.
     * @param string $language          Language to translate into.
     * @param string $original_language Language to translate from. Default language.
     */
    protected function output_translations( $strings, $language, $original_language ){
        $sql = 'SELECT original, translated FROM ' . $this->table_prefix . 'trp_dictionary_' . strtolower( $original_language ) . '_' . strtolower( $language ) . ' WHERE original IN (\'' . implode( "','", array_map( array( $this, 'full_trim' ), $strings ) ).'\') AND status != 0';
        $result = mysqli_query( $this->connection, $sql );
        if ( $result === false ){
            $this->return_error();
        }else {
            $dictionaries[$language] = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $dictionaries[$language][] = $row;
            }

            echo json_encode($dictionaries);
        }

    }

    /**
     * Return error in case of connection fail and other problems.
     */
    protected function return_error(){
        echo json_encode( 'error' );
        exit;
    }
}

new TRP_Ajax;

die();

