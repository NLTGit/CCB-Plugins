<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Bootstrap core CSS
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />

    <!--http://themefoundation.com/wordpress-theme-customizer/ section 5.2 Radio Buttons-->
    <?php
    $font_choice = get_theme_mod( 'font_choice' );
    if( $font_choice != '' ) {
        switch ( $font_choice ) {
            case 'lato':
                echo '<style type="text/css">';
                echo "body { font-family: 'Lato', sans-serif !important;}";
                echo '</style>';
                break;
            case 'slabo':
                echo '<style type="text/css">';
                echo "body { font-family: 'Slabo 27px', serif !important; }";
                echo '</style>';
                break;
            //add more cases for more fonts later
        }
    }
?>

    <?php wp_head();?>
  </head>
<body>

  <!--  <% heading= '' %> -->

    <!-- code from partials/header.ejs -->
      <header class="t-transparent">
    <?php if ( is_page_template('page-templates/page_style-guide.php')) { ?>

      <?php } else{?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <ul role="menu" class="header__menu">
                    <li>
                        <!-- mega menu toggle -->
                        <div class="btn-group">
                            <button type="button" class="btn btn-link header__btn dropdown-toggle"
                                    data-toggle="dropdown" data-target="#megamenu" aria-expanded="false">
                                <span class="icon-hamburger-menu t-light"></span>
                                <span class="hidden-xs">Menu <span class="caret"></span></span>
                            </button>
                        </div>
                    </li>

                    <!-- login button toggle -->
                    <!-- Disable for now, re-enable for authentication -->
                    <li class="hidden-xs">


                        <div class="btn-account btn-group">

                            <!-- <% if(!authenticated) { %> -->
                            <!-- <?php if (!is_user_logged_in()){?>
                              <a href="<?php echo wp_login_url( get_option('siteurl') ); ?>">
                                  <button style="color:white;" type="button" class="btn btn-link">Sign In</button>
                                </a>
                          <?php  } else {
	                        $current_user = wp_get_current_user(); ?>
                            <a href="<?php echo wp_logout_url( home_url() ); ?>">
                                <button style="color:white;" type="button" class="btn btn-link">Sign out</button>
                              </a>
                            <?php } ?> -->
                            <a href="<?php echo esc_url($GLOBALS['geopccb_accounts_url']);?>">My Account</a>
                        </div>
                    </li>
                </ul>
                <h4 class="brand">
                  <a href="/" title="Go to the Geoplatform Home Page">
                      <span class="icon-gp"></span>
                      GeoPlatform <?php //if (is_user_logged_in()){ echo $current_user->display_name; }?>
                    </li>
                  </a>
                  <!-- This will be the "Site Title" in the Customizer Site Identity tab -->
<!--
                  <a href="/" title="Go to the <?php echo get_bloginfo( 'name' ); ?> Home Page">
                  <?php //echo get_bloginfo( 'name' ); ?>
-->
                </a>
                </h4>

            </div>
        </div>
  <?php } ?>

</header>
