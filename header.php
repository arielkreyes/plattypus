<!DOCTYPE html>
<html lang="<?php bloginfo( 'language' ); ?>">
  <head>
    <meta charset="<?php bloginfo( 'charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); //this is a hook. required for plugins admin bar to work ?>
  </head>
<body <?php body_class(); ?>>
  <!-- puts in a class for you to specify which page you are on. -->
<header role="banner" id="header" style="background-image:url(<?php header_image(); ?>)">
  <div class="header-bar">
    <?php
    if(function_exists('the_custom_logo')){
      if( has_custom_logo() ){
        the_custom_logo();
      }else{
        //show title of website
        ?>
            <h1 class="site-title"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
        <?php
      }//end of else 
    }//end of function_exists
    ?>

    <h2><?php bloginfo( 'description' ); ?></h2>
    <?php wp_nav_menu( array(
      'theme_location' => 'main_menu',
      'container' => 'nav', //div, nav or false
      'menu_class' => 'menu', //ul class="menu"
    )); ?>
    <?php get_search_form(); ?>
  </div>
</header>
<div class="wrapper">
