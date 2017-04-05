<?php get_header();//including the header.php - wp function ?>

<main id="content">
  <?php if( have_posts() ){
    while( have_posts() ){
      the_post();
  ?>
  <article <?php post_class(); ?>>
    <h2 class="entry-title">
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h2>
    <?php the_terms($post->ID, 'brand', '<h3>', ', ', '</h3>'); ?>
    <?php the_post_thumbnail( 'large' ); ?>
    <div class="entry-content">
      <?php platty_price(); ?>
      <?php platty_size(); ?>
      <?php the_content(); ?>
      <?php the_terms($post->ID, 'feature', '<h3>', ', ', '</h3>'); ?>
    </div>
  </article>
  <?php
    } //end of while loop
    platty_pagination();
    //TODO: make a template for showing "reviews" :D
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
