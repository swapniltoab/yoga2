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

        $is_zingfit_access_token = get_transient('zingfit_access_token');

        if (false === $is_zingfit_access_token) {
            $zingfit_access_token = $api_response['access_token'];
            $expires_in = $api_response['expires_in'];
            // $expires_in = '120';
            set_transient('zingfit_access_token', $zingfit_access_token, $expires_in);
        }

        return $api_response;
    }

    public function getRegions()
    {

        $zingfit_access_token = get_transient('zingfit_access_token');

        if ($zingfit_access_token) {
            $url = 'https://api.zingfit.com/regions';
            $args = array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $zingfit_access_token,
                ),
            );

            $response = wp_remote_get($url, $args);
            $regions = json_decode(wp_remote_retrieve_body($response), true);

            update_option("zingfit_regions", $regions);
        }

    }

    public function getSites()
    {

        $zingfit_access_token = get_transient('zingfit_access_token');
        $regions = get_option('zingfit_regions');
        $sites = [];

        if ($zingfit_access_token) {
            foreach ($regions as $region) {
                $url = 'https://api.zingfit.com/sites';
                $args = array(
                    'headers' => array(
                        'Authorization' => 'Bearer ' . $zingfit_access_token,
                        'X-ZINGFIT-REGION-ID' => $region['id'],
                    ),
                );

                $response = wp_remote_get($url, $args);
                $site = json_decode(wp_remote_retrieve_body($response), true);
                array_push($sites, $site);
            }
            update_option("zingfit_sites", $sites);
        }
    }

    public function getClasses()
    {

        $zingfit_access_token = get_transient('zingfit_access_token');
        $optionSites = get_option('zingfit_sites');
        $regions = get_option('zingfit_regions');
        // $classes = [];

        if ($zingfit_access_token) {
            foreach ($optionSites as $sites) {
                foreach ($sites as $site) {
                    $url = 'https://api.zingfit.com/sites/'.$site['id'].'/classes';
                    $args = array(
                        'headers' => array(
                            'Authorization' => 'Bearer ' . $zingfit_access_token,
                            'X-ZINGFIT-REGION-ID' => '811593826090091886',
                        )
                    );

                    $response = wp_remote_get($url, $args);
                    $class = json_decode(wp_remote_retrieve_body($response), true);
                    //print_r($response);
                    // error_log('$class$class$class ..... '.print_r($class,1));
                    //print_r($class);
                    return $class['classes'];
                    // array_push($classes, $class);
                }
            }
        }

    }
}
