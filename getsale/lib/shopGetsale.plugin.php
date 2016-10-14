<?php

class shopGetsalePlugin extends shopPlugin {

    public function routing($route = array()) {
        $uri = waRequest::server('REQUEST_URI');
        if (strpos($uri, 'add') !== false) {
            $this->getsale_add_to_cart();
        }
        if (strpos($uri, 'signup') !== false) {
            $reg = waRequest::post('data');
            if($reg && !empty($reg['firstname']) && !empty($reg['email']) && !empty($reg['password']) && !empty($reg['password_confirm']) && strpos(wa()->getConfig()->getCurrentUrl(), 'signup')){
                $validator = new waEmailValidator();
                if($validator->isValid($reg['email']))
                    wa()->getResponse()->setCookie('getsale_reg', 'Y', time() + 30 * 86400, null, '', false, true);
            }
        }
    }

    public function frontendHead() {
        $head = $this->widget();
        $head .= "\n<!-- GetSale Plugin -->\n";
        if (waRequest::cookie('getsale_add') && waRequest::cookie('getsale_add') == 'Y') {
            $this->addJs('js/add.js', true);
            wa()->getResponse()->setCookie('getsale_add', 'N', time() + 30 * 86400, null, '', false, true);
        }
        if (waRequest::cookie('getsale_del') && waRequest::cookie('getsale_del') == 'Y') {
            $this->addJs('js/del.js', true);
            wa()->getResponse()->setCookie('getsale_del', 'N', time() + 30 * 86400, null, '', false, true);
        }
        if (waRequest::cookie('getsale_order') && waRequest::cookie('getsale_order') == 'Y') {
            $this->addJs('js/order.js', true);
            wa()->getResponse()->setCookie('getsale_order', 'N', time() + 30 * 86400, null, '', false, true);
        }
        if (waRequest::cookie('getsale_reg') && waRequest::cookie('getsale_reg') == 'Y') {
            $this->addJs('js/reg.js', true);
            wa()->getResponse()->setCookie('getsale_reg', 'N', time() + 30 * 86400, null, '', false, true);
        }
        if (strpos(wa()->getConfig()->getCurrentUrl(), 'category')) {
            $this->addJs('js/cat.js', true);
        }
        $head .= "\n<!-- GetSale Plugin -->\n";
        return $head;
    }

    public function getsale_del_from_cart() {
        wa()->getResponse()->setCookie('getsale_del', 'Y', time() + 30 * 86400, null, '', false, true);
    }

    public function getsale_reg() {
        wa()->getResponse()->setCookie('getsale_reg', 'Y', time() + 30 * 86400, null, '', false, true);
    }

    public function getsale_item_view() {
        $this->addJs('js/item.js', true);
    }

    public function getsale_order() {
        wa()->getResponse()->setCookie('getsale_order', 'Y', time() + 30 * 86400, null, '', false, true);
    }

    public function getsale_add_to_cart() {
        wa()->getResponse()->setCookie('getsale_add', 'Y', time() + 30 * 86400, null, '', false, true);
    }

    public static function widget() {
        $plugin = wa('shop')->getPlugin('getsale');
        $settings = $plugin->getSettings();
        if (isset($settings) and !empty($settings['id'])) {
            $getsale_id = $settings['id'];
            $getsale_code = "<!-- GetSale Widget -->
            <script type=\"text/javascript\">
            (function(d, w, c) {
                w[c] = {
                    projectId: " . $getsale_id . "
                };

                var n = d.getElementsByTagName(\"script\")[0],
                s = d.createElement(\"script\"),
                f = function () { n.parentNode.insertBefore(s, n); };
                s.type = \"text/javascript\";
                s.async = true;
                s.src = \"//rt.getsale.io/loader.js\";

                if (w.opera == \"[object Opera]\") {
                    d.addEventListener(\"DOMContentLoaded\", f, false);
                } else { f(); }

                })(document, window, \"getSaleInit\");
            </script>
            <!-- /GetSale Widget -->";
            return $getsale_code;
        }
    }
}
