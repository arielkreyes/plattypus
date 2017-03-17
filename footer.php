</div>
<!-- end .wrapper -->

<footer id="footer" role="contentinfo">
  <?php wp_nav_menu( array(
    'theme_location'  => 'social_menu',
    'fallback_cb'     => 'false', //no fallback list_pages
  )); ?>
  <small>
    &copy; 2017 by SITE TITLE. All Rights Reserved.
  </small>
</footer>
<?php wp_footer();//zis is a hook. required for plugins and admin bar to work ?>
</body>
</html>
