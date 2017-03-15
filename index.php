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
    <?php the_post_thumbnail( 'thumbnail' ); ?>
    <div class="entry-content">
      <?php if( is_singular() ){
        //single post, page, attachment, etc
        the_content();
      }else{
        the_excerpt();
      }//end of else ?>
    </div>
    <div class="postmeta">
      <span class="author">by:<?php the_author(); ?> </span>
      <span class="date"><?php the_date(); ?></span>
      <span class="num-comments"><?php comments_number(); ?> </span>
      <span class="categories">
        <?php the_category(); ?>
      </span>
      <span class="tags"><?php the_tags(); ?></span>
    </div>
    <!-- end .postmeta -->
  </article>
  <?php
    } //end of while loop
    comments_template();
  } //end of if statement
  else{
    echo 'Sorry, no posts to show';
  } ?>
  <!-- end post -->
</main>
<!-- end #content -->

<?php get_sidebar();//including the sidebar :) ?>
<?php get_footer();//including the footerrr :D?>
