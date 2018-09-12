<?php
$current_language_preference = $this->add_shortcode_preferences($shortcode_settings, $current_language['code'], $current_language['name']);

?>
<div class="trp-language-switcher" data-no-translation <?php echo ( isset( $_GET['trp-edit-translation'] ) && $_GET['trp-edit-translation'] == 'preview' ) ? 'data-trp-unpreviewable="trp-unpreviewable"' : '' ?>>
    <script type="application/javascript">
        jQuery( document ).ready(function(){
            // need to have the same with set from JS on both divs. Otherwise it can push stuff around in HTML
            jQuery('.trp-language-switcher').each(function(index, el){
                var trp_ls_shortcode_width = jQuery(el).find('.trp-ls-shortcode-language').width() + 5;
                jQuery(el).find('.trp-ls-shortcode-language').width(trp_ls_shortcode_width);
                jQuery(el).find('.trp-ls-shortcode-current-language').width(trp_ls_shortcode_width);
                // We're putting this on display: none after we have it's width.
                jQuery(el).find('.trp-ls-shortcode-language').hide();
            })
        })
    </script>
    <div class="trp-ls-shortcode-current-language">
        <a href="javascript:void(0)" class="trp-ls-shortcode-disabled-language" title="<?php echo $current_language['name'] ?>"><?php echo $current_language_preference ?></a>
    </div>
    <div class="trp-ls-shortcode-language">
        <a href="javascript:void(0)" class="trp-ls-shortcode-disabled-language"  title="<?php echo $current_language['name'] ?>"><?php echo $current_language_preference ?></a>
    <?php foreach ( $other_languages as $code => $name ){

        $language_preference = $this->add_shortcode_preferences($shortcode_settings, $code, $name);
        ?>
        <a href="<?php echo $this->url_converter->get_url_for_language($code, false); ?>" title="<?php echo $name; ?>">
            <?php echo $language_preference?>
        </a>

    <?php } ?>
    </div>
</div>