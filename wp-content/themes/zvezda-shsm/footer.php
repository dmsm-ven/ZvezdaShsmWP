</main>
<footer class="site-footer">
  <div class="container">
    <p>© <?php echo esc_html(date('Y')); ?> ФК «Звезда ШСМ»</p>
    <?php wp_nav_menu(['theme_location' => 'primary', 'container' => false, 'fallback_cb' => false]); ?>
  </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
