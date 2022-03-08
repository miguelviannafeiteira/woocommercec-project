<?php
// Template name: Home
get_header();?>
<?php
function format_products($products, $img_size){
  $products_final = [];
  foreach($products as $product){
    $products_final[]=[
      'name'=>  $product->get_name(),
      'price'=> $product->get_price_html(),
      'link'=> $product->get_permalink(),
      'img'=>  wp_get_attachment_image_src($product->get_image_id(), $img_size)[0],
    ];
  }
  return $products_final;
}
$products_slide = wc_get_products([
'limit' => 5,
'tag'=> ['slide'],
]);
$products_new = wc_get_products([
  'limit' => 6,
  'orderby'=> 'date',
  'order'=>'DESC'
]);
$products_sales = wc_get_products([
  'limit' => 6,
  'meta_key'=> 'total_sales',
  'orderby'=> 'meta_value_num',
  'order'=>'DESC'
]);
$data=[];

$data['slide']  = format_products($products_slide, 'slide');
$data['releases']  = format_products($products_new, 'medium');
$data['sales']  = format_products($products_sales, 'medium');

$home_id = get_the_ID(); // pega o ID da pagina atual
$categoria_esquerda = get_post_meta($home_id, 'categoria_esquerda', true);
$categoria_direita = get_post_meta($home_id, 'categoria_direita', true);

function get_product_category_data($category) {
  $cat = get_term_by('slug', $category, 'product_cat');
  $cat_id = $cat->term_id;
  $img_id = get_term_meta($cat_id, 'thumbnail_id', true);
  return [
    'name' => $cat->name,
    'id'=> $cat_id,
    'link' => get_term_link($cat_id, 'product_cat' ),
    'img' =>  wp_get_attachment_image_src($img_id, 'slide')[0]
  ];
}

$data['categorias'][$categoria_esquerda] = get_product_category_data($categoria_esquerda);
$data['categorias'][$categoria_direita] = get_product_category_data($categoria_direita);;

?>

<?php if(have_posts()) { while(have_posts()) { the_post()?>


<section class="slide-wrapper">
  <ul class="slide">
    <?php foreach($data['slide'] as $product){?>
    <li class="slide-item">
      <img src="<?=$product['img']?>;" alt="<?= $product['name'];?>"> 
      <div class="slide-info">
        <span class="slide-price"><?= $product['price'];?></span>
        <h2 class="slide-name"><?= $product['name'];?></h2>
        <a class="btn-link"href="<?= $product['link'];?>">Product</a>  
      </div>
  </li>
    <?php } ?>
  </ul>
</section>

<section class="container">
  <h1 class="subtitle">Releases</h1>
  <?php helo_product_list($data['releases'])?>
</section>


<section class="categorias-home">
    <?php foreach ($data['categorias'] as $categoria) { ?>
      <a href="<?= $categoria['link']?>">
        <img src="<?= $categoria['img']?>" alt="<?= $categoria['name']?>">
        <span class="btn-link link-categoria"><?= $categoria['name']?></span>
      </a>
    <?php } ?>
  </section>


<section class="container">
  <h1 class="subtitle">Best sellers</h1>
  <?php helo_product_list($data['sales'])?>
</section>



<?php } } ?>
<?php get_footer();?>
