<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package GeoPlatform_Test
 */

?>

<section class="no-results not-found">

		<h1 class="page-title"><?php esc_html_e( 'Nothing Found', 'geoplatform-ngda' ); ?></h1>


	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php
				printf(
					wp_kses(
						/* translators: 1: link to WP admin new post page. */
						__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'geoplatform-ngda' ),
						array(
							'a' => array(
								'href' => array(),
							),
						)
					),
					esc_url( admin_url( 'post-new.php' ) )
				);
			?></p>

		<?php elseif ( is_search() ) : ?>

			<h5><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'geoplatform-ngda' ); ?></h5>
			<?php
				get_search_form();

		else : ?>

			<h5><?php esc_html_e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'geoplatform-ngda' ); ?></h5>
			<?php
				get_search_form();

		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
