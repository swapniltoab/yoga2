<?php

$zingfit_client_id = $settings['general']["zingfit_client_id"];
$zingfit_client_secret = $settings['general']["zingfit_client_secret"];
$zingfit_tenant_id = $settings['general']["zingfit_tenant_id"];
$zingfit_api_url = $settings['general']["zingfit_api_url"];
$zingfit_access_token = get_transient('zingfit_access_token');

?>

<tr>
    <th scope="row">
        <label for="zingfit-client-id">Client ID:</label>
    </th>

    <td>
        <input type="text" id="zingfit_client_id" class="zingfit_textbox" name="zingfit_client_id" value="<?php echo esc_html(stripslashes($zingfit_client_id)); ?>"/><br/>
        <br>
        <span class="description"></span>
    </td>
</tr>

<tr class="seperater-tr">
    <th scope="row">
        <label for="zingfit-client-secret">Client Secret:</label>
    </th>

    <td>
        <input type="text" id="zingfit_client_secret" class="zingfit_textbox" name="zingfit_client_secret" value="<?php echo esc_html(stripslashes($zingfit_client_secret)); ?>"/><br/>
        <br>
        <span class="description"></span>
    </td>
</tr>

<tr class="seperater-tr">
    <th scope="row">
        <label for="zingfit-tenant-id">Tenant ID:</label>
    </th>

    <td>
        <input type="text" id="zingfit_tenant_id" class="zingfit_textbox" name="zingfit_tenant_id" value="<?php echo esc_html(stripslashes($zingfit_tenant_id)); ?>"/><br/>
        <br>
        <span class="description"></span>
    </td>
</tr>

<tr class="seperater-tr">
    <th scope="row">
        <label for="zingfit-api-url">API URL:</label>
    </th>

    <td>
        <input type="text" id="zingfit_api_url" class="zingfit_textbox" name="zingfit_api_url" value="<?php echo esc_html(stripslashes($zingfit_api_url)); ?>"/><br/>
        <br>
        <span class="description"></span>
    </td>
</tr>

<?php
if($zingfit_client_id && $zingfit_client_secret && $zingfit_api_url) :
?>

<tr class="seperater-tr">
    <th scope="row">
        <a href="javscript:void(0)" class="zingfit_button" id="js-zingfit-generate-access-token" >Generate Access Token</a>
    </th>
</tr>

<tr class="seperater-tr">
    <th scope="row">
        <label for="zingfit-access-token">Access Token:</label>
    </th>

    <td>
        <input type="text" id="zingfit_access_token" class="zingfit_textbox" value="<?php echo esc_html(stripslashes($zingfit_access_token)); ?>" readonly/><br/>
        <br>
        <span class="description"></span>
    </td>
</tr>

<tr class="seperater-tr">
    <th scope="row">
        <label for="zingfit-access-token">ZingFit Region:</label>
    </th>

    <td>
        <button type="button" class="js-updateZingfitRegions" id="updateZingfitRegions">Update Regions</button>
        <span class="description">To update regions from zingfit user portal to sinc</span>
    </td>
</tr>

<tr class="seperater-tr">
    <th scope="row">
        <label for="zingfit-access-token">ZingFit Sites:</label>
    </th>

    <td>
        <button type="button" class="js-updateZingfitSites" id="updateZingfitSites">Update Sites</button>
        <span class="description">To update sites from zingfit user portal to sinc</span>
    </td>
</tr>

<tr class="seperater-tr">
    <th scope="row">
        <label for="zingfit-access-token">ZingFit Gateways:</label>
    </th>

    <td>
        <button type="button" class="js-updateZingfitGateways" id="updateZingfitGateways">Update Gateways</button>
        <span class="description">To update gateways from zingfit user portal to sinc</span>
    </td>
</tr>

<?php
endif;
?>
