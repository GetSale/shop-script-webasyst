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
    'vendor' => 1057714,
    'frontend' => true,
    'handlers' => array(
        'frontend_head' => 'frontendHead',
        'routing' => 'routing',
        'frontend_product' => 'getsale_item_view',
        'cart_add' => 'getsale_add_to_cart',
        'cart_delete' => 'getsale_del_from_cart',
        'order_action.create' => 'getsale_order',
        'singup' => 'getsale_reg',
    ),
);
