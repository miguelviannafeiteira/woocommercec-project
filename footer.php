<footer class="footer">
<a class="logo-white"href="/">HELÔ</a>
<div class="container footer-info">
  <section>
    <h3>Pages</h3>
    <?php
      wp_nav_menu([
        'menu'=>'footer',
        'container'=>'nav',
        'container_class'=>'footer-menu'
      ]);
    ?>
  </section>
  <section>
    <h3>Social Medias</h3>
    <?php
      wp_nav_menu([
        'menu'=>'redes',
        'container'=>'nav',
        'container_class'=>'footer-redes'
      ]);
    ?>
  </section>
  <section>
    <h3>Payment Method</h3>
    <ul>
      <li>Credit Cart</li>
      <li>Bank Slip</li>
      <li>Pagseguro</li>
    </ul>
  </section>
</div>
<?php
  $countries = WC()-> countries;
  $base_address = $countries->get_base_address();
  $base_city = $countries->get_base_city();
  $base_state = $countries->get_base_state();
  $complete_adress1 = "$base_address, $base_city, $base_state";
?>
<small class="footer-copy">HELÔ &copy; <?= date('Y');?> - <?= $complete_adress1;?></small>
</footer>

<?php wp_footer(  );?>
<script src="<?= get_stylesheet_directory_uri();?>/js/slide.js"></script>
<script src="<?= get_stylesheet_directory_uri();?>/js/script.js"></script>

</body>
</html>
