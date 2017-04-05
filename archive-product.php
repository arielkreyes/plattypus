<?php get_header();//including the header.php - wp function ?>

<main id="content" class="product-grid">
  <?php if( have_posts() ){
    while( have_posts() ){
      the_post();
  ?>
  <article <?php post_class(); ?>>
    <a href="<?php the_permalink(); ?>">
    <?php the_post_thumbnail( 'thumbnail' ); ?>
      <div class="caption">
        <h2><?php the_title(); ?></h2>
          <?php the_terms($post->ID, 'brand', '<h3>', ', ', '</h3>'); ?>
          <?php the_terms($post->ID, 'feature', '<h4>', ', ', '</h4>'); ?>
          <?php platty_price(); ?>
          <?php the_excerpt(); ?>    
      </div>
    </a>
  </article>
  <!-- end of Post -->
  <?php
    } //end of while loop
    platty_pagination();
    comments_template( '/comments.php', true);
  } //end of if statement
  else{
    echo 'Sorry, no posts to show';
  } ?>
  <!-- end post -->
</main>
<!-- end #content -->

<?php get_sidebar('shop');//including the sidebar :) ?>
<?php get_footer();//including the footerrr :D?>
