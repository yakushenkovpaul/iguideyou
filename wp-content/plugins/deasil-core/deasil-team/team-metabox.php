<?php

if(!function_exists('deasil_meta_box_team_member')) {
    /*Add Meta box Deasil Team Member Detail for Team Post - Admin*/
    function deasil_meta_box_team_member(){
    	add_meta_box( 'deasil_team_detail_box', 
    		esc_html__('Team Member Detail', 'deasil-core'), 
    		'deasil_meta_box_team_detail', 
    		'deasil_team', 
    		'side', 
    		'low' ); 
    }
    add_action( 'add_meta_boxes', 'deasil_meta_box_team_member' );


    function deasil_meta_box_team_detail($post){
        // $post is already set, and contains an object: the WordPress post
        global $post;
        $values = get_post_custom( $post->ID );

        $language = empty( $values['deasil_team_language'] ) ? '' : esc_attr( $values['deasil_team_language'][0] );
        $location = empty( $values['deasil_team_location'] ) ? '' : esc_attr( $values['deasil_team_location'][0] );
        $email = empty( $values['deasil_team_email'] ) ? '' : esc_attr( $values['deasil_team_email'][0] );

        $twitter = empty( $values['deasil_team_twitter'] ) ? '' : esc_attr( $values['deasil_team_twitter'][0] );
        $facebook = empty( $values['deasil_team_facebook'] ) ? '' : esc_attr( $values['deasil_team_facebook'][0] );
        $google = empty( $values['deasil_team_google'] ) ? '' : esc_attr( $values['deasil_team_google'][0] );
        $linkedin = empty( $values['deasil_team_linkedin'] ) ? '' : esc_attr( $values['deasil_team_linkedin'][0] );
        $instagram = empty( $values['deasil_team_instagram'] ) ? '' : esc_attr( $values['deasil_team_instagram'][0] );

        // We'll use this nonce field later on when saving.
        wp_nonce_field( 'deasil_team_nonce_action', 'deasil_team_nonce' );
        ?>
        <div class="meta-box">
            <p>
                <label for="deasil_team_language"><?php esc_html_e('Language', 'deasil-core');?></label>
                <br>
                <textarea name="deasil_team_language" id="deasil_team_language"><?php echo esc_html($language); ?></textarea>
            </p>
            <hr>
            <p>
                <label for="deasil_team_location"><?php esc_html_e('Location', 'deasil-core');?></label>
                <br>
                <textarea name="deasil_team_location" id="deasil_team_location"><?php echo esc_html($location); ?></textarea>
            </p>
            <hr>
            <p>
                <label for="deasil_team_email"><?php esc_html_e('Email', 'deasil-core');?></label>
                <br>
                <input type="email" name="deasil_team_email" id="deasil_team_email" value="<?php echo esc_attr($email); ?>" />
            </p>
            <hr>

            <div class="meta-team">
                <p>
                    <label for="deasil_team_twitter"><span class="fa fa-twitter"></span></label>
                    <input type="text" name="deasil_team_twitter" id="deasil_team_twitter" value="<?php echo esc_attr($twitter); ?>" />
                </p>

                <p>
                    <label for="deasil_team_facebook"><span class="fa fa-facebook"></span></label>
                    <input type="text" name="deasil_team_facebook" id="deasil_team_facebook" value="<?php echo esc_attr($facebook); ?>" />
                </p>

                <p>
                    <label for="deasil_team_google"><span class="fa fa-google"></span></label>
                    <input type="text" name="deasil_team_google" id="deasil_team_google" value="<?php echo esc_attr($google); ?>" />
                </p>

                <p>
                    <label for="deasil_team_linkedin"><span class="fa fa-linkedin"></span></label>
                    <input type="text" name="deasil_team_linkedin" id="deasil_team_linkedin" value="<?php echo esc_attr($linkedin); ?>" />
                </p>

                <p>
                    <label for="deasil_team_instagram"><span class="fa fa-instagram"></span></label>
                    <input type="text" name="deasil_team_instagram" id="deasil_team_instagram" value="<?php echo esc_attr($instagram); ?>" />
                </p>
            </div>
        </div>
    <?php 
    }
}


if(!function_exists('deasil_meta_box_team_detail_save')) {
    /*Save Team Metadata to database*/
    function deasil_meta_box_team_detail_save( $post_id )
    {   
        // Bail if we're doing an auto save
        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

        // if our nonce isn't there, or we can't verify it, bail
        if( !isset( $_POST['deasil_team_nonce'] ) || !wp_verify_nonce( $_POST['deasil_team_nonce'], 'deasil_team_nonce_action' ) ) return;
        if( !current_user_can( 'edit_post', $_POST['post_ID'] ) )
            return;

        // now we can actually save the data
        $allowed = array( 
            'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
            )
        );

        if( isset( $_POST['deasil_team_language'] ) )
            update_post_meta( $post_id, 'deasil_team_language', wp_kses( $_POST['deasil_team_language'], $allowed  ) );
        if( isset( $_POST['deasil_team_location'] ) )
            update_post_meta( $post_id, 'deasil_team_location', wp_kses( $_POST['deasil_team_location'], $allowed  ) );
        if( isset( $_POST['deasil_team_email'] ) )
            update_post_meta( $post_id, 'deasil_team_email', wp_kses( $_POST['deasil_team_email'], $allowed  ) );

        if( isset( $_POST['deasil_team_twitter'] ) )
            update_post_meta( $post_id, 'deasil_team_twitter', wp_kses( $_POST['deasil_team_twitter'], $allowed ) );
        if( isset( $_POST['deasil_team_facebook'] ) )
            update_post_meta( $post_id, 'deasil_team_facebook', wp_kses( $_POST['deasil_team_facebook'], $allowed ) );
        if( isset( $_POST['deasil_team_google'] ) )
            update_post_meta( $post_id, 'deasil_team_google', wp_kses( $_POST['deasil_team_google'], $allowed ) );
        if( isset( $_POST['deasil_team_linkedin'] ) )
            update_post_meta( $post_id, 'deasil_team_linkedin', wp_kses( $_POST['deasil_team_linkedin'], $allowed ) );
        if( isset( $_POST['deasil_team_instagram'] ) )
            update_post_meta( $post_id, 'deasil_team_instagram', wp_kses( $_POST['deasil_team_instagram'], $allowed ) );
    }
    add_action( 'save_post', 'deasil_meta_box_team_detail_save' );
}