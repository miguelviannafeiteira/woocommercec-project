<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name')?><?php wp_title('|');?></title>
  <?php wp_head();?>
</head>
<body <?php body_class();?>>

<?php
$cart_count = WC()->cart->get_cart_contents_count();
?>

<header class="header container">
  <a href="/">HELÔ</a>
  <div class="searching">
  <form action="<?php bloginfo('url')?>/shop/" method="get">
      <input type="text" name="s" id="s" placeholder="Search" value="<?php the_search_query()?>">
      <input type="text" name="post_type" value="product" class="hidden">
      <input type="submit" id="search" value="Busca">
    </form>
  </div>
  <nav class="account">
    <a href="/my-account" class="my-account"">My Account</a>
      <a href="/cart" class="cart">cart
      <?php if($cart_count){?>
        <span class="cart-count"><?= $cart_count?></span>
        <?php } ?>
      </a>
  </nav>
</header>