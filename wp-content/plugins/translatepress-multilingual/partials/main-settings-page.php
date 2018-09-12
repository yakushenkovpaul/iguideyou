
<div id="trp-main-settings" class="wrap">
    <form method="post" action="options.php">
        <?php settings_fields( 'trp_settings' ); ?>
        <h1> <?php _e( 'TranslatePress Settings', 'translatepress-multilingual' );?></h1>
        <?php do_action ( 'trp_settings_navigation_tabs' ); ?>

        <table id="trp-options" class="form-table">
            <tr>
                <th scope="row"><?php _e( 'Default Language', 'translatepress-multilingual' ); ?> </th>
                <td>
                    <select id="trp-default-language" name="trp_settings[default-language]" class="trp-select2">
                        <?php
                        foreach( $languages as $language_code => $language_name ){ ?>
                            <option value="<?php echo $language_code; ?>" <?php echo ( $this->settings['default-language'] == $language_code ? 'selected' : '' ); ?> >
                                <?php echo $language_name; ?>
                            </option>
                        <?php }?>
                    </select>
                    <p class="description">
                        <?php _e( 'Select the original language your website was written in. ', 'translatepress-multilingual' ); ?>
                    </p>

                    <p class="warning" style="display: none;" >
                        <?php _e( 'WARNING. Changing the default language will invalidate existing translations.', 'translatepress-multilingual' ); ?><br/>
                        <?php _e( 'Even changing from en_US to en_GB, because they are treated as two different languages.', 'translatepress-multilingual' ); ?><br/>
                        <?php _e( 'In most cases changing the default flag is all it is needed: ', 'translatepress-multilingual' ); ?>
                        <a href="https://translatepress.com/docs/developers/replace-default-flags/"><?php _e( 'replace the default flag', 'translatepress-multilingual' ); ?></a>
                    </p>

                </td>
            </tr>

            <?php do_action( 'trp_language_selector', $languages ); ?>

            <tr>
                <th scope="row"><?php _e( 'Native language name', 'translatepress-multilingual' ); ?> </th>
                <td>
                    <select id="trp-g-translate" name="trp_settings[native_or_english_name]" class="trp-select">
                        <option value="english_name" <?php selected( $this->settings['native_or_english_name'], 'english_name' ); ?>><?php _e( 'No', 'translatepress-multilingual') ?></option>
                        <option value="native_name" <?php selected( $this->settings['native_or_english_name'], 'native_name' ); ?>><?php _e( 'Yes', 'translatepress-multilingual') ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Select Yes if you want languages to display in their native names. Otherwise, they will be displayed in English.', 'translatepress-multilingual' ); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php _e( 'Use subdirectory for default language', 'translatepress-multilingual' ); ?> </th>
                <td>
                    <select id="trp-g-translate" name="trp_settings[add-subdirectory-to-default-language]" class="trp-select">
                        <option value="no" <?php selected( $this->settings['add-subdirectory-to-default-language'], 'no' ); ?>><?php _e( 'No', 'translatepress-multilingual') ?></option>
                        <option value="yes" <?php selected( $this->settings['add-subdirectory-to-default-language'], 'yes' ); ?>><?php _e( 'Yes', 'translatepress-multilingual') ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Select Yes if you want to add the subdirectory in the url for the default language.</br>By selecting Yes, the default language seen by website visitors will become the first one in the "All Languages" list.', 'translatepress-multilingual' ); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php _e( 'Force language in custom links', 'translatepress-multilingual' ); ?> </th>
                <td>
                    <select id="trp-g-translate" name="trp_settings[force-language-to-custom-links]" class="trp-select">
                        <option value="no" <?php selected( $this->settings['force-language-to-custom-links'], 'no' ); ?>><?php _e( 'No', 'translatepress-multilingual') ?></option>
                        <option value="yes" <?php selected( $this->settings['force-language-to-custom-links'], 'yes' ); ?>><?php _e( 'Yes', 'translatepress-multilingual') ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Select Yes if you want to force custom links without language encoding to keep the currently selected language.', 'translatepress-multilingual' ); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php _e( 'Google Translate', 'translatepress-multilingual' ); ?> </th>
                <td>
                    <select id="trp-g-translate" name="trp_settings[g-translate]" class="trp-select">
                        <option value="no" <?php selected( $this->settings['g-translate'], 'no' ); ?>><?php _e( 'No', 'translatepress-multilingual') ?></option>
                        <option value="yes" <?php selected( $this->settings['g-translate'], 'yes' ); ?>><?php _e( 'Yes', 'translatepress-multilingual') ?></option>
                    </select>
                    <p class="description">
                        <?php _e( 'Enable or disable the automatic translation of the site with Google Translate. Only untranslated strings will receive a translation.<br>You can later edit these automatic translations.<br>Note: Not all languages support automatic translation. Please consult the <a href="https://cloud.google.com/translate/docs/languages" target="_blank" title="Automatic translation supported languages.">supported languages list</a>. ', 'translatepress-multilingual' ); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row"><?php _e( 'Google Translate API Key', 'translatepress-multilingual' ); ?> </th>
                <td>
                    <input type="text" id="trp-g-translate-key" class="trp-text-input" name="trp_settings[g-translate-key]" value="<?php if( !empty( $this->settings['g-translate-key'] ) ) echo esc_attr( $this->settings['g-translate-key']);?>"/>
                    <?php if( !empty( $this->settings['g-translate-key'] ) ) echo '<a href="'.admin_url( 'admin.php?page=trp_test_google_key_page' ).'">'.__( "Test api key.", 'translatepress-multilingual' );'.</a>'; ?>
                    <p class="description">
                        <?php _e( 'Visit this <a href="https://support.google.com/cloud/answer/6158862" target="_blank">link</a> to see how you can set up an API key. ', 'translatepress-multilingual' ); ?>
                    </p>
                </td>

            </tr>

            <tr>
                <th scope="row"><?php _e( 'Language Switcher', 'translatepress-multilingual' ); ?> </th>
                <td>
                    <div class="trp-ls-type">
                        <input type="checkbox" disabled checked id="trp-ls-shortcode" ><b><?php _e( 'Shortcode ', 'translatepress-multilingual' ); ?>[language-switcher] </b>
                        <div>
                            <?php $this->output_language_switcher_select( 'shortcode-options', $this->settings['shortcode-options'] ); ?>
                        </div>
                        <p class="description">
                            <?php _e( 'Use shortcode on any page or widget.', 'translatepress-multilingual' ); ?>
                        </p>
                    </div>
                    <div class="trp-ls-type">
                        <label><input type="checkbox" id="trp-ls-menu" disabled checked ><b><?php _e( 'Menu item', 'translatepress-multilingual' ); ?></b></label>
                        <div>
                            <?php $this->output_language_switcher_select( 'menu-options', $this->settings['menu-options'] ); ?>
                        </div>
                        <p class="description">
                            <?php
                            $link_start = '<a href="' . admin_url( 'nav-menus.php' ) .'">';
                            $link_end = '</a>';
                            printf(__( 'Go to  %1$s Appearance -> Menus%2$s to add Language Switcher Languages in any menu.', 'translatepress-multilingual' ), $link_start, $link_end ); ?>
                            <a href="https://translatepress.com/docs/settings/#language-switcher"><?php _e( 'Learn more in our documentation.', 'translatepress-multilingual' ); ?></a>
                        </p>
                    </div>
                    <div class="trp-ls-type">
                        <label><input type="checkbox" id="trp-ls-floater" name="trp_settings[trp-ls-floater]"  value="yes"  <?php if ( isset($this->settings['trp-ls-floater']) && ( $this->settings['trp-ls-floater'] == 'yes' ) ){ echo 'checked'; }  ?>><b><?php _e( 'Floating language selection', 'translatepress-multilingual' ); ?></b></label>
                        <div>
                            <?php $this->output_language_switcher_select( 'floater-options', $this->settings['floater-options'] ); ?>
                        </div>
                        <p class="description">
                            <?php _e( 'Have a floating dropdown following the user on every page.', 'translatepress-multilingual' ); ?>
                        </p>
                    </div>
                </td>
            </tr>

            <?php do_action ( 'trp_extra_settings', $this->settings ); ?>
        </table>

        <p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes' ); ?>" /></p>
    </form>
</div>
