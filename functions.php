<?php
//turn on sleeping features
//featured image support:
add_theme_support('post-thumbnails');

add_theme_support( 'post-formats', array( 'quote', 'link', 'audio', 'video',
'image', 'gallery', 'aside', 'status' ) );

add_theme_support( 'custom-background');
//don't forget to show the header image in the header.php file
add_theme_support( 'custom-header', array(
                                        'width'      => 960,
                                        'height'     => 700,
                                        'flex-width' => true,
                                        'flex-height'=> true,
));

//don't forget the custom_logo() to display it in your theme
add_theme_support( 'custom-logo', array(
  'width' => 180,
  'height'  => 50,
));

//better RSS feed links. a must-have if use a blog
add_theme_support( 'automatic-feed-links');

//improve the markup of Wordpress generated code
add_theme_support( 'html5', array('search-form', 'comment-list', 'comment-form', 'gallery', 'caption', ));

//improve title tag for SEO(feeds google :D) and inserts using the wp_head();
//remember to remove the <title> from header.php
add_theme_support('title-tag');
//no close ze php to avoid whitespace issues

/**
  * Make the excerpts better - customize the number of words and change [...]
  * @see - link back to resource (if)used
*/
function platty_ex_length(){
  if( is_search()){
    return 20; //number of words wanted in excerpt
  }else{
  return 75; //number of words wanted in excerpt
  }
}
add_filter( 'excerpt_length', 'platty_ex_length' );

function platty_readmore(){
  return ' <a href="' . get_permalink() . '" class="read-more" title="Keep Reading This Post">Read More...</a>';
}
add_filter( 'excerpt_more', 'platty_readmore' );
/**
  *Create two menu locations. display them with wp_nav_menu() in your templates
*/
function platty_menus(){
  register_nav_menus( array(
    'main_menu' => 'Main Navigation',
    'social_menu' => 'Social Media',
  ));
}
add_action( 'init', 'platty_menus');

/*
 *Helper function to handle pagination. Call in any template file.
 */
function platty_pagination(){
if( ! is_singular() ){
  //archive pagination
  if( function_exists('the_posts_pagination')){
    the_posts_pagination();
  }else{
    echo '<div class="pagination">';
  previous_posts_link( '&larr; Newer Posts');
  next_posts_link( 'Older Posts &rarr;');
  echo '</div>';
  }
}else{
  //single pagination
  echo '<div class="pagination">';
  previous_post_link( '%link', '&larr; %title'); //one older post
  next_post_link( '%link', '%title &rarr;'); //one newer post
  echo '</div>';
}
}//end of function

/*
 *Register widget Areas ( Dynamic Sidebars )
 *Call dynamic_sidebar() in your templates to display them
 */
function platty_widget_areas(){
  register_sidebar(array(
    'name'          => 'Blog Sidebar',
    'id'            => 'blog-sidebar',
    'description'   => 'Appears next to blog and archive pages',
    'before_widget' => '<section id="%S1s" class="widget %2$s"',
    'after_widget'  => '</section>',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
  ));
  register_sidebar(array(
    'name'          => 'Footer Area',
    'id'            => 'footer-area',
    'description'   => 'Appears at the bottom of every page',
    'before_widget' => '<section id="%S1s" class="widget %2$s"',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
    'after_widget'  => '</section>',
  ));
  register_sidebar(array(
    'name'          => 'Home Area',
    'id'            => 'home-area',
    'description'   => 'Appears in the middle of the home page',
    'before_widget' => '<section id="%S1s" class="widget %2$s"',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
    'after_widget'  => '</section>',
  ));
  register_sidebar(array(
    'name'          => 'Page Area',
    'id'            => 'page-area',
    'description'   => 'Appears next to static pages :)',
    'before_widget' => '<section id="%S1s" class="widget %2$s"',
    'before_title'  => '<h3 class="widgettitle">',
    'after_title'   => '</h3>',
    'after_widget'  => '</section>',
  ));
}//end of function
add_action('widgets_init', 'platty_widget_areas');

/*
 * Improve UX of replying to comments
 */
function platty_comments_reply(){
  wp_enqueue_script('comment-reply');
}
add_action( 'wp_enqueue_scripts', 'platty_comments_reply' );

/*
 * Helper function for showing prices of products. Call platty_price() in the loop
 * @return mixed. displays HTML for the price tag
 * 'price' is a custom field
 */

function platty_price(){
  global $post;
  $price = get_post_meta( $post->ID, 'price', true);
  if($price){ ?>
    <span class="price">
    <?php echo $price; ?>
    </span>
  <?php }//end of if statement
}//end of platty_price function

/*
 * Helper function for showing sizes of products. Call platty_size() in the loop
 * @return mixed. displays HTML for the price tag
 * 'price' is a custom field
 */
function platty_size(){
  global $post;
  $size = get_post_meta( $post->ID, 'size', true);
  if($size){ ?>
    <span class="size">
    <?php echo $size; ?>
    </span>
  <?php }//end of if statement
}//end of platty_size function

/**
 * Customization API additions - custom colors, fonts, layouts, etc....
 */
 add_action( 'customize_register', 'platty_customizer');
 function platty_customizer( $wp_customize ){
	 //register all sections, settings and controls here:
   
   //Second Custom Logo!
   $wp_customize->add_setting( 'secondary_logo' );
   
   $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'secondary_logo_control', array(
     'label'  =>  'Secondary Logo',
     'section'  =>  'title_tagline', //built in 'site identity' section
     'settings' =>  'secondary_logo',
   )));
   
   
	 //"accent color"
	 $wp_customize->add_setting( 'accent_color', array(
		 'default'	=>	'indianred',
	 ));
	 //user interface accent color 
	 $wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'accent_color_control', array(
		 'label'	=>	'Accent Color',
		 'section'	=>	'colors', //this one is built in!
		 'settings'	=>	'accent_color', //added above
	 )));
   //layout Options!
   $wp_customize->add_section( 'platty_layout', array(
     'title'      =>  'Layout',
     'capability' =>  'edit_theme_options',
     'priority'   =>  100,
   ) );
   
   $wp_customize->add_setting('header_size', array(
     'default'  => 'large',
   ));
   $wp_customize->add_control( new WP_Customize_Control($wp_customize, 'header_size_control', array(
     'label'    =>  'Header Height',
     'section'  =>  'platty_layout',
     'settings' =>  'header_size',
     'type'     =>  'radio',
     'choices'  =>  array(
        'small'  =>  'Small',
        'medium' =>  'Medium',
        'large'  =>  'Large',
     ),
     
   )));
 }//end platty_customizer
 /**
  * Customized CSS - This displays ze customizer changes
  */
add_action( 'wp_head', 'platty_custom_css');
function platty_custom_css(){
  switch(get_theme_mod('header_size')){
    case 'small':
      $size = '20vh';
    break;
    case 'medium':
      $size = '30vh';
    break;
    default:
      $size = '40vh';
  }//end of switch
  ?>
  <style type="text/css">
  #header .custom-logo-link {
    background-color: <?php echo get_theme_mod('accent_color'); ?>;
  }
  #header {
    border-color: <?php echo get_theme_mod('accent_color'); ?>;
  }
  @media screen and (min-width: 700px){
    #header{
      min-height: <?php echo $size; ?>;
    }
  }
  </style>
  <?php
}//end of platty_custom_css

/**
  * Helper function to show custom secondary logo
  */
function platty_secondary_logo(){
  $logo = get_theme_mod( 'secondary_logo'); //wp stores as an attachment post :)
  if($logo){
    echo wp_get_attachment_image( $logo, 'thumbnail', false, array(
      'class' =>  'secondary-logo',
    ));
  }
}//end of platty_secondary_logo
