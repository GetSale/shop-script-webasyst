<?php

class shopGetsalePluginSettingsAction extends waViewAction {

    public function execute() {
        $getsale = wa()->getPlugin('getsale');
        $this->view->assign('exist_curl', function_exists('curl_exec'));
        $this->view->assign('email', $getsale->getSettings('email'));
        $this->view->assign('api_key', $getsale->getSettings('api_key'));
        $this->view->assign('id', $getsale->getSettings('id'));
    }
}
