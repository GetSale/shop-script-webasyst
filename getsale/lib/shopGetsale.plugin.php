<?php

class shopGetsalePlugin extends shopPlugin {

    public function frontendHead() {
        $head = $this->widget();
        return $head;
    }

    public static function widget() {
        $plugin = wa('shop')->getPlugin('getsale');
        $settings = $plugin->getSettings();
        if (isset($settings) and !empty($settings['id'])) {
            $getsale_id = $settings['id'];
        } else return "<script>alert('getsale is not install!')</script>";
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
                s.src = \"//rt.edge.getsale.io/loader.js\";

                if (w.opera == \"[object Opera]\") {
                    d.addEventListener(\"DOMContentLoaded\", f, false);
                } else { f(); }

                })(document, window, \"getSaleInit\");
            </script>
            <!-- /GetSale Widget -->";
        return $getsale_code;
    }
}
