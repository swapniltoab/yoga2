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
                            <label class="col-md-3 col-form-label text-md-right " for="email">
                            Email
                            </label>
                            <div class="col-md-9">
                                <input name="email" required="" type="input" class="form-control " id="email" placeholder="" autocomplete="" value="<?php echo $currentUserData['username']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="password">
                            Password
                            </label>
                            <div class="col-md-9">
                                <input name="password" required="" type="input" class="form-control " id="password" placeholder="" autocomplete="" value="">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="confirm_password">
                            Confirm Password
                            </label>
                            <div class="col-md-9">
                                <input name="confirm_password" required="" type="input" class="form-control " id="confirm_password" placeholder="" autocomplete="" value="">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" >
                            First Name
                            </label>
                            <div class="col-md-9">
                                <label><?php echo $currentUserData['firstName']?></label>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right">
                            Last Name
                            </label>
                            <div class="col-md-9">
                                <label><?php echo $currentUserData['lastName']?></label>
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" for="primary_phone_number">
                            Primary Phone Number
                            </label>
                            <div class="col-md-9">
                                <input name="primary_phone_number" required="" type="input" class="form-control " id="primary_phone_number" placeholder="" autocomplete="" value="<?php echo $currentUserData['phone']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" for="secondary_phone_number">
                            Secondary Phone Number
                            </label>
                            <div class="col-md-9">
                                <input name="secondary_phone_number" required="" type="input" class="form-control " id="secondary_phone_number" placeholder="" autocomplete="" value="<?php echo $currentUserData['phone2']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" for="address">
                            Address
                            </label>
                            <div class="col-md-9">
                                <input name="address" required="" type="input" class="form-control " id="address" placeholder="" autocomplete="" value="<?php echo $currentUserData['address']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" for="address2">
                            Address 2
                            </label>
                            <div class="col-md-9">
                                <input name="address2" required="" type="input" class="form-control " id="address2" placeholder="" autocomplete="" value="<?php echo $currentUserData['address2']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" for="city">
                            City
                            </label>
                            <div class="col-md-9">
                                <input name="city" required="" type="input" class="form-control " id="city" placeholder="" autocomplete="" value="<?php echo $currentUserData['city']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="zip">
                            Zip
                            </label>
                            <div class="col-md-9">
                                <input name="zip" required="" type="input" class="form-control " id="zip" placeholder="" autocomplete="" value="<?php echo $currentUserData['zip']?>">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group required row">
                            <h2 class="col-md-3 col-form-label text-md-right">
                            Billing Info
                            </h2>
                            <div class="col-md-9">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" for="billing_first_name">
                            First Name
                            </label>
                            <div class="col-md-9">
                                <input name="billing_first_name" required="" type="input" class="form-control " id="billing_first_name" placeholder="" autocomplete="" value="<?php echo $currentUserData['firstName']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" for="billing_last_name">
                            Last Name
                            </label>
                            <div class="col-md-9">
                                <input name="billing_last_name" required="" type="input" class="form-control " id="billing_last_name" placeholder="" autocomplete="" value="<?php echo $currentUserData['lastName']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right" for="billing_address">
                            Address
                            </label>
                            <div class="col-md-9">
                                <input name="billing_address" required="" type="input" class="form-control " id="billing_address" placeholder="" autocomplete="" value="<?php echo $currentUserData['billingAddress']?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="billing_zip">
                            Zip
                            </label>
                            <div class="col-md-9">
                                <input name="billing_zip" required="" type="input" class="form-control " id="billing_zip" placeholder="" autocomplete="" value="<?php echo $currentUserData['billingZip']?>">
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
                                <button type="submit" class="text-uppercase d-inline-block button" id="js-update-user-btn">Update</button>
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