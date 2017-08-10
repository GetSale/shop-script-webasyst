<?php

class shopGetsalePluginBackendSaveController extends waJsonController {

    public function execute() {
        try {
            $getsale = wa()->getPlugin('getsale');
            $email = waRequest::post('email', '', waRequest::TYPE_STRING_TRIM);
            $api_key = waRequest::post('api_key', '', waRequest::TYPE_STRING_TRIM);
            //Save
            $getsale->saveSettings(array('email' => $email, 'api_key' => $api_key));

            if (empty($email)) throw new waException(_w('Не указан Email!'));
            if (empty($api_key)) throw new waException(_w('Не указан Ключ API!'));

            $url = wa()->domainUrl();
            $projectID = $this->get($url, $email, $api_key);
            $projectID = json_decode($projectID);
            if (is_object($projectID) && $projectID->status = 'Error') {
                switch ($projectID->code) {
                    case 403:
                        throw new waException(_w('403 Error'));
                    case 500:
                        throw new waException(_w('500 Error'));
                    case 404:
                        throw new waException(_w('404 Error'));
                    case 0:
                        throw new waException(_w('No Curl!'));
                }
            }

            $getsale->saveSettings(array('id' => $projectID->payload->projectId));
            $this->response['message'] = _w('Success');
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    public function isUserAgentBanned($user_agent) {
        if (!$user_agent) return true;
        $re = "/bot|crawl(er|ing)|google|yandex|rambler|yahoo|bingpreview|alexa|facebookexternalhit|bitrix/i";

        $matches = array();
        preg_match($re, $user_agent, $matches);

        if (count($matches) > 0) return true; else
            return false;
    }

    public function get($url, $email = '', $key = '') {
        if ($this->isUserAgentBanned(waRequest::server('HTTP_USER_AGENT'))) return true;

        if (!function_exists('curl_init')) {
            $json_result = '';
            $json_result->status = 'error';
            $json_result->code = 0;
            $json_result->message = 'No Curl!';
            return json_encode($json_result);
        };

        $domain = 'https://getsale.io';
        $ch = curl_init();
        $jsondata = json_encode(array('email' => $email, 'key' => $key, 'url' => rawurldecode($url), 'cms' => 'shopscript'));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json', 'Accept: application/json'));
        curl_setopt($ch, CURLOPT_URL, $domain . "/api/registration.json");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsondata);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec($ch);

        $json_result = json_decode($server_output);
        $this->error = curl_error($ch);

        if (empty($server_output)) {
            $info = curl_error($ch);
        }

        curl_close($ch);

        if (!empty($info)) {
            return $info;
        }
        return json_encode($json_result);
    }

}