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
            return $regions;
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
            return $classtypes;
        }

    }

    public function getAllInstructors(){

        $zingfit_access_token = get_transient('zingfit_access_token');
        $regions = get_option('zingfit_regions');

        if ($zingfit_access_token) {
            $url = $this->apiUrl.'instructors';
            $args = array(
                'headers' => array(
                    'Authorization' => 'Bearer ' . $zingfit_access_token,
                    'X-ZINGFIT-REGION-ID' => '811593826090091886',
                ),
            );

            $response = wp_remote_get($url, $args);
            $allInstructors = json_decode(wp_remote_retrieve_body($response), true);
            return $allInstructors;
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
            return $site;
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

    public function registerUser($param){

        $zingfit_access_token = get_transient('zingfit_access_token');
        $url = $this->apiUrl.'account';
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => '811593826090091886',
            ),
            'body' => json_encode($param),
        );

        $response = wp_remote_post($url, $args);

        return $response;
    }

    public function getGateways($zingfit_access_token, $regionId)
    {
        $url = $this->apiUrl.'gateways';
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_access_token,
                'X-ZINGFIT-REGION-ID' => $regionId,
            )
        );

        $response = wp_remote_get($url,$args);
        $api_response = json_decode(wp_remote_retrieve_body($response), true);

        update_option("zingfit_gateways", $api_response);

        return $api_response;
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

        $zingfit_customer_access_token = $api_response['access_token'];
        $expires_in = $api_response['expires_in'];
        set_transient('zingfit_customer_access_token_'.$wpUserId, $zingfit_customer_access_token, $expires_in);

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

    public function getBookableClassDetail($zingfit_user_access_token, $regionId, $classId)
    {
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'X-ZINGFIT-REGION-ID' => $regionId,
            )
        );
        $url = $this->apiUrl.'classes/'.$classId.'/spots/details';

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

    public function updateCustomerInfo($zingfit_user_access_token, $regionId, $data)
    {
        $url = $this->apiUrl.'account';
        $args = array(
            'method'     => 'PUT',
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => '811593826090091886',
            ),
            'body' => json_encode($data),
        );

        $response = wp_remote_post($url, $args);
        $userdata = json_decode($response['body']);
        return $userdata;
    }

    public function getCustomerCardsOfFile($zingfit_user_access_token, $regionId)
    {
        $url = $this->apiUrl.'account/cardsonfile';
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            ),
        );

        $response = wp_remote_get($url, $args);
        $userCardsData = json_decode($response['body']);
        return $userCardsData;
    }

    public function saveCustomerCreditCard($zingfit_user_access_token, $regionId, $data)
    {
        $data = json_encode($data);

        $url = $this->apiUrl.'account/cardsonfile';
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            ),
            'body' => $data
        );

        $response = wp_remote_post($url, $args);
        $userCardsData = json_decode($response['body']);
        return $userCardsData;
    }

    public function getCustomerMySeriesActive($zingfit_user_access_token, $regionId)
    {
        $url = $this->apiUrl.'account/series';
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            ),
        );

        $response = wp_remote_get($url, $args);
        $CustomerActiveMySeries = json_decode($response['body']);
        return $CustomerActiveMySeries;
    }

    public function getCustomerMyAttendance($zingfit_user_access_token, $regionId)
    {
        $url = $this->apiUrl.'account/classes?page=0&size=100';
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            ),
        );

        $response = wp_remote_get($url, $args);
        $CustomerMyAttendance = json_decode($response['body']);
        return $CustomerMyAttendance;
    }

    public function getCustomerMySeriesExpired($zingfit_user_access_token, $regionId)
    {
        $url = $this->apiUrl.'account/series/expired';
        $args = array(
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            ),
        );

        $response = wp_remote_get($url, $args);
        $CustomerExpiredMySeries = json_decode($response['body']);
        return $CustomerExpiredMySeries;
    }

    public function customerBookSpot($zingfit_user_access_token, $regionId, $classId, $data)
    {

        $url = $this->apiUrl.'classes/'.$classId.'/spots';
        $args = array(
            'method'     => 'PUT',
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => $regionId,
            ),
            'body' => json_encode($data),
        );

        $response = wp_remote_post($url, $args);
        $bookSpot = json_decode($response['body']);
        return $bookSpot;
    }

    public function deleteCustomerCard($zingfit_user_access_token, $regionId, $cardId)
    {
        $url = $this->apiUrl.'account/cardsonfile/'.$cardId;
        $args = array(
            'method'     => 'DELETE',
            'headers' => array(
                'Authorization' => 'Bearer ' . $zingfit_user_access_token,
                'Content-Type' => 'application/json;charset=UTF-8',
                'X-ZINGFIT-REGION-ID' => '811593826090091886',
            ),
        );

        $response = wp_remote_post($url, $args);
        $deleteCard = json_decode($response['body']);
        return $deleteCard;
    }
}
