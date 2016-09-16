<?php

return array(
    'name' => 'Getsale',
    'description' => 'профессиональный инструмент для создания popup-окон',
    'img'=>'img/getsale.png',
    'icons'=>array(
        16 => 'img/getsale.png'
    ),
    'shop_settings' => true,
    'version' => '1.0',
    'vendor' => 'GetSale Team',
    'frontend' => true,
    'handlers' => array(
        'frontend_head' => 'frontendHead',
        'frontend_footer' => 'frontendFooter',
        // emulate cart_set_quantity and cart_add event
        'routing' => 'routing',
        'cart_add' => 'update_cart',
        //'cart_set_quantity' => 'update_cart',
        'cart_delete' => 'update_cart',
        'order_action.create' => 'purchase',
        'frontend_product' => 'view_product'
    ),
);
