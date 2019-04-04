<?php

class ZingFit
{

    private $client_id;
    private $client_secret;
    private $apiUrl;

    public function __construct($client_id, $client_secret, $apiUrl){
        $this->client_id = $client_id;
        $this->client_secret = $client_secret;
        $this->apiUrl = $apiUrl;
    }

    public function getAuthenticate(){

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

        $url = $this->apiUrl.'oauth/token';
        $response = wp_remote_post($url, $args);

        $api_response = json_decode(wp_remote_retrieve_body($response), true);

        $is_zingfit_access_token = get_transient('zingfit_access_token');

        if (false === $is_zingfit_access_token) {
            $zingfit_access_token = $api_response['access_token'];
            $expires_in = $api_response['expires_in'];
            set_transient('zingfit_access_token', $zingfit_access_token, $expires_in);
        }

        return $api_response;
    }

    public function getRegions(){

        $zingfit_access_token = get_transient('zingfit_access_token');

        if ($zingfit_access_token) {
            $url = $this->apiUrl.'regions';
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

    public function getClassTypes(){

        $zingfit_access_token = get_transient('zingfit_access_token');
        $regions = get_option('zingfit_regions');

        if ($zingfit_access_token) {
            $url = $this->apiUrl.'classtypes';
            $args = array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $zingfit_access_token,
                    'X-ZINGFIT-REGION-ID' => '811593826090091886',
                ),
            );

            $response = wp_remote_get($url, $args);
            $classtypes = json_decode(wp_remote_retrieve_body($response), true);

            update_option("zingfit_classtypes", $classtypes);
        }

    }

    public function getSites(){

        $zingfit_access_token = get_transient('zingfit_access_token');
        $regions = get_option('zingfit_regions');
        $sites = [];

        if ($zingfit_access_token) {
            foreach ($regions as $region) {
                $url = $this->apiUrl.'sites';
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

    public function getClasses(){

        $zingfit_access_token = get_transient('zingfit_access_token');
        $optionSites = get_option('zingfit_sites');
        $regions = get_option('zingfit_regions');

        if ($zingfit_access_token) {
            foreach ($optionSites as $sites) {
                foreach ($sites as $site) {
                    $url = $this->apiUrl.'sites/' . $site['id'] . '/classes';
                    $args = array(
                        'headers' => array(
                            'Authorization' => 'Bearer ' . $zingfit_access_token,
                            'X-ZINGFIT-REGION-ID' => '811593826090091886',
                        ),
                    );

                    $response = wp_remote_get($url, $args);
                    $class = json_decode(wp_remote_retrieve_body($response), true);
                    return $class['classes'];
                }
            }
        }

    }

    public function getUserAuthenticate($username, $password, $wpUserId){
        $id = urlencode($this->client_id);
        $secret = urlencode($this->client_secret);
        $concatenated = $id . ':' . $secret;
        $encoded = base64_encode($concatenated);

        $args = array(
            'headers' => array(
                'Authorization' => 'Basic ' . $encoded,
                'Content-Type' => 'application/x-www-form-urlencoded',
            ),
            'body' => 'grant_type=password&username='.$username.'&password='.$password,
        );

        $url = $this->apiUrl.'oauth/token';
        $response = wp_remote_post($url, $args);
        $api_response = json_decode(wp_remote_retrieve_body($response), true);

        $is_zingfit_customer_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
        if (false === $is_zingfit_customer_access_token) {
            $zingfit_customer_access_token = $api_response['access_token'];
            $expires_in = $api_response['expires_in'];
            set_transient('zingfit_customer_access_token_'.$wpUserId, $zingfit_customer_access_token, $expires_in);
        }

        return $api_response;
    }

    public function getSeries($zingfit_access_token, $regionId){

        $zingfit_access_token = get_transient('zingfit_access_token');

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_access_token,
                'X-ZINGFIT-REGION-ID' => $regionId,
            )
        );
        $url = $this->apiUrl.'series';

        $response = wp_remote_get($url,$args);
        return json_decode(wp_remote_retrieve_body($response), true);

    }

    public function getRoomReserveSlots($zingfit_access_token, $regionId, $roomId)
    {
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_access_token,
                'X-ZINGFIT-REGION-ID' => $regionId,
            )
        );
        $url = $this->apiUrl.'rooms/'.$roomId;

        $response = wp_remote_get($url,$args);
        return json_decode(wp_remote_retrieve_body($response), true);
    }

    public function getSeriesOrderID($zingfit_user_access_token, $regionId, $seriesId)
    {
        $bodyData = [
            "confirmTerms" => true,
            "seriesId" => $seriesId,
            // "skuId" => [ ]
        ];

        $bodyData = json_encode($bodyData);

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            ),
            'body' => $bodyData
        );
        $url = $this->apiUrl.'orders/series/';

        $response = wp_remote_post($url,$args);
        return json_decode(wp_remote_retrieve_body($response), true);
    }

    public function getCustomerData($zingfit_user_access_token, $regionId)
    {
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            )
        );
        $url = $this->apiUrl.'account/';

        $response = wp_remote_get($url,$args);
        $data = wp_remote_retrieve_body($response);
        $userData = json_decode($data, true);

        if($userData && !array_key_exists('error', $userData)) {
            $wpUserId = get_current_user_id();
            update_user_meta($wpUserId, 'zingfit_customer_data', $userData);
        }

        return $userData;
    }

    public function chargeCreditCard($zingfit_user_access_token, $regionId, $orderId, $checkoutInfo)
    {
        $checkoutInfo = json_encode($checkoutInfo);

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            ),
            'body' => $checkoutInfo
        );
        $url = $this->apiUrl.'payments/'.$orderId.'/creditcard';

        $response = wp_remote_post($url,$args);
        return json_decode(wp_remote_retrieve_body($response), true);
    }

    public function getInstructorClasses($zingfit_access_token, $optionSites, $regions, $instructorId)
    {
        if ($zingfit_access_token) {
            foreach ($optionSites as $sites) {
                foreach ($sites as $site) {
                    $url = $this->apiUrl.'sites/' . $site['id'] . '/classes?instructorId='.$instructorId;
                    $args = array(
                        'headers' => array(
                            'Authorization' => 'Bearer '. $zingfit_access_token,
                            'X-ZINGFIT-REGION-ID' => '811593826090091886',
                        )
                    );

                    $response = wp_remote_get($url, $args);

                    $class = json_decode(wp_remote_retrieve_body($response), true);
                    return $class['classes'];
                }
            }
        }

    }

    public function updateCustomerInfo($zingfit_access_token, $regionId, $data){

        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => '811593826090091886',
            ),
            'body' => json_encode($data),
        );

        $response = wp_remote_post('https://api.zingfit.com/account', $args);
        $userdata = json_decode($response['body']);

    }

}
