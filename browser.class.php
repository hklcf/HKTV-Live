<?php

class Browser {
    public $request_cookies = '';
    public $response_cookies = '';
    public $content = '';

    /**
    * Cookie manager
    * @Description : To set or get cookies as Array or String
    */
    public function set_cookies_json($cookies) {
        $cookies_json = json_decode($cookies, true);
        $cookies_array = array();
        foreach($cookies_json as $key => $value) {
            $cookies_array[] = $key.'='.$value;
        }
        $this->request_cookies = 'Cookie: '.join('; ', $cookies_array)."\r\n";
    }

    public function set_cookies_string($cookies) {
        $this->request_cookies = 'Cookie: '.$cookies."\r\n";
    }

    private function get_cookies($http_response_header) {
        $cookies_array = array();
        foreach($http_response_header as $s) {
            if(preg_match('|^Set-Cookie:\s*([^=]+)=([^;]+);(.+)$|', $s, $parts)) {
                $cookies_array[] = $parts[1].'='.$parts[2];
            }
        }
        $this->response_cookies = 'Cookie: '.join('; ', $cookies_array)."\r\n";
    }

    /**
    * GET and POST request
    * Send a GET or a POST request to a remote URL
    */
    public function get($url) {
        $opts = array(
            'http' => array(
            'method' => 'GET',
            'header' => "Accept-language: en\r\n" .
                        $this->request_cookies
            )
        );
        $context = stream_context_create($opts);
        $this->content = file_get_contents($url, false, $context);
        $this->get_cookies($http_response_header);
        return $this->content;
    }

    public function post($url, $post_data) {
        $post_content = array();
        foreach ($post_data as $key => $value) {
            $post_content[] = $key .'='.$value;
        }

        $opts = array(
            'http' => array(
            'method' => 'GET',
            'header' => "Content-type: application/x-www-form-urlencoded\r\n" .
                        $this->request_cookies,
            'content' => join('&', $post_content),
            )
        );
        $context = stream_context_create($opts);
        $this->content = file_get_contents($url, false, $context);
        $this->get_cookies($http_response_header);
        return $this->content;
    }
}

?>
