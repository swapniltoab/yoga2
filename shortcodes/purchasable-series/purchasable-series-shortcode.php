<?php

class ZingFit_Purchasable_Series_Shortcode
{

    public function __construct()
    {
        $this->define_admin_hooks();
    }

    private function define_admin_hooks()
    {
        add_shortcode('zingfit_purchasable_series', array($this, 'zingfit_purchasable_series_callback'));
    }

    public function zingfit_purchasable_series_callback($args)
    {
        global $zingfit;
        $regions = get_option('zingfit_regions');
        $zingfit_access_token = get_transient('zingfit_access_token');
        $regionId = '811593826090091886';

        if ($zingfit_access_token) {
            $serieses = $zingfit->getSeries($zingfit_access_token, $regionId);
        }

        ob_start();
        include 'tpl/template.php';
        return ob_get_clean();

    }

}
