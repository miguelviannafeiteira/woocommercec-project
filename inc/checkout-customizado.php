<?php

function helo_custom_checkout($fields){
  // $fields['billing']['billing_first_name']['label']= 'Primeiro nome';
  unset($fields['billing']['billing_phone']);

  $fields['billing']['billing_presente'] =  [
    'label'=> "It's a gift?",
    'required'=> false,
    'class'=> ['form-row-wide'],
    'clear'=> true,
    'type' => 'select',
    'options'=>  [
      'no' => 'No',
      'yes' => 'Yes',
    ]
  ];

//  print_r($fields)
  return  $fields;
};
add_filter('woocommerce_checkout_fields', 'helo_custom_checkout');

// função para adicionar na tela de admin  se a 
// pessoa marcou sim ou nao no campo de presente
function show_admin_custom_checkout_presente($order){
  // pra pegar o meta dado do pedido
  $presente  = get_post_meta($order->get_id(), '_billing_presente', true);
  echo '<p><strong>Presente: </strong>' . $presente .'</p>';
};
add_action('woocommerce_admin_order_data_after_shipping_address', 'show_admin_custom_checkout_presente');
// termina aqui


// adiciona o campo para mensagem
function helo_custom_checkout_field($checkout){
  woocommerce_form_field( 'mensagem_personalizada',[
    'type'=> 'textarea',
    'class' => ['form-row-wide mensagem-personalizada'],
    'label'  => 'Personalized Message',
    'placeholder' => 'Write a mesage for te person that you are gifting',
    'required' => false,
  ], $checkout->get_value('mensagem_personalizada') );
};
add_action('woocommerce_after_order_notes', 'helo_custom_checkout_field');

// adicionar ao banco de dados
function helo_custom_checkout_field_update($order_id){
  if(!empty($_POST['mensagem_personalizada'])){
    update_post_meta($order_id, 'mensagem_personalizada', sanitize_text_field($_POST['mensagem_personalizada']));
  }
};
add_action('woocommerce_checkout_update_order_meta', 'helo_custom_checkout_field_update');

function show_admin_custom_checkout_mensagem($order){
  // pra pegar o meta dado do pedido
  $mensagem  = get_post_meta($order->get_id(), 'mensagem_personalizada', true);
  echo '<p><strong>Mensagem: </strong>' . $mensagem .'</p>';
};
add_action('woocommerce_admin_order_data_after_shipping_address', 'show_admin_custom_checkout_mensagem');

add_filter('woocommerce_enable_order_notes_field', '__return_false');

?>