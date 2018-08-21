<?php
class Geopportal_Cornerstones_Widget extends WP_Widget {

	// Constructor. Simple.
	function __construct() {
		parent::__construct(
			'geopportal_cornerstones_widget', // Base ID
			esc_html__( 'GeoPlatform Cornerstones', 'geoplatform-ccb' ), // Name
			array( 'description' => esc_html__( 'GeoPlatform Cornerstones', 'geoplatform-ccb' ), 'customize_selective_refresh' => true) // Args
		);
	}

	public function widget( $args, $instance ) {
    get_template_part( 'cornerstones', get_post_format() );
	}

	public function form( $instance ) {
		$title = "GeoPlatform Cornerstones";
		?>
		<p>
		  The GeoPlatform theme Cornerstones widget.
		</p>
		<?php
	}

	public function update( $new_instance, $old_instance ) {}
}
?>

<div class="cornerstones whatsNew section--linked">
    <!-- top directional lines and section heading -->
    <h4 class="heading">
        <div class="line"></div>
        <div class="line-arrow"></div>
    </h4>
    <br>

    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">

                <div class="row">

                    <div class="col-xs-12 col-sm-4 col-sm-push-4">
                        <img alt="Communicate and Contribute" src="<?php echo esc_url("" . get_stylesheet_directory_uri() . "/img/social_md.jpeg"); ?>" class="img--prominent">
                    </div><!--#col-xs-12 col-sm-4 col-sm-push-4-->
                    <div class="col-xs-12 col-sm-4 col-sm-pull-4">
                        <h5><a href="<?php echo esc_url($GLOBALS['geopccb_comm_url']); ?>" target="_blank">GeoPlatform Communities</a></h5>
                        <p>
                            A key goal of the Geospatial Platform is to expand the use and understanding of National geospatial resources. Active social interaction plays an important role in sharing vital, timely knowledge to keep our collective data, content and services fresh and engaging. The more you participate and contribute, the better the GeoPlatform.gov experience becomes for everyone.
                        </p>

                    </div><!--#col-xs-12 col-sm-4 col-sm-pull-4-->

                    <div class="col-xs-12 col-sm-4">
                        <h5><a href="<?php echo esc_url("https://geoplatform.maps.arcgis.com/home/"); ?>" target="_blank">GeoPlatform on ArcGIS Online</a></h5>
                        <p>
                            The GeoPlatformArcGIS Online (AGOL) organization account provides enhanced web capabilities. Federal partners are able to publish their data as services with no size restrictions. The GeoPlatform builds on AGOL services with the harvesting capability of the GeoPlatform Map Manager
                        </p>
                    </div><!--#col-xs-12 col-sm-4-->
                </div><!--#row-->

                <br>
                <hr>
                <br>

                <div class="row">

                    <div class="col-xs-12 col-sm-4 col-sm-push-4">
                        <img alt="Search" src="<?php echo esc_url("" . get_stylesheet_directory_uri() . "/img/search_md.jpeg"); ?>" class="img--prominent">
                    </div><!--#col-xs-12 col-sm-4 col-sm-push-4-->

                    <div class="col-xs-12 col-sm-4 col-sm-pull-4">
                        <h5>
                            <a href="<?php echo esc_url($GLOBALS['geopccb_ckan_url']); ?>" target="_blank">
                                Search Data.gov
                            </a>
                        </h5>
                        <p>
                            Search the <a href="https://data.gov" target="_blank">Data.gov</a> catalog of geospatial data and tools provided by a multitude of federal agencies. Whether you are a Geographic Professional, Student, Teacher or Citizen, you can find data that will help you with your project, assignment, presentation or concern.
                        </p>
                    </div><!--#col-xs-12 col-sm-4 col-sm-pull-4-->

                    <div class="col-xs-12 col-sm-4">
                        <h5><a href="<?php echo esc_url($GLOBALS['geopccb_ckan_mp_url']); ?>" target="_blank">Explore the Marketplace</a></h5>
                        <p>
                          The Marketplace facilitates collaboration on the
                          planned acquisition and production of
                          geospatial data, such as elevation and
                          bathymetric datasets. You can use this filtered
                          catalog search to determine whether a potential
                          partner is already planning to invest in data for
                          which you have a requirement.
                        </p>
                    </div><!--#col-xs-12 col-sm-4-->
                </div><!--#row-->

            </div><!--#col-xs-12 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1-->
        </div><!--#row-->
    </div><!--#conatiner-fluid-->

    <br>
    <br>

    <div class="footing">
        <div class="line-cap"></div>
        <div class="line"></div>
    </div><!--#footing-->

</div><!--#cornerstones section-linked-->


// Registers and enqueues the widget.
function geopportal_register_portal_cornerstones_widget() {
		register_widget( 'Geopportal_Cornerstones_Widget' );
}
add_action( 'widgets_init', 'geopportal_register_portal_cornerstones_widget' );
