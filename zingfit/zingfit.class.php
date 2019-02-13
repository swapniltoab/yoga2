<?php

class ZingFit
{

    private $client_id;
    private $client_secret;
    private $apiUrl;

    public function __construct($client_id, $client_secret, $apiUrl)
    {
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->apiUrl = $apiUrl;
    }

    public function getAuthenticate()
    {

        $id = urlencode($this->client_id);
        $secret = urlencode($this->client_secret);
        $concatenated = $id . ':' . $secret;
        $encoded = base64_encode($concatenated);

        $args = array(
            'headers' => array(
                'Authorization' => 'Basic ' . $encoded,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ),
            'body' => 'grant_type=client_credentials',
        );

        $response = wp_remote_post($this->apiUrl, $args);

        $api_response = json_decode(wp_remote_retrieve_body($response), true);

        error_log('$response --- ' . print_r($api_response['access_token'], 1));
    }
}
