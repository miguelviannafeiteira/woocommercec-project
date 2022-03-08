<?php

require_once get_template_directory() . '/cmb2/load.php';

register_nav_menus([
  'categorias'=>'Categorias'
  ]);
  
//  da suporte ao tema do woocommerce 
function helo_add_woocommerce_support(){
  add_theme_support( 'woocommerce' );
}
add_action('after_setup_theme','helo_add_woocommerce_support');

// puxando o style.css
// melhor q  puxar no header
// get_template_directory_uri() . '/style.css pra pegar a pasta
// enqueue pra colocar na fila
function helo_css(){
  wp_register_style('helo-style', get_template_directory_uri() . '/style.css', [], '1.0.0', false);
  wp_enqueue_style('helo-style');
}
add_action('wp_enqueue_scripts', 'helo_css');

function helo_custom_images(){
  add_image_size('slide', 1000, 800, ['center', 'top']);
  update_option('medium_crop', 1);
};
add_action('after_setup_theme', 'helo_custom_images');

function helo_loop_shop_per_page(){
  return 5;
}
add_filter('loop_shop_per_page','helo_loop_shop_per_page');
function helo_product_list($products){
?>
  <ul class="products-list">
    <?php foreach($products as $product) {?>
      <li class="product-item">
        <a href="<?= $product['link']?>">
          <div class="product-info">
            <img src="<?= $product['img']?>" alt="<?= $product['name']?>">
            <h2><?= $product['name']?> - <span><?= $product['price']?></span></h2>
          </div>
          <div class="product-overlay">
            <span class="btn-link">Ver Mais</span>
          </div>
        </a>  
    </li>
    <?php } ?>
  </ul>
<?php
};

?>