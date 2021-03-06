<?php
function gp_getEnv($name, $def){
	return isset($_ENV[$name]) ? $_ENV[$name] : $def;
}

$maps_url = gp_getEnv('maps_url', 'https://maps.geoplatform.gov');
$viewer_url = gp_getEnv('viewer_url', 'https://viewer.geoplatform.gov');
$marketplace_url = gp_getEnv('marketplace_url',"https://marketplace.geoplatform.gov");
$dashboard_url = gp_getEnv('dashboard_url',"https://dashboard.geoplatform.gov/#/lma?surveyId=8&page=0&size=500&sortElement=title&sortOrder=asc&colorTheme=green");
$wpp_url = gp_getEnv('wpp_url',"https://geoplatform.gov");
$ual_url = gp_getEnv('ual_url',"https://ual.geoplatform.gov");
$ckan_mp_url = gp_getEnv('ckan_mp_url',"https://data.geoplatform.gov/#/?progress=planned&h=Marketplace");
$ckan_url = gp_getEnv('ckan_url',"https://data.geoplatform.gov/");
$cms_url = gp_getEnv('cms_url',"https://www.geoplatform.gov/geoplatform-resources/");
$idp_url = gp_getEnv('idp_url',"https://idp.geoplatform.gov");
$oe_url = gp_getEnv('oe_url',"https://oe.geoplatform.gov");
$sd_url = gp_getEnv('sd_url',"servicedesk@geoplatform.gov");
$ga_code = gp_getEnv('ga_code','UA-00000000-0');

//-------------------------------
// Add scripts and stylesheets
//-------------------------------
//https://www.taniarascia.com/wordpress-from-scratch-part-two/
function startwordpress_scripts() {

	wp_enqueue_style( 'blog', get_template_directory_uri() . '/css/Geomain_style.css' );
	wp_enqueue_style( 'bootstrap-css','//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css');
	wp_enqueue_script( 'jquery', get_template_directory_uri() . '/js/jquery.min.js', array('jquery'), '2.1.4', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '3.3.7', true );
	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/geoplatform.style.min.js', array('jquery'));
	//wp_enqueue_script( 'auth', get_template_directory_uri() . '/scripts/authentication.js');
	//wp_enqueue_script( 'fixedScroll', get_template_directory_uri() . '/scripts/fixed_scroll.js');
	//wp_enqueue_script( 'ajax-pagination',  get_template_directory_uri() . '/js/ajax-pagination.js', array( 'jquery' ), '1.0', true );
	//Google Analytics tracking
	wp_enqueue_script( 'google-analytics', get_template_directory_uri() . '/js/google_analytics.js');
}
add_action( 'wp_enqueue_scripts', 'startwordpress_scripts' );

//-------------------------------
// Add Google Lato Fonts
//-------------------------------
function startwordpress_google_fonts() {
				wp_register_style('Lato/Slabo', 'https://fonts.googleapis.com/css?family=Lato:400,700|Slabo+27px');
				wp_enqueue_style( 'Lato/Slabo');
		}
add_action('wp_enqueue_scripts', 'startwordpress_google_fonts');

//-------------------------------
// WordPress Titles
//-------------------------------
add_theme_support( 'title-tag' );

//------------------------------------
//Support for a custom header Images
//------------------------------------
add_theme_support( 'custom-header' );

//--------------------------
//Support adding Menus for header and footer
//https://premium.wpmudev.org/blog/add-menus-to-wordpress/?utm_expid=3606929-97.J2zL7V7mQbSNQDPrXwvBgQ.0&utm_referrer=https%3A%2F%2Fwww.google.com%2F
//--------------------------
function register_my_menus() {
  register_nav_menus(
    array(
      'headfoot-featured' => 'HF - Featured',
      'headfoot-getInvolved' => 'HF - Get Involved',
      'headfoot-appservices' => 'HF - Apps and Services',
      'headfoot-aboutL' => 'HF - About Left',
      'headfoot-aboutR' => 'HF - About Right',
      'headfoot-help' => 'HF - Help',
      'headfoot-themes' => 'HF - Themes',
			'community-links' => 'Community Links'
    )
  );
}
add_action( 'init', 'register_my_menus' );

//-------------------------------
// Support Featured Images
//-------------------------------
add_theme_support( 'post-thumbnails' );

//-------------------------------
// Diabling auto formatting and adding <p> tags to copy/pasted HTML in pages
//-------------------------------
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );


//-------------------------------
//Localizing our script for AJAX calls
//via https://premium.wpmudev.org/blog/load-posts-ajax/?utm_expid=3606929-101._J2UGKNuQ6e7Of8gblmOTA.0&utm_referrer=https%3A%2F%2Fwww.google.com%2F
//-------------------------------
// wp_localize_script( 'ajax-pagination', 'ajaxpagination', array(
// 	'ajaxurl' => admin_url( 'admin-ajax.php' )
// ));

//-------------------------------
//adding actions for AJAX pagination for logged in and non logged in users
//via https://premium.wpmudev.org/blog/load-posts-ajax/?utm_expid=3606929-101._J2UGKNuQ6e7Of8gblmOTA.0&utm_referrer=https%3A%2F%2Fwww.google.com%2F
//-------------------------------
// add_action( 'wp_ajax_nopriv_ajax_pagination', 'my_ajax_pagination' );
// add_action( 'wp_ajax_ajax_pagination', 'my_ajax_pagination' );
//
// function my_ajax_pagination() {
//     echo get_bloginfo( 'version' );
//
//     die();
// }
//OR
//similar solution https://code.tutsplus.com/articles/getting-started-with-ajax-wordpress-pagination--wp-23099
// function MyAjaxFunction(){
//   //get the data from ajax() call
//    $GreetingAll = $_POST['GreetingAll '];
//    $results = "<h2>".$GreetingAll."</h2>";
//   // Return the String
//    die($results);
//   }
//   // creating Ajax call for WordPress
//    add_action( 'wp_ajax_nopriv_ MyAjaxFunction', 'MyAjaxFunction' );
//    add_action( 'wp_ajax_ MyAjaxFunction', 'MyAjaxFunction' );


//-------------------------------
// Custom settings page in wp-admin
//-------------------------------
//https://www.sitepoint.com/create-a-wordpress-theme-settings-page-with-the-settings-api/
//Wordpress used to do this before adding the Customizer. Could be useful for custom requests/functionality
//for power users, otherwise keeping things in the Customizer would probably be easier for a lay user
//https://make.wordpress.org/themes/handbook/review/required/#options-and-settings for reference on current conventions/if we ever want to submit this publicly




//---------------------------------------
//Supporting Theme Customizer editing
//https://codex.wordpress.org/Theme_Customization_API
//--------------------------------------
function geo_customize_register( $wp_customize )
{
		//color section, settings, and controls
    $wp_customize->add_section( 'header_color_section' , array(
        'title'    => __( 'Header Color Section', 'ngda-ncc-2017' ),
        'priority' => 30
    ) );

		//h1 color setting and control
		$wp_customize->add_setting( 'header_color_setting' , array(
				'default'   => '#000000',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_link_color', array(
				'label'    => __( 'Header1 Color', 'ngda-ncc-2017' ),
				'section'  => 'header_color_section',
				'settings' => 'header_color_setting',
		) ) );

		//h2 color setting and control
		$wp_customize->add_setting( 'header2_color_setting' , array(
				'default'   => '#000000',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h2_link_color', array(
				'label'    => __( 'Header 2 Color', 'ngda-ncc-2017' ),
				'section'  => 'header_color_section',
				'settings' => 'header2_color_setting',
		) ) );

		//h3 color setting and control
		$wp_customize->add_setting( 'header3_color_setting' , array(
				'default'   => '#000000',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h3_link_color', array(
				'label'    => __( 'Header 3 Color', 'ngda-ncc-2017' ),
				'section'  => 'header_color_section',
				'settings' => 'header3_color_setting',
		) ) );

		//h4 color setting and control
		$wp_customize->add_setting( 'header4_color_setting' , array(
				'default'   => '#000000',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'h4_link_color', array(
				'label'    => __( 'Header 4 Color', 'ngda-ncc-2017' ),
				'section'  => 'header_color_section',
				'settings' => 'header4_color_setting',
		) ) );

    //link (<a>) color and control
		$wp_customize->add_setting( 'link_color_setting' , array(
				'default'   => '#000000',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'a_link_color', array(
				'label'    => __( 'Link Color', 'ngda-ncc-2017' ),
				'section'  => 'header_color_section',
				'settings' => 'link_color_setting',
		) ) );

		//.brand color and control
		$wp_customize->add_setting( 'brand_color_setting' , array(
				'default'   => '#000000',
				'transport' => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color'
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'brand_color', array(
				'label'    => __( 'Brand Color', 'ngda-ncc-2017' ),
				'section'  => 'header_color_section',
				'settings' => 'brand_color_setting',
		) ) );



		//Fonts section, settings, and controls
		//http://themefoundation.com/wordpress-theme-customizer/ section 5.2 Radio Buttons
		$wp_customize->add_section( 'font_section' , array(
				'title'    => __( 'Font Section', 'ngda-ncc-2017' ),
				'priority' => 50
			) );

		$wp_customize->add_setting('font_choice',array(
        'default' => 'lato',
				'sanitize_callback' => 'geop_sanitize_fonts',
    	));

		$wp_customize->add_control('font_choice',array(
        'type' => 'radio',
        'label' => 'Fonts',
        'section' => 'font_section',
        'choices' => array(
            'lato' => __('Lato', 'ngda-ncc-2017'),
            'slabo' => __('Slabo',  'ngda-ncc-2017')
						),
				));

		//Banner Intro Text editor section, settings, and controls
		// pulled from https://wpshout.com/making-themes-more-wysiwyg-with-the-wordpress-customizer/
		//fixed some issues with linking up through https://github.com/paulund/wordpress-theme-customizer-custom-controls/issues/4
		$wp_customize->add_section( 'banner_text_section' , array(
				'title'    => __( 'Banner Area', 'ngda-ncc-2017' ),
				'priority' => 50
			) );

         // Add a text editor control
         require_once dirname(__FILE__) . '/text/text-editor-custom-control.php';
         $wp_customize->add_setting( 'text_editor_setting', array(
             'default'        => '',
						 'transport' => 'refresh',
						 //'sanitize_callback' => 'wp_kses_post'
         ) );
         $wp_customize->add_control( new Text_Editor_Custom_Control( $wp_customize, 'text_editor_setting', array(
             'label'   => __( 'Banner Text Editor', 'ngda-ncc-2017' ),
             'section' => 'banner_text_section',
             'settings'   => 'text_editor_setting',
             'priority' => 10
         ) ) );

				 //Call to action button (formerly "Learn More" button)
				 $wp_customize->add_setting('call2action_button', array(
					 'default' => false,
					 'transport' => 'refresh',
				 ) );

				 $wp_customize->add_control('call2action_button', array(
					 'section' => 'banner_text_section',
					 'label' =>__( 'Show Call to Action button?', 'ngda-ncc-2017' ),
					 'type' => 'checkbox',
					 'priority' => 20,
				 ) );

				 $wp_customize->add_setting('call2action_text', array(
					 'default' => '',
					 'transport' => 'refresh',
					 'sanitize_callback' => 'sanitize_text_field',
				 ));
				 $wp_customize->add_control('call2action_text', array(
					 'section' => 'banner_text_section',
					 'label' =>__( 'Button Text', 'ngda-ncc-2017' ),
					 'type' => 'text',
					 'priority' => 30,
				 ) );

				 $wp_customize->add_setting('call2action_url', array(
					'default' => '',
					'transport' => 'refresh',
					'sanitize_callback' => 'esc_url_raw',
				));
				$wp_customize->add_control('call2action_url', array(
					'section' => 'banner_text_section',
					'label' =>__( 'Button URL', 'ngda-ncc-2017' ),
					'type' => 'URL',
					'priority' => 40,
				) );

				//Map Gallery Custom link section, settings, and controls
			$wp_customize->add_section( 'custom_links_section' , array(
				'title'    => __( 'Custom Links Section', 'ngda-ncc-2017' ),
				'priority' => 60
			) );
			$wp_customize->add_setting( 'Map_Gallery_link_box' , array(
					'default'   => 'Insert Map Gallery Link here',
					'transport' => 'refresh',
					'sanitize_callback' => 'sanitize_text_field'
				) );
			$wp_customize->add_control( 'Map_Gallery_link_box', array(
					'label' => 'Map Gallery link',
					'section' => 'custom_links_section',
					'description' => 'Make sure your gallery is pointing to UAL instead of registry. For example, https://registry.geoplatform.gov/api/galleries/{your map gallery ID} will not work, but https://ual.geoplatform.gov/api/galleries/{your map gallery ID} will',
					'type' => 'url',
					'priority' => 10
				) );

				//Add radio button to choose link style between envs (sit, stg, or prod)
				$wp_customize->add_setting( 'Map_Gallery_env_choice' , array(
						'default'   => 'prod',
						'transport' => 'refresh',
						'sanitize_callback' => 'geop_sanitize_mapchoice'
					) );
				$wp_customize->add_control( 'Map_Gallery_env_choice', array(
						'label' => 'Map Gallery Environment',
						'description' => 'If your gallery link above does not match the enviroment (sit, stg, or prod) the site is currently in, please change this setting to match.',
						'section' => 'custom_links_section',
						'type' => 'radio',
						'priority' => 20,
						'choices' => array(
								'match'=>'My gallery link matches my site enviroment',
								'sit' => 'sit (sit-ual.geoplatform.us)',
								'stg' => 'stg (stg-ual.geoplatform.gov)',
								'prod' => 'prod (ual.geoplatform.gov)'
								)
					) );

					//Community Info section, settings, and controls
				$wp_customize->add_section( 'community_info_section' , array(
						'title'    => __( 'Community Info Sidebar', 'ngda-ncc-2017' ),
						'priority' => 70
				) );
						$wp_customize->add_setting( 'Community_Name_box' , array(
								'default'   => 'Insert Community Name here',
								'transport' => 'refresh',
								'sanitize_callback' => 'sanitize_text_field'
							) );
						$wp_customize->add_control( 'Community_Name_box', array(
								'label' => 'Community Name',
								'section' => 'community_info_section',
								'type' => 'text',
								'priority' => 10
							) );
						$wp_customize->add_setting( 'Community_Type_box' , array(
								'default'   => 'Insert Community Type here',
								'transport' => 'refresh',
								'sanitize_callback' => 'sanitize_text_field'
							) );
						$wp_customize->add_control( 'Community_Type_box', array(
								'label' => 'Community Type',
								'section' => 'community_info_section',
								'type' => 'text',
								'priority' => 20
							) );
						$wp_customize->add_setting( 'Sponsor_box' , array(
								'default'   => 'Insert Sponsor here',
								'transport' => 'refresh',
								'sanitize_callback' => 'sanitize_text_field'
							) );
						$wp_customize->add_control( 'Sponsor_box', array(
								'label' => 'Sponsor',
								'section' => 'community_info_section',
								'type' => 'text',
								'priority' => 30
							) );
						$wp_customize->add_setting( 'Sponsor_Email_box' , array(
								'default'   => 'Insert Sponsor Email here',
								'transport' => 'refresh',
								'sanitize_callback' => 'sanitize_email'
							) );
						$wp_customize->add_control( 'Sponsor_Email_box', array(
								'label' => 'Sponsor Email',
								'section' => 'community_info_section',
								'type' => 'email',
								'priority' => 40
							) );
						$wp_customize->add_setting( 'Theme_Lead_Agency_box' , array(
								'default'   => 'Insert Theme Lead Agency here',
								'transport' => 'refresh',
								'sanitize_callback' => 'sanitize_text_field'
							) );
						$wp_customize->add_control( 'Theme_Lead_Agency_box', array(
								'label' => 'Theme Lead Agency',
								'section' => 'community_info_section',
								'type' => 'text',
								'priority' => 50
							) );
						$wp_customize->add_setting( 'Theme_Lead_box' , array(
								'default'   => 'Insert Theme Lead here',
								'transport' => 'refresh',
								'sanitize_callback' => 'sanitize_text_field'
							) );
						$wp_customize->add_control( 'Theme_Lead_box', array(
								'label' => 'Theme Lead',
								'section' => 'community_info_section',
								'type' => 'text',
								'priority' => 60
							) );

				//remove default colors section as Header Color Section does this job better
				 $wp_customize->remove_section( 'colors' );

				 //Remove default Menus and Static Front page sections as this theme doesn't utilize them at this time
				 $wp_customize->remove_panel( 'nav_menus');
				 $wp_customize->remove_section( 'static_front_page' );

				 //remove site tagline and checkbox for showing site title and tagline from Site Identity section
				 //; Not needed for the theme
				 $wp_customize->remove_control('blogdescription');
				 $wp_customize->remove_control('display_header_text');

}
add_action( 'customize_register', 'geo_customize_register');

//-------------------------------
//Sanitization callbak functions for customizer
//https://themeshaper.com/2013/04/29/validation-sanitization-in-customizer/
//-------------------------------
function geop_sanitize_fonts( $value ) {
    if ( ! in_array( $value, array( 'lato', 'slabo' ) ) )
        $value = 'lato';
    return $value;
}

function geop_sanitize_mapchoice( $value ) {
    if ( ! in_array( $value, array( 'match', 'sit', 'stg', 'prod' ) ) )
        $value = 'match';
    return $value;
}

//-------------------------------
//getting Enqueue script for custom customize control.
//-------------------------------
 //https://codex.wordpress.org/Plugin_API/Action_Reference/customize_controls_enqueue_scripts
function custom_customize_enqueue() {
	wp_enqueue_script( 'custom-customize', get_template_directory_uri() . '/customizer/customizer.js', array( 'jquery', 'customize-controls' ), false, true );
}
add_action( 'customize_controls_enqueue_scripts', 'custom_customize_enqueue' );

//-------------------------------
//Dynamically show the colors changing
//-------------------------------
//needs to have 'transport' => 'refresh' in add_setting() above in order to work
//https://codex.wordpress.org/Theme_Customization_API#Part_2:_Generating_Live_CSS
function header_customize_css()
{
    ?>
         <style type="text/css">
             h1 { color: <?php echo get_theme_mod('header_color_setting', '000000'); ?>; }
						 h2 { color: <?php echo get_theme_mod('header2_color_setting', '000000'); ?>!important; }
						 h3 { color: <?php echo get_theme_mod('header3_color_setting', '000000'); ?>; }
						 h4, .section--linked .heading .title { color: <?php echo get_theme_mod('header4_color_setting', '000000'); ?>; }
						 .text-selected, .text-active, a, a:visited { color: <?php echo get_theme_mod('link_color_setting', '000000'); ?>; }
						 header.t-transparent .brand>a { color: <?php echo get_theme_mod('brand_color_setting', '000000'); ?>; }

         </style>
    <?php
}
add_action( 'wp_head', 'header_customize_css');

//-------------------------------
//Override banner background-image as the custom header
//-------------------------------
//https://codex.wordpress.org/Function_Reference/wp_add_inline_style
function header_image_method() {
	wp_enqueue_style(
		'custom-style',
		get_template_directory_uri() . '/css/Geomain_style.css'
	);
        $headerImage = get_header_image();
        $custom_css = "
                .banner{
                        background-image: url({$headerImage});
                }";
        wp_add_inline_style( 'custom-style', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'header_image_method' );


//-------------------------------
//Give page and post banners a WYSIWYG editor
//-------------------------------
//http://help4cms.com/add-wysiwyg-editor-in-wordpress-meta-box/

define('WYSIWYG_META_BOX_ID', 'my-editor');

add_action('admin_init', 'wysiwyg_register_custom_meta_box');

function wysiwyg_register_custom_meta_box()
 {
 add_meta_box(WYSIWYG_META_BOX_ID, __('Banner Area Custom Content', 'ngda-ncc-2017') , 'custom_wysiwyg', 'post');
 add_meta_box(WYSIWYG_META_BOX_ID, __('Banner Area Custom Content', 'ngda-ncc-2017') , 'custom_wysiwyg', 'page');
 }

function custom_wysiwyg($post)
 {
 echo "<h3>Anything you add below will show up in the Banner:</h3>";
 $content = get_post_meta($post->ID, 'custom_wysiwyg', true);
 wp_editor(htmlspecialchars_decode($content) , 'custom_wysiwyg', array(
 "media_buttons" => true
 ));
 }

function custom_wysiwyg_save_postdata($post_id)
 {
 if (!empty($_POST['custom_wysiwyg']))
 {
 $data = htmlspecialchars_decode($_POST['custom_wysiwyg']);
 update_post_meta($post_id, 'custom_wysiwyg', $data);
 }
 }
add_action('save_post', 'custom_wysiwyg_save_postdata');



//Making Category description pages WYSIWYG
//https://paulund.co.uk/add-tinymce-editor-category-description

remove_filter( 'pre_term_description', 'wp_filter_kses' );
remove_filter( 'term_description', 'wp_kses_data' );

add_filter('edit_category_form_fields', 'cat_description');
function cat_description($tag)
{
    ?>
        <!-- <table class="form-table"> -->
            <tr class="form-field">
                <th scope="row" valign="top"><label for="description">Description</label></th>
                <td>
                <?php
                    $settings = array('wpautop' => true, 'media_buttons' => true, 'quicktags' => true, 'textarea_rows' => '15', 'textarea_name' => 'description' );
                    wp_editor(wp_kses_post($tag->description , ENT_QUOTES, 'UTF-8'), 'cat_description', $settings);
                ?>
                <br />
                <span class="description">The description is not prominent by default; however, some themes may show it.</span>
                </td>
            </tr>
        <!-- </table> -->
    <?php
}

add_action('admin_head', 'remove_default_category_description');
function remove_default_category_description()
{
    global $current_screen;
    if ( $current_screen->id == 'edit-category' )
    {
    ?>
        <script type="text/javascript">
        jQuery(function($) {
            $('textarea#description').closest('tr.form-field').remove();
        });
        </script>
    <?php
    }
}


//-------------------------------
//Add extra boxes to Category editor
//-------------------------------
//https://en.bainternet.info/wordpress-category-extra-fields/


//add extra fields to category edit form hook
add_action ( 'edit_category_form_fields', 'extra_category_fields');

//add extra fields to category edit form callback function
function extra_category_fields( $tag ) {    //check for existing featured ID
    $t_id = $tag->term_id;
    $cat_meta = get_option( "category_$t_id");
?>
<!-- Topic 1 Name and Url -->
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-name1">Topic 1 Name</label></th>
		<td style="padding: 5px 5px;">
			<input type="text" name="Cat_meta[topic-name1]" id="Cat_meta[topic-name1]" size="20" style="width:20%;" value="<?php echo $cat_meta['topic-name1'] ? $cat_meta['topic-name1'] : ''; ?>">
			<label for="url_type1" style="margin-left:1em;"><b>URL Type: </b></label>
			<select name="Cat_meta[url_type1]" id="Cat_meta[url_type1]" class="postform">
				<option value="value_1" selected="selected">NewsMap</option>
				<option value="value_2" <?php echo ($cat_meta['url_type1'] == "value_2") ? 'selected="selected"': ''; ?>>Regular</option>
			</select>
				<span class="description">  Choose "NewsMap" for link below to show your EMM NewsBrief URL, or "Regular" to use any normal full URL.</span>
		</td>
</tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-url1">Topic 1 URL</label></th>
<td style="padding: 5px 5px;">
<input type="text" name="Cat_meta[topic-url1]" id="Cat_meta[topic-url1]" size="20" style="width:80%;" value="<?php echo $cat_meta['topic-url1'] ? $cat_meta['topic-url1'] : ''; ?>"><br />


    </td>
</tr>


<!-- Topic 2 Name and Url -->
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-name2">Topic 2 Name</label></th>
		<td style="padding: 5px 5px;">
			<input type="text" name="Cat_meta[topic-name2]" id="Cat_meta[topic-name2]" size="20" style="width:20%;" value="<?php echo $cat_meta['topic-name2'] ? $cat_meta['topic-name2'] : ''; ?>">
			<label for="url_type2" style="margin-left:1em;"><b>URL Type: </b></label>
			<select name="Cat_meta[url_type2]" id="Cat_meta[url_type2]" class="postform">
				<option value="value_1" selected="selected">NewsMap</option>
				<option value="value_2" <?php echo ($cat_meta['url_type2'] == "value_2") ? 'selected="selected"': ''; ?>>Regular</option>
			</select>
				<span class="description">  Choose "NewsMap" for link below to show your EMM NewsBrief URL, or "Regular" to use any normal full URL.</span>
		</td>
</tr>

<tr class="form-field">
<th scope="row" valign="top"><label for="topic-url2">Topic 2 URL</label></th>
<td style="padding: 5px 5px;">
<input type="text" name="Cat_meta[topic-url2]" id="Cat_meta[topic-url2]" size="20" style="width:80%;" value="<?php echo $cat_meta['topic-url2'] ? $cat_meta['topic-url2'] : ''; ?>">

    </td>
</tr>

<!-- Topic 3 Name and Url -->
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-name3">Topic 3 Name</label></th>
		<td style="padding: 5px 5px;">
			<input type="text" name="Cat_meta[topic-name3]" id="Cat_meta[topic-name3]" size="20" style="width:20%;" value="<?php echo $cat_meta['topic-name3'] ? $cat_meta['topic-name3'] : ''; ?>">
			<label for="url_type3" style="margin-left:1em;"><b>URL Type: </b></label>
			<select name="Cat_meta[url_type3]" id="Cat_meta[url_type3]" class="postform">
				<option value="value_1" selected="selected">NewsMap</option>
				<option value="value_2" <?php echo ($cat_meta['url_type3'] == "value_2") ? 'selected="selected"': ''; ?>>Regular</option>
			</select>
				<span class="description">  Choose "NewsMap" for link below to show your EMM NewsBrief URL, or "Regular" to use any normal full URL.</span>
		</td>
</tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-url3">Topic 3 URL</label></th>
<td style="padding: 5px 5px;">
<input type="text" name="Cat_meta[topic-url3]" id="Cat_meta[topic-url3]" size="20" style="width:80%;" value="<?php echo $cat_meta['topic-url3'] ? $cat_meta['topic-url3'] : ''; ?>"><br />
      </td>
</tr>

<!-- Topic 4 Name and Url -->
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-name4">Topic 4 Name</label></th>
		<td style="padding: 5px 5px;">
			<input type="text" name="Cat_meta[topic-name4]" id="Cat_meta[topic-name4]" size="20" style="width:20%;" value="<?php echo $cat_meta['topic-name4'] ? $cat_meta['topic-name4'] : ''; ?>">
			<label for="url_type4" style="margin-left:1em;"><b>URL Type: </b></label>
			<select name="Cat_meta[url_type4]" id="Cat_meta[url_type4]" class="postform">
				<option value="value_1" selected="selected">NewsMap</option>
				<option value="value_2" <?php echo ($cat_meta['url_type4'] == "value_2") ? 'selected="selected"': ''; ?>>Regular</option>
			</select>
				<span class="description">  Choose "NewsMap" for link below to show your EMM NewsBrief URL, or "Regular" to use any normal full URL.</span>
		</td>
</tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-url4">Topic 4 URL</label></th>
<td style="padding: 5px 5px;">
<input type="text" name="Cat_meta[topic-url4]" id="Cat_meta[topic-url4]" size="20" style="width:80%;" value="<?php echo $cat_meta['topic-url4'] ? $cat_meta['topic-url4'] : ''; ?>"><br />

    </td>
</tr>

<!-- Topic 5 Name and Url -->
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-name5">Topic 5 Name</label></th>
		<td style="padding: 5px 5px;">
			<input type="text" name="Cat_meta[topic-name5]" id="Cat_meta[topic-name5]" size="20" style="width:20%;" value="<?php echo $cat_meta['topic-name5'] ? $cat_meta['topic-name5'] : ''; ?>">
			<label for="url_type5" style="margin-left:1em;"><b>URL Type: </b></label>
			<select name="Cat_meta[url_type5]" id="Cat_meta[url_type5]" class="postform">
				<option value="value_1" selected="selected">NewsMap</option>
				<option value="value_2" <?php echo ($cat_meta['url_type5'] == "value_2") ? 'selected="selected"': ''; ?>>Regular</option>
			</select>
				<span class="description">  Choose "NewsMap" for link below to show your EMM NewsBrief URL, or "Regular" to use any normal full URL.</span>
		</td>
</tr>
<tr class="form-field">
<th scope="row" valign="top"><label for="topic-url5">Topic 5 URL</label></th>
<td style="padding: 5px 5px;">
<input type="text" name="Cat_meta[topic-url5]" id="Cat_meta[topic-url5]" size="20" style="width:80%;" value="<?php echo $cat_meta['topic-url5'] ? $cat_meta['topic-url5'] : ''; ?>"><br />

    </td>
</tr>
<?php
}
// save extra category extra fields hook
add_action ( 'edited_category', 'save_extra_category_fileds');

// save extra category extra fields callback function
function save_extra_category_fileds( $term_id ) {
    if ( isset( $_POST['Cat_meta'] ) ) {
        $t_id = $term_id;
        $cat_meta = get_option( "category_$t_id");
        $cat_keys = array_keys($_POST['Cat_meta']);
            foreach ($cat_keys as $key){
            if (isset($_POST['Cat_meta'][$key])){
                $cat_meta[$key] = $_POST['Cat_meta'][$key];
            }
        }
        //save the option array
        update_option( "category_$t_id", $cat_meta );
    }
}

//Adding Categories and Tag functionality to pages (for frontpage setting)
//https://stackoverflow.com/questions/14323582/wordpress-how-to-add-categories-and-tags-on-pages

function page_cat_tag_settings() {
// Add tag metabox to page
register_taxonomy_for_object_type('post_tag', 'page');
// Add category metabox to page
register_taxonomy_for_object_type('category', 'page');
}
 // Add to the admin_init hook of your theme functions.php file
add_action( 'init', 'page_cat_tag_settings' );

// ensure all tags and categories are included in queries
function tags_categories_support_query($wp_query) {
  if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
  if ($wp_query->get('category_name')) $wp_query->set('post_type', 'any');
}
add_action('pre_get_posts', 'tags_categories_support_query');



//-------------------------------
// Widgetizing the theme
// https://codex.wordpress.org/Function_Reference/dynamic_sidebar
// https://www.elegantthemes.com/blog/tips-tricks/how-to-manage-the-wordpress-sidebar
//------------------------------------

add_action( 'widgets_init', 'geoplatform_sidebar' );

function geoplatform_sidebar() {

    register_sidebar(
        array(
            'id' => 'geoplatform-widgetized-area',
            'name' => __( 'Sidebar Widget', 'ngda-ncc-2017' ),
            'description' => __( 'Widgets that go in the sidebar can be added here', 'ngda-ncc-2017' ),
                        'class' => 'widget-class',
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
						'after_widget'  => '</div>',
						'before_title'  => '<h4>',
						'after_title'   => '</h4>'
        )
    );
}

//-------------------------------
//Global Content Width
//per https://codex.wordpress.org/Content_Width#Adding_Theme_Support
//-------------------------------

if ( ! isset( $content_width ) ) {
	$content_width = 900;
}


//-------------------------------
//Theme Support for Automatic Feed links per theme check
//https://codex.wordpress.org/Automatic_Feed_Links
//-------------------------------
add_theme_support( 'automatic-feed-links' );
