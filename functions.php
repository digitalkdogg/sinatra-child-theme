<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );

if ( !function_exists( 'child_theme_configurator_css' ) ):
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'sinatra-styles' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

if ( ! function_exists( 'enqueue_custom_stuff' ) ) {
	function enqueue_custom_stuff() {
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', 'before');
    wp_enqueue_script( 'customjs', get_stylesheet_directory_uri() . '/assets/js/min/base.min.js' , array(), '1.1.0', false);
    wp_enqueue_style( 'millwood-base', get_stylesheet_directory_uri() . '/assets/css/base.css', array(), '1.0.4', false);

    if (is_page_template( 'page-templates/donate-page.php' )) {
            wp_enqueue_script( 'donatejs', get_stylesheet_directory_uri() . '/assets/js/min/donate.min.js', array(), '1.0.1', false );
            wp_enqueue_style('donatecss', get_stylesheet_directory_uri() . '/assets/css/donate.css', array(), '1.0.1', false);
    }
    if (is_page_template( 'page-templates/news-page.php' )) {
            wp_enqueue_script( 'donatejs', get_stylesheet_directory_uri() . '/assets/js/min/news.min.js', array(), '1.0.2', false );
            wp_enqueue_style( 'donatecss', get_stylesheet_directory_uri() . '/assets/css/news.css', array(), '1.0.2', false );
    }
  }
}
add_action( 'wp_enqueue_scripts', 'enqueue_custom_stuff' );


if ( ! defined( 'SINATRA_THEME_PATH' ) ) {
  define( 'SINATRA_THEME_PATH', get_parent_theme_file_path() . '-child');
}
// Customizer.
require_once SINATRA_THEME_PATH . '/inc/customizer/class-sinatra-customizer.php';

$all_settings = get_theme_mods();

function get_custom_vars() {
  $json_str = '';

  $json_str = 'stylesheet_dir-_-'. get_stylesheet_directory_uri();
  $json_str = $json_str . '===testing-_-test2';

  return $json_str;

}

function get_sitename_var() {
  $all_settings = get_theme_mods();

  if (strlen($all_settings['sitename']) > 0) {
    return $all_settings['sitename'];
  }
  return 'millwood';

}

function get_stripe_var() {
  $all_settings = get_theme_mods();
  $stripe_data = array();
  if (strlen($all_settings['stripe_test_key']) > 0) {
    $stripe_data['stripe_api_test_key'] = $all_settings['stripe_test_key'];
  }

  if (strlen($all_settings['stripe_use_test_data']) > 0) {
    $stripe_data['use_test_data'] = $all_settings['stripe_use_test_data'];
  }


  if (isset($all_settings['stripe_live_key'])) {
    $stripe_data['stripe_api_live_key'] = $all_settings['stripe_live_key'];
  }

  return json_encode($stripe_data);

}



if ( ! function_exists( 'sinatra_footer_widgets' ) ) :
	/**
	 * Outputs the footer widgets.
	 *
	 * @since 1.0.0
	 */
	function millwood_footer_widgets() {

		$footer_layout  = sinatra_option( 'footer_layout' );
		$column_classes = sinatra_get_footer_column_class( $footer_layout );
    if (!$column_classes && $footer_layout == 'layout-5') {
      $column_classes = array('col-xs-12 col-sm-6 stretch-xs col-md-6', 'col-xs-12 col-sm-6 stretch-xs col-md-6');
    }

    if (!$column_classes && $footer_layout == 'layout-6') {
      $column_classes = array('col-xs-12 col-sm-12 stretch-xs col-md-12');
    }

		if ( is_array( $column_classes ) && ! empty( $column_classes ) ) {
			foreach ( $column_classes as $i => $column_class ) {

				$sidebar_id = 'sinatra-footer-' . ( $i + 1 );
				?>
				<div class="sinatra-footer-column <?php echo esc_attr( $column_class ); ?>">
					<?php
					if ( is_active_sidebar( $sidebar_id ) ) {
						dynamic_sidebar( $sidebar_id );
					} else {

						if ( current_user_can( 'edit_theme_options' ) ) {

							$sidebar_name = sinatra_get_sidebar_name_by_id( $sidebar_id );
							?>
							<div class="si-footer-widget si-widget sinatra-no-widget">

								<div class='h4 widget-title'><?php echo esc_html( $sidebar_name ); ?></div>

								<p class='no-widget-text'>
									<?php if ( is_customize_preview() ) { ?>
										<a href='#' class="sinatra-set-widget" data-sidebar-id="<?php echo esc_attr( $sidebar_id ); ?>">
									<?php } else { ?>
										<a href='<?php echo esc_url( admin_url( 'widgets.php' ) ); ?>'>
									<?php } ?>
										<?php esc_html_e( 'Click here to assign a widget.', 'sinatra' ); ?>
									</a>
								</p>
							</div>
							<?php
						}
					}
					?>
				</div>
				<?php
			}
		}
	}
endif;


/**
* Generates new stripe intent
* @param array $data Options for the function.
* @return $object, or null if none.  */

 function get_stripe_intent ( $params ){

 		$all_settings = get_theme_mods();


    require_once($all_settings['stripe_base_path'] . '/stripe-php/init.php');


    if ($all_settings['stripe_use_test_data']==false) {
      $stripe = new \Stripe\StripeClient(
        $all_settings['stripe_live_secret']
      );
    } else {
      $stripe = new \Stripe\StripeClient(
      	$all_settings['stripe_test_secret']
      );
    }

      $customer = $stripe->customers->create([
        'description' => $params['name'],
        'email' =>$params['email'],
        'address' => $params['address'],
      ]);

      $response = $stripe->paymentIntents->create([
        'amount' => $params['amount'],
        'currency' => 'usd',
        'receipt_email'=>$params['email'],
        'description'=>$params['name'],
        'customer'=>$customer->id,
        'payment_method_types' => ['card'],
      ]);

      $response['customer'] =$customer;

       return $response;

 }

 function get_hero_image() {
  $return = '';
  $all_settings = get_theme_mods();
  if (wp_is_mobile() == true) {
    foreach ($all_settings['millwood_hero_mobile_image'] as $key => $image) {
      //$return = $return . $key . ':' . $image . ';';
      if ($key == 'background-image') {
        $return = $image;
      }
    }
    } else {
      foreach ($all_settings['millwood_hero_desktop_image'] as $key => $image) {
        //$return = $return . $key . ':' . $image . ';';
        if ($key == 'background-image') {
          $return = $image;
        }
      }
    //  $return = $return . '\'';
    }

    wp_enqueue_style('herocss', get_stylesheet_directory_uri() . '/assets/css/hero.css', array(), '1.0.2', false);

    //wp_enqueue_style( 'herocss', get_stylesheet_directory_uri() . '/assets/css/hero.css' );
  return $return;
 }


 /**
* Grab latest event posts
* @param array $data Options for the function.
* @return $object, or null if none.  */

function get_latest_cc ( $params ){
  global $wpdb;
  $result = $wpdb->get_results('SELECT * FROM wp_campaigns where status = "Done" order by created_at desc');

  return $result;

}


add_action( 'rest_api_init', function () {
       register_rest_route('stripe/v1', 'create_intent', array(
         'methods' => 'POST',
         'callback' => 'get_stripe_intent'
       ));

       register_rest_route('cc/v1', 'latest-cc',array(
         'methods' => 'GET',
         'callback' => 'get_latest_cc'
       ));
});

//add_action("wp_ajax_my_user_vote", "get_stripe_intent2");


// END ENQUEUE PARENT ACTION
