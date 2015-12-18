<?php
/*
Plugin Name: BetterLoginScreen
Version: 0.1-alpha
Description: Provides a way to customize the WP-login screen
Author: Ben Redden
Author URI: http://www.countryfriedcoders.me
Plugin URI: http://www.countryfriedcoders.me
Text Domain: betterLoginScreen
Domain Path: /languages
*/

// add actions
add_action( 'admin_init', 'bls_settings_init' );
add_action( 'admin_menu', 'bls_add_settings_page' );

// set up the settings page
function bls_settings_init(){
    register_setting( 'bls_settings', 'blsLogo' );
    register_setting( 'bls_settings', 'blsBackground' );
    register_setting( 'bls_settings', 'blsButtonStyle' );
}

// add settings page to menu
function bls_add_settings_page() {
    add_menu_page( __( 'Better Login Screen Settings' ), __( 'Better Login Screen Settings' ), 'manage_options', 'bls_settings', 'bls_settings_page');
}

// enqueue jQuery and the media uploader stuff
wp_enqueue_script('jquery');
// This will enqueue the Media Uploader script
function load_wp_media_files() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

// start settings page
function bls_settings_page() {
    wp_enqueue_style( 'theme-styles',plugins_url('/style/styles.css',__FILE__ ));
if ( ! isset( $_REQUEST['updated'] ) )
    $_REQUEST['updated'] = false;
?>

<h2 id="title"><?php _e( 'Better Login Screen Settings' ) ?></h2>

<?php
// show saved options message
if ( false !== $_REQUEST['updated'] ) : ?>
    <div><p><strong><?php _e( 'Options saved. Good job!' ); ?></strong></p></div>
<?php endif; ?>
<style>
    /* Buzz */
    @-webkit-keyframes hvr-buzz {
        50% {
            -webkit-transform: translateX(3px) rotate(2deg);
            transform: translateX(3px) rotate(2deg);
        }

        100% {
            -webkit-transform: translateX(-3px) rotate(-2deg);
            transform: translateX(-3px) rotate(-2deg);
        }
    }

    @keyframes hvr-buzz {
        50% {
            -webkit-transform: translateX(3px) rotate(2deg);
            transform: translateX(3px) rotate(2deg);
        }

        100% {
            -webkit-transform: translateX(-3px) rotate(-2deg);
            transform: translateX(-3px) rotate(-2deg);
        }
    }

    .buttonStyle div {
        display: block;
        margin: 2% 0;
    }
    .buttonStyle div button {
        display: block;
        height: 60px;
        width: 200px;
    }
    .buttonStyle div .button1 {
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: box-shadow, transform;
        transition-property: box-shadow, transform;
    }
    .buttonStyle div .button1:hover {
        box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.5);
        -webkit-transform: scale(1.1);
        transform: scale(1.1);
    }
    .buttonStyle div .button2 {
        background: #e1e1e1;
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
        -webkit-transition-duration: 0.3s;
        transition-duration: 0.3s;
        -webkit-transition-property: box-shadow;
        transition-property: box-shadow;
        box-shadow: inset 0 0 0 4px #e1e1e1, 0 0 1px rgba(0, 0, 0, 0);
    }
    .buttonStyle div .button2:hover {
        box-shadow: inset 0 0 0 4px #2098d1, 0 0 1px rgba(0, 0, 0, 0);
    }
    .buttonStyle div .button3 {
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
    }
    .buttonStyle div .button3:hover {
        -webkit-animation-name: hvr-buzz;
        animation-name: hvr-buzz;
        -webkit-animation-duration: 0.15s;
        animation-duration: 0.15s;
        -webkit-animation-timing-function: linear;
        animation-timing-function: linear;
        -webkit-animation-iteration-count: infinite;
        animation-iteration-count: infinite;
    }
    .buttonStyle div .button4 {
        vertical-align: middle;
        -webkit-transform: translateZ(0);
        transform: translateZ(0);
        box-shadow: 0 0 1px rgba(0, 0, 0, 0);
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        -moz-osx-font-smoothing: grayscale;
        -webkit-transition-duration: 0.5s;
        transition-duration: 0.5s;
    }
    .buttonStyle div .button4:hover {
        -webkit-transform: scale(0.8);
        transform: scale(0.8);
        -webkit-transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
        transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
    }
</style>
<form method="post" action="options.php">

    <?php global $blsOptions; settings_fields( 'bls_settings' ); ?>
    <?php get_option( 'bls_settings' ); do_settings_sections( 'bls_settings' ); ?>

    <div class="general">
      <fieldset class="logo">
        <p>
            <?php
            if ( get_option( 'blsLogo' ) )
            {
                    echo '<h2>Logo Preview</h2>';
                    echo '<img class="blsLogo" style="max-width: 300px;" src="' . get_option( 'blsLogo' ) . '">';
            }
            ?>
        </p>
        <div>
            <label for="blsLogo">Logo (will replace WordPress logo)</label>
            <input type="text" name="blsLogo" id="blsLogo" value="<?php echo get_option('blsLogo'); ?>">
            <input type="button" name="upload-btn" id="upload-logo" class="button-secondary" value="Upload Logo">

        </div>
        <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#upload-logo').click(function(e) {
                e.preventDefault();
                var image = wp.media({
                    title: 'Upload Image',
                    // mutiple: true if you want to upload multiple files at once
                    multiple: false
                }).open()
                .on('select', function(e){
                    // This will return the selected image from the Media Uploader, the result is an object
                    var uploaded_image = image.state().get('selection').first();
                    // We convert uploaded_image to a JSON object to make accessing it easier
                    // Output to the console uploaded_image
                    console.log(uploaded_image);
                    var image_url = uploaded_image.toJSON().url;
                    // Let's assign the url value to the input field
                    jQuery('#blsLogo').val(image_url);
                    // change the preview too
                    jQuery( '.blsLogo' ).attr( 'src', image_url );
                });
            });
        });
        </script>
      </fieldset>
      <fieldset class="background">
        <p>
            <?php
            if ( get_option( 'blsBackground' ) )
            {
                    echo '<h2>Background Preview</h2>';
                    echo '<img class="blsBackground" style="max-width:300px;" src="' . get_option( 'blsBackground' ) . '">';
            }
            ?>
        </p>
        <div>
            <label for="blsBackground">Background</label>
            <input type="text" name="blsBackground" id="blsBackground" value="<?php echo get_option('blsBackground'); ?>">
            <input type="button" name="upload-btn" id="upload-background" class="button-secondary" value="Upload Background">
        </div>
        <script type="text/javascript">
        jQuery(document).ready(function(){
            jQuery('#upload-background').click(function(e) {
                e.preventDefault();
                var image = wp.media({
                    title: 'Upload Image',
                    // mutiple: true if you want to upload multiple files at once
                    multiple: false
                }).open()
                .on('select', function(e){
                    // This will return the selected image from the Media Uploader, the result is an object
                    var uploaded_image = image.state().get('selection').first();
                    // We convert uploaded_image to a JSON object to make accessing it easier
                    // Output to the console uploaded_image
                    console.log(uploaded_image);
                    var image_url = uploaded_image.toJSON().url;
                    // Let's assign the url value to the input field
                    jQuery('#blsBackground').val(image_url);
                    // change the preview too
                    jQuery( '.blsBackground' ).attr( 'src', image_url );
                });
            });
        });
        </script>
      </fieldset>
      <fieldset class="buttonStyle">
          <p>
              <h2>Button Style</h2>
              <div><button type="button" class="button1">I'm a button</button><input <?php if( get_option( 'blsButtonStyle' ) == 'button1') echo 'checked="checked"'; ?> type="radio" name="blsButtonStyle" id="button1" value="button1"><label for="button1">Button Style 1</label></div>
              <div><button type="button" class="button2">I'm a button</button><input <?php if( get_option( 'blsButtonStyle' ) == 'button2') echo 'checked="checked"'; ?> type="radio" name="blsButtonStyle" id="button2" value="button2"><label for="button2">Button Style 2</label></div>
              <div><button type="button" class="button3">I'm a button</button><input <?php if( get_option( 'blsButtonStyle' ) == 'button3') echo 'checked="checked"'; ?> type="radio" name="blsButtonStyle" id="button3" value="button3"><label for="button3">Button Style 3</label></div>
              <div><button type="button" class="button4">I'm a button</button><input <?php if( get_option( 'blsButtonStyle' ) == 'button4') echo 'checked="checked"'; ?> type="radio" name="blsButtonStyle" id="button4" value="button4"><label for="button4">Button Style 4</label></div>
          </p>
      </fieldset>
    </div><!--.general-->

    <p><?php submit_button(); ?></p>
</form>
<?php
}

// replace the WP Login logo
function bls_loginLogo() { ?>
    <style type="text/css">
        .login h1 a {
            background-image: url( '<?php echo get_option( 'blsLogo' );  ?>' );
            padding-bottom: 30px;
            background-size: 280px;
            height: 280px;
            width: auto;
        }
        html {
            background: url( '<?php echo get_option( 'blsBackground' ) ?>' );
            background-size: cover;
            background-repeat: no-repeat;
        }
        body {
            background: transparent;
        }
        /* change css depending on which button was chosen */
        <?php
        if( get_option( 'blsButtonStyle' ) == 'button1')
        {
        ?>
        .submit #wp-submit {
            display: inline-block;
            vertical-align: middle;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -moz-osx-font-smoothing: grayscale;
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-transition-property: box-shadow, transform;
            transition-property: box-shadow, transform;
        }
        .submit #wp-submit:hover, .submit #wp-submit:focus, .submit #wp-submit:active {
            box-shadow: 0 10px 10px -10px rgba(0, 0, 0, 0.5);
            -webkit-transform: scale(1.1);
            transform: scale(1.1);
        }
        <?php
        }
        ?>
        <?php
        if( get_option( 'blsButtonStyle' ) == 'button2')
        {
        ?>

        .submit #wp-submit {
            background: #e1e1e1;
            vertical-align: middle;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -moz-osx-font-smoothing: grayscale;
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
            -webkit-transition-property: box-shadow;
            transition-property: box-shadow;
            box-shadow: inset 0 0 0 4px #e1e1e1, 0 0 1px rgba(0, 0, 0, 0);
        }

        .submit #wp-submit:hover, .submit #wp-submit:focus, .submit #wp-submit:active {
            box-shadow: inset 0 0 0 4px #2098d1, 0 0 1px rgba(0, 0, 0, 0);
        }

        <?php
        }
        ?>
        <?php
        if( get_option( 'blsButtonStyle' ) == 'button3')
        {
        ?>
        /* Buzz */
        @-webkit-keyframes hvr-buzz {
            50% {
                -webkit-transform: translateX(3px) rotate(2deg);
                transform: translateX(3px) rotate(2deg);
            }

            100% {
                -webkit-transform: translateX(-3px) rotate(-2deg);
                transform: translateX(-3px) rotate(-2deg);
            }
        }

        @keyframes hvr-buzz {
            50% {
                -webkit-transform: translateX(3px) rotate(2deg);
                transform: translateX(3px) rotate(2deg);
            }

            100% {
                -webkit-transform: translateX(-3px) rotate(-2deg);
                transform: translateX(-3px) rotate(-2deg);
            }
        }

        .submit #wp-submit {
            vertical-align: middle;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -moz-osx-font-smoothing: grayscale;
        }

        .submit #wp-submit:hover, .submit #wp-submit:focus, .submit #wp-submit:active {
            -webkit-animation-name: hvr-buzz;
            animation-name: hvr-buzz;
            -webkit-animation-duration: 0.15s;
            animation-duration: 0.15s;
            -webkit-animation-timing-function: linear;
            animation-timing-function: linear;
            -webkit-animation-iteration-count: infinite;
            animation-iteration-count: infinite;
        }

        <?php
        }
        ?>
        <?php
        if( get_option( 'blsButtonStyle' ) == 'button4')
        {
        ?>
        .submit #wp-submit {
            vertical-align: middle;
            -webkit-transform: translateZ(0);
            transform: translateZ(0);
            box-shadow: 0 0 1px rgba(0, 0, 0, 0);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -moz-osx-font-smoothing: grayscale;
            -webkit-transition-duration: 0.5s;
            transition-duration: 0.5s;
        }

        .submit #wp-submit:hover, .submit #wp-submit:focus, .submit #wp-submit:active {
            -webkit-transform: scale(0.8);
            transform: scale(0.8);
            -webkit-transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
            transition-timing-function: cubic-bezier(0.47, 2.02, 0.31, -0.36);
        }

        <?php
        }
        ?>
    </style>
<?php }

add_action( 'login_enqueue_scripts', 'bls_loginLogo' );

// replace the URL/Title on the WP Login page
function bls_logo_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'bls_logo_url' );

function bls_logo_url_title() {
    return get_bloginfo('name') . ' | ' . get_bloginfo('description');
}
add_filter( 'login_headertitle', 'bls_logo_url_title' );
