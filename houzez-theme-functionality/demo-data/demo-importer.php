<?php
function houzez_importer_intro( $default_text ) {
    $message = '<p>'. esc_html__( 'Best if used on new WordPress install.', 'houzez' ) .'</p>';
      $message .= '<p>'. esc_html__( 'Images are for demo purpose only.', 'houzez' ) .'</p>';
      $message .= '
      <h3>What if the Import fails or stalls?</h3>

      <p>
      If the import stalls and fails to respond after a few minutes You are suffering from PHP configuration limits that are set too low to complete the process. You should contact your hosting provider and ask them to increase those limits to a minimum as follows:
      </p>
      <ul style="margin-left: 60px">
          <li>max_execution_time 400</li>
          <li>memory_limit 128M</li>
          <li>post_max_size 32M</li>
          <li>upload_max_filesize 32M</li>
      </ul>
      <p>You can verify your PHP configuration limits by installing a simple plugin found here: <a href="http://wordpress.org/extend/plugins/wordpress-php-info" target="_blank">http://wordpress.org/extend/plugins/wordpress-php-info</a>. And you can also check your PHP error logs to see the exact error being returned.</p>
      <p>If you were not able to import demo, please contact on our <a target="_blank" href="https://favethemes.ticksy.com/"><b>support forum</b></a>, our technical staff will import demo for you.</p>
      ';

      return $message;
}
add_filter( 'pt-ocdi/plugin_intro_text', 'houzez_importer_intro' );

function houzez_importer_plugin_page_setup( $default_settings ) {
    $default_settings['parent_slug'] = 'edit.php?post_type=property';
    $default_settings['page_title']  = esc_html__( 'Demo Import' , 'houzez-theme-functionality' );
    $default_settings['menu_title']  = esc_html__( 'Demo Importer' , 'houzez-theme-functionality' );
    $default_settings['capability']  = 'import';
    $default_settings['menu_slug']   = 'houzez-one-click-demo-import';

    return $default_settings;
}
add_filter( 'pt-ocdi/plugin_page_setup', 'houzez_importer_plugin_page_setup' );

function Houzez_Import_Files() {
  return array(

    /*=========== Elementor ================================================================*/
    array(
      'import_file_name'             => 'Default',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/default/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/default/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/default/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/default/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://default.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez01',
      'import_file_url'              => 'https://plugins.houzez.co/demo-data/houzez01/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez01/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez01/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez01/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo01.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez02',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez02/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez02/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez02/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez02/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo02.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez03',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez03/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez03/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez03/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez03/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo03.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez04',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez04/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez04/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez04/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez04/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo04.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez05',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez05/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez05/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez05/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez05/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo05.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez06',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez06/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez06/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez06/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez06/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo06.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez07',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez07/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez07/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez07/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez07/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo07.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez08',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez08/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez08/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez08/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez08/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo08.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez09',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez09/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez09/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez09/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez09/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo09.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez10',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez10/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez10/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez10/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez10/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo10.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez11',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez11/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez11/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez11/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez11/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo11.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez12',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez12/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez12/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez12/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez12/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo12.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez13',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez13/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez13/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez13/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez13/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo13.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez14',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez14/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez14/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez14/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez14/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo14.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez15',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez15/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez15/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez15/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez15/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo15.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez16',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez16/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez16/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez16/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez16/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo16.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez17',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez17/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez17/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez17/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez17/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo17.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez18',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez18/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez18/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez18/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez18/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo18.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez19',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez19/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez19/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez19/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez19/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo19.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez20',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez20/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez20/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez20/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez20/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo20.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez21',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez21/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez21/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez21/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez21/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo21.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez22',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez22/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez22/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez22/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez22/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo22.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez23',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez23/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez23/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez23/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez23/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo23.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez24',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez24/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez24/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez24/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez24/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo24.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez25',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez25/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez25/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez25/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez25/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo25.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez26',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez26/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez26/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez26/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez26/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo26.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez27',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez27/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez27/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez27/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez27/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo27.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez28',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez28/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez28/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez28/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez28/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo28.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez29',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez29/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez29/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez29/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez29/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo29.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez30',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez30/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez30/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez30/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez30/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo30.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez30 - English',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez30-eng/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez30-eng/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez30-eng/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez30-eng/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo30-eng.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez31',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez31/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez31/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez31/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez31/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo31.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez32',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez32/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez32/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez32/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez32/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo32.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez32 - English',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez32-eng/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez32-eng/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez32-eng/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez32-eng/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo32-eng.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez33',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez33/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez33/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez33/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez33/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo33.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez33 - English',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez33-eng/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez33-eng/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez33-eng/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez33-eng/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo33-eng.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez34',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez34/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez34/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez34/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez34/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo34.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez35',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez35/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez35/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez35/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez35/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo35.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez36',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez36/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez36/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez36/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez36/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo36.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez37',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez37/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez37/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez37/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez37/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo37.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez38',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez38/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez38/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez38/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez38/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo38.houzez.co',
    ),

    array(
      'import_file_name'             => 'Houzez39',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez39/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez39/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez39/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez39/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo39.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez40',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez40/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez40/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez40/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez40/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo40.houzez.co',
    ),
    array(
      'import_file_name'             => 'Houzez41',
      'import_file_url'            => 'https://plugins.houzez.co/demo-data/houzez41/content.xml',
      'import_widget_file_url'     => 'https://plugins.houzez.co/demo-data/houzez41/widgets.json',
      'import_customizer_file_url' => '',
      'import_redux'           => array(
        array(
          'file_url'   => 'https://plugins.houzez.co/demo-data/houzez41/theme-options.json',
          'option_name' => 'houzez_options',
        ),
      ),

      'import_preview_image_url'     => 'https://plugins.houzez.co/demo-data/houzez41/thumbnail.png',
      'import_notice'                => __( 'After you import this demo, you will have to setup the slider separately.', 'homey' ),
      'preview_url'                  => 'http://demo41.houzez.co',
    ),

  );
}
add_filter( 'pt-ocdi/import_files', 'Houzez_Import_Files' );

function houzez_before_content_import( $selected_import ) {

    $rs_slider = '';
    $demo_name = $selected_import['import_file_name'];

    if ( 'Default' === $demo_name ) {
        $rs_slider = 'default/news-gallery2';

    } elseif ( 'Houzez01' === $demo_name ) {
        $rs_slider = 'houzez01/news-gallery2';

    } elseif ( 'Houzez02' === $demo_name ) {
        $rs_slider = 'houzez02/news-gallery2';

    } elseif ( 'Houzez03' === $demo_name ) {
        $rs_slider = 'houzez03/news-gallery2';

    } elseif ( 'Houzez04' === $demo_name ) {
        $rs_slider = 'houzez04/news-gallery2';

    } elseif ( 'Houzez05' === $demo_name ) {
        $rs_slider = 'houzez05/for-rent';

    } elseif ( 'Houzez07' === $demo_name ) {
        $rs_slider = 'houzez07/home';

    } elseif ( 'Houzez09' === $demo_name ) {
        $rs_slider = 'houzez09/home-hero';

    } elseif ( 'Houzez11' === $demo_name ) {
        $rs_slider = 'houzez11/homepage';

    } elseif ( 'Houzez12' === $demo_name ) {
        $rs_slider = 'houzez12/homepage_slider';

    } elseif ( 'Houzez13' === $demo_name ) {
        $rs_slider = 'houzez13/homepage';

    } elseif ( 'Houzez14' === $demo_name ) {
        $rs_slider = 'houzez14/properties';

    } elseif ( 'Houzez33' === $demo_name ) {
        $rs_slider = 'houzez33/news-gallery2-1';

    } elseif ( 'Houzez34' === $demo_name ) {
        $rs_slider = 'houzez34/news-gallery2-1';

    } elseif ( 'Houzez35' === $demo_name ) {
        $rs_slider = 'houzez35/news-gallery2-1';

    } elseif ( 'Houzez36' === $demo_name ) {
        $rs_slider = 'houzez36/news-gallery2-1';

    } elseif ( 'Houzez37' === $demo_name ) {
        $rs_slider = 'houzez37/news-gallery2-1';

    } 

    if ( class_exists( 'RevSlider' ) && !empty($rs_slider) ) {

        $sliderPath = 'https://plugins.houzez.co/demo-data/'.$rs_slider.'.zip';
        $slider = new RevSlider();
        
        if ( 'Houzez05' === $demo_name ) {

          $sliderPath2 = 'https://plugins.houzez.co/demo-data/houzez05/for-sale.zip';
          $slider->importSliderFromPost( true, true, $sliderPath );
          $slider->importSliderFromPost( true, true, $sliderPath2 );

        } elseif ( 'Houzez09' === $demo_name ) { 

          $sliderPath2 = 'https://plugins.houzez.co/demo-data/houzez09/about-us.zip';
          $sliderPath3 = 'https://plugins.houzez.co/demo-data/houzez09/agents.zip';
          $sliderPath4 = 'https://plugins.houzez.co/demo-data/houzez09/blog.zip';
          $sliderPath5 = 'https://plugins.houzez.co/demo-data/houzez09/contact.zip';
          $sliderPath6 = 'https://plugins.houzez.co/demo-data/houzez09/properties.zip';
          $slider->importSliderFromPost( true, true, $sliderPath );
          $slider->importSliderFromPost( true, true, $sliderPath2 );
          $slider->importSliderFromPost( true, true, $sliderPath3 );
          $slider->importSliderFromPost( true, true, $sliderPath4 );
          $slider->importSliderFromPost( true, true, $sliderPath5 );
          $slider->importSliderFromPost( true, true, $sliderPath6 );

        } elseif ( 'Houzez14' === $demo_name ) {

          $sliderPath2 = 'https://plugins.houzez.co/demo-data/houzez14/homepage_slider.zip';
          $slider->importSliderFromPost( true, true, $sliderPath );
          $slider->importSliderFromPost( true, true, $sliderPath2 );

        } else {
          $slider->importSliderFromPost( true, true, $sliderPath );
        }
    }
}
add_action( 'pt-ocdi/before_content_import', 'houzez_before_content_import' );

function houzez_after_import_setup($selected_import) {
    // Assign menus to their locations.
    $demo_name = $selected_import['import_file_name'];
    $front_page_id = $blog_page_id = $main_menu = '';

    if ( 'Houzez01' === $demo_name || 'Houzez02' === $demo_name || 'Houzez03' === $demo_name || 'Houzez04' === $demo_name || 'Houzez33' === $demo_name || 'Houzez33 - English' === $demo_name || 'Houzez34' === $demo_name || 'Houzez35' === $demo_name || 'Houzez36' === $demo_name || 'Houzez37' === $demo_name || 'Houzez38' === $demo_name || 'Houzez40' === $demo_name || 'Houzez41' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Home Default' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Default' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage Default' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez05' === $demo_name || 'Houzez06' === $demo_name || 'Houzez07' === $demo_name || 'Houzez09' === $demo_name || 'Houzez10' === $demo_name || 'Houzez11' === $demo_name || 'Houzez12' === $demo_name || 'Houzez14' === $demo_name || 'Houzez16' === $demo_name || 'Houzez17' === $demo_name || 'Houzez19' === $demo_name || 'Houzez20' === $demo_name || 'Houzez39' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez19' === $demo_name || 'Houzez20' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Nav', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez08' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Home' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez13' === $demo_name ) {
        $mobile_menu = get_term_by( 'name', 'Mobile Menu', 'nav_menu' );
        $left_menu = get_term_by( 'name', 'Left Menu', 'nav_menu' );
        $right_menu = get_term_by( 'name', 'Right Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Home' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez15' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage 2' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez18' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage' );
        $blog_page_id  = houzez_get_page_id_by_title( 'News' );

    } elseif ( 'Houzez21' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage 3' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez22' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez23' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Home 1' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );

    } elseif ( 'Houzez24' === $demo_name || 'Houzez27' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );
    } elseif ( 'Houzez25' === $demo_name || 'Houzez26' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage 1' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );
    } elseif ( 'Houzez28' === $demo_name || 'Houzez30 - English' === $demo_name || 'Houzez32 - English' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage 01' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );
    } elseif ( 'Houzez29' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'Homepage' );
        $blog_page_id  = houzez_get_page_id_by_title( 'Blog' );
    } elseif ( 'Houzez30' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'الصفحة الرئيسية 01' );
        $blog_page_id  = houzez_get_page_id_by_title( 'مدونة' );
    } elseif ( 'Houzez31' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'עמוד הבית 01' );
        $blog_page_id  = houzez_get_page_id_by_title( 'בלוג' );
    } elseif ( 'Houzez32' === $demo_name ) {
        $footer_menu = get_term_by( 'name', 'Footer Menu', 'nav_menu' );
        $main_menu = get_term_by( 'name', 'Main Menu', 'nav_menu' );
        $front_page_id = houzez_get_page_id_by_title( 'صفحه اصلی 01' );
        $blog_page_id  = houzez_get_page_id_by_title( 'وبلاگ' );
    }

    
    if(!empty($left_menu)) {
      set_theme_mod( 'nav_menu_locations', array(
              'main-menu-left' => $left_menu->term_id,
          )
      );
    }
    if(!empty($right_menu)) {
      set_theme_mod( 'nav_menu_locations', array(
              'main-menu-right' => $right_menu->term_id,
          )
      );
    }

    if(!empty($mobile_menu)) {
      set_theme_mod( 'nav_menu_locations', array(
              'mobile-menu-hed6' => $mobile_menu->term_id,
          )
      );
    }

    if(!empty($footer_menu)) {
      set_theme_mod( 'nav_menu_locations', array(
              'footer-menu' => $footer_menu->term_id,
          )
      );
    }

    if(!empty($main_menu)) {
      set_theme_mod( 'nav_menu_locations', array(
              'main-menu' => $main_menu->term_id,
          )
      );
    }

    update_option( 'show_on_front', 'page' );
    if(!empty($front_page_id)) {
        update_option( 'page_on_front', $front_page_id );
    }

    if(!empty($blog_page_id)) {
        update_option( 'page_for_posts', $blog_page_id );
    }
}
add_action( 'pt-ocdi/after_import', 'houzez_after_import_setup' );
add_filter( 'pt-ocdi/disable_pt_branding', '__return_true' );

if( ! function_exists('houzez_get_page_id_by_title') ) {
  function houzez_get_page_id_by_title($page_title) {
      $args = array(
          'post_type' => 'page',
          'post_status' => 'publish',
          'title' => $page_title,
          'fields' => 'ids', // Only get post IDs
          'posts_per_page' => 1,
      );

      $query = new WP_Query($args);

      if ($query->have_posts()) {
          return $query->posts[0]; // Return the first post ID
      }

      return null;
  }
}
