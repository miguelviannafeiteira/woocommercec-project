<?php get_header();?>

<?php
  $products = [];

if(have_posts()) { while(have_posts()) { the_post();
  $products[] =wc_get_product( get_the_ID());
} }

$data = [];

$data['products'] = format_products($products);
?>

<div class="container breadcrumb">
<?php woocommerce_breadcrumb(['delimiter' => ' > '])?>
</div>

<article class="container products-archive">
  <nav class="filtros">
    <h2>Filtors</h2>
  </nav>
  <main>
    <?php if($data['products'][0]) { ?>
    <?php helo_product_list($data['products']);?>
    <?= get_the_posts_pagination()?>
    <?php } else {?>
      
     <p> Nenhum resultado para a sua busca. </p>
    <?php }?>
  </main>
</article>
<?php get_footer();?> 