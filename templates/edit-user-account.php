<?php

/*template name: Zingfit Edit User Account */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';

$currentUserID = get_current_user_id();
$currentUserData = get_user_meta($currentUserID, 'zingfit_customer_data', true);
?>

<div class="container" style="padding: 50px 20px">

    <div class="row">
        <h2>Checkout</h2>
    </div>
    <hr>

    <div class="card mb-2">
        <div class="card-body">
            <form id="usedAccountEdit" class="" method="POST" action="">
                <h3 class="card-title">EDIT MY INFO</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="firstName">
                            First Name
                            </label>
                            <div class="col-md-9">
                                <input name="firstName" required="" type="input" class="form-control " id="firstName" placeholder="" autocomplete="" value="">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="lastName">
                            Last Name
                            </label>
                            <div class="col-md-9">
                                <input name="lastName" required="" type="input" class="form-control " id="lastName" placeholder="" autocomplete="" value="">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="address">
                            Address
                            </label>
                            <div class="col-md-9">
                                <input name="address" required="" type="input" class="form-control " id="address" placeholder="" autocomplete="" value="">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="zip">
                            Zip
                            </label>
                            <div class="col-md-9">
                                <input name="zip" required="" type="input" class="form-control " id="zip" placeholder="" autocomplete="" value="">
                            </div>
                        </div>

                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="submit" class="text-uppercase d-inline-block button">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>


<?php
get_footer();
?>