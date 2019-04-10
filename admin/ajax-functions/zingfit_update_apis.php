<?php

function zingfit_update_regions()
{
    global $zingfit;
    $response = $zingfit->getRegions();

    if (array_key_exists('error',$response) && $response['error']) {
        echo json_encode(array('status' => false, 'message' => $response['error']));
    } else {
        echo json_encode(array('status' => true, 'message' => 'Regions Updated successfully.'));
    }
    die();
}
 add_action('wp_ajax_zingfit_update_regions', 'zingfit_update_regions');



 function zingfit_update_sites()
{
    global $zingfit;
    $response = $zingfit->getSites();

    if (array_key_exists('error',$response) && $response['error']) {
        echo json_encode(array('status' => false, 'message' => $response['error']));
    } else {
        echo json_encode(array('status' => true, 'message' => 'Sites Updated successfully.'));
    }
    die();
}
 add_action('wp_ajax_zingfit_update_sites', 'zingfit_update_sites');
