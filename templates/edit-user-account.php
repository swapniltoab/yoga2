<?php

/*template name: Zingfit Edit User Account */

if(is_user_logged_in()){

get_header(); ?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php $regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';

$currentUserID = get_current_user_id();
$currentUserData = get_user_meta($currentUserID, 'zingfit_customer_data', true);

$states = [
    "AL" => "Alabama", "AK" => "Alaska", "AZ" => "Arizona", "AR" => "Arkansas", "CA" => "California", "CO" => "Colorado", "CT" => "Connecticut",
    "DE" => "Delaware", "DC" => "District Of Columbia", "FL" => "Florida", "GA" => "Georgia", "HI" => "Hawaii", "ID" => "Idaho", "IL" => "Illinois",
    "IN" => "Indiana", "IA" => "Iowa", "KS" => "Kansas", "KY" => "Kentucky", "LA" => "Louisiana", "ME" => "Maine", "MD" => "Maryland", "MA" => "Massachusetts",
    "MI" => "Michigan", "MN" => "Minnesota", "MS" => "Mississippi", "MO" => "Missouri", "MT" => "Montana", "NE" => "Nebraska", "NV" => "Nevada",
    "NH" => "New Hampshire", "NJ" => "New Jersey", "NM" => "New Mexico", "NY" => "New York", "NC" => "North Carolina", "ND" => "North Dakota",
    "OH" => "Ohio", "OK" => "Oklahoma", "OR" => "Oregon", "PA" => "Pennsylvania", "RI" => "Rhode Island", "SC" => "South Carolina", "SD" => "South Dakota",
    "TN" => "Tennessee", "TX" => "Texas", "UT" => "Utah", "VT" => "Vermont", "VA" => "Virginia", "WA" => "Washington", "WV" => "West Virginia",
    "WI" => "Wisconsin", "WY" => "Wyoming"
    ]
?>

<div class="container" style="padding: 50px 20px">

    <div class="card mb-2">
        <div class="card-body">
            <form id="usedAccountEdit" class="" method="POST" action="">
                <h3 class="card-title">EDIT MY INFO</h3>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right " for="email">
                            Email
                            </label>
                            <div class="col-md-9">
                                <input name="email" required="" type="input" class="form-control js-required js-email" id="email" placeholder="" autocomplete="" value="<?php echo $currentUserData['username']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right" for="password">
                            Password
                            </label>
                            <div class="col-md-9">
                                <input name="password" required="" type="password" class="form-control js-pass" id="password1" placeholder="" autocomplete="" value="">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right" for="confirm_password">
                            Confirm Password
                            </label>
                            <div class="col-md-9">
                                <input name="confirm_password" required="" type="password" class="form-control js-pass" id="confirm_password" placeholder="" autocomplete="" value="">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group required row js-form-control">
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

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right" for="primary_phone_number">
                            Primary Phone Number
                            </label>
                            <div class="col-md-9">
                                <input name="phone" maxlength="10" required="" type="input" class="form-control js-required js-mob" id="primary_phone_number" placeholder="" autocomplete="" value="<?php echo $currentUserData['phone']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row ">
                            <label class="col-md-3 col-form-label text-md-right" for="secondary_phone_number">
                            Secondary Phone Number
                            </label>
                            <div class="col-md-9">
                                <input name="phone2" maxlength="10" required="" type="input" class="form-control js-mob" id="secondary_phone_number" placeholder="" autocomplete="" value="<?php echo $currentUserData['phone2']?>">
                            </div>
                        </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right" for="address">
                            Address
                            </label>
                            <div class="col-md-9">
                                <input name="address" required="" type="input" class="form-control js-required " id="address" placeholder="" autocomplete="" value="<?php echo $currentUserData['address']?>">
                                <span class="error-message" style="color:red"></span>
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

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right" for="city">
                            City
                            </label>
                            <div class="col-md-9">
                                <input name="city" required="" type="input" class="form-control js-required" id="city" placeholder="" autocomplete="" value="<?php echo $currentUserData['city']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="js-form-control row js-form-control">
                            <label class="col-md-3 form-label" for="state">State</label>
                                <div class="col-md-9">
                                    <select id="state" class="form-control form-input js-required" name="state" required>
                                    <option value="">Select State</option>
                                    <?php
                                    $optionsHTML = '';
                                    foreach($states as $key => $val) :
                                        $selected = $currentUserData['state'] == $key ? "selected" : '';
                                        $optionsHTML .= '<option value="'.$key.'" '.$selected.'>'.$val.'</option>';
                                    endforeach;
                                    echo $optionsHTML;
                                    ?>
                                    </select><br>
                                    <span class="error-message" style="color:red"></span>
                                </div>
                            </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right " for="zip">
                            Zip
                            </label>
                            <div class="col-md-9">
                                <input name="zip" maxlength="5" required="" type="input" class="form-control js-required js-zip" id="zip" placeholder="" autocomplete="" value="<?php echo $currentUserData['zip']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <hr>

                        <div class="form-group required row">
                            <h2 class="col-md-3 card-title text-md-right">
                            Billing Info
                            </h2>
                            <div class="col-md-9">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right" for="billing_first_name">
                            First Name
                            </label>
                            <div class="col-md-9">
                                <input name="firstName" required="" type="input" class="form-control js-required js-text-only" id="billing_first_name" placeholder="" autocomplete="" value="<?php echo $currentUserData['firstName']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right" for="billing_last_name">
                            Last Name
                            </label>
                            <div class="col-md-9">
                                <input name="lastName" required="" type="input" class="form-control js-required js-text-only" id="billing_last_name" placeholder="" autocomplete="" value="<?php echo $currentUserData['lastName']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right" for="billing_address">
                            Address
                            </label>
                            <div class="col-md-9">
                                <input name="billingAddress" required="" type="input" class="form-control js-required" id="billing_address" placeholder="" autocomplete="" value="<?php echo $currentUserData['billingAddress']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right " for="billing_zip">
                            Zip
                            </label>
                            <div class="col-md-9">
                                <input name="billingZip" maxlength="5" required="" type="input" class="form-control js-required js-zip" id="billing_zip" placeholder="" autocomplete="" value="<?php echo $currentUserData['billingZip']?>">
                                <span class="error-message" style="color:red"></span>
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
} else {
    $url = home_url();
    wp_redirect($url);
    exit;
}
?>