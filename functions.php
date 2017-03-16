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
  'width' => 200,
  'height'  => 200,
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
