
<!--include header area-->
<?php get_header(); ?>

<!--Sectioning of pages, the Loop setup, pagination, and general flow of a lot of this theme came from
https://www.taniarascia.com/developing-a-wordpress-theme-from-scratch/ -->
<?php get_template_part( 'mega-menu', get_post_format() ); ?>
  <!--GeoPlatform header with intro -->
<?php get_template_part( 'gp_intro', get_post_format() ); ?>

<?php if ( is_active_sidebar( 'geoplatform-widgetized-page' ) ) : ?>
    <div id="widgetized-page">
      <?php dynamic_sidebar( 'geoplatform-widgetized-page' ); ?>
    </div><!-- widgetized-area -->
<?php endif; ?>

<!--Footer section-->
<?php get_footer(); ?>
