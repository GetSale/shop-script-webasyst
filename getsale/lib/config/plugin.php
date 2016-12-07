<?php

return array(
    'name' => 'Getsale Popup',
    'img'=>'img/getsale.png',
    'shop_settings' => true,
    'version' => '1.0.0',
    'vendor' => 1057714,
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
