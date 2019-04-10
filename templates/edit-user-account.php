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
                            <label class="col-md-3 col-form-label text-md-right " for="password">
                            Password
                            </label>
                            <div class="col-md-9">
                                <input name="password" required="" type="password" class="form-control js-required js-pass" id="password1" placeholder="" autocomplete="" value="">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right " for="confirm_password">
                            Confirm Password
                            </label>
                            <div class="col-md-9">
                                <input name="confirm_password" required="" type="password" class="form-control js-required js-pass" id="confirm_password" placeholder="" autocomplete="" value="">
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
                                <input name="primary_phone_number" required="" type="input" class="form-control js-required js-mob" id="primary_phone_number" placeholder="" autocomplete="" value="<?php echo $currentUserData['phone']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row ">
                            <label class="col-md-3 col-form-label text-md-right" for="secondary_phone_number">
                            Secondary Phone Number
                            </label>
                            <div class="col-md-9">
                                <input name="secondary_phone_number" required="" type="input" class="form-control js-mob" id="secondary_phone_number" placeholder="" autocomplete="" value="<?php echo $currentUserData['phone2']?>">
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
                                <input name="city" required="" type="input" class="form-control js-required js-text-only" id="city" placeholder="" autocomplete="" value="<?php echo $currentUserData['city']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="js-form-control row js-form-control">
                            <label class="col-md-3 form-label" for="state">State</label>
                                <div class="col-md-9">
                                    <select id="state" class="form-control form-input js-required" name="state" required>
                                    <option value="">Select State</option>
                                    <option value="AL">Alabama</option>
                                    <option value="AK">Alaska</option>
                                    <option value="AZ">Arizona</option>
                                    <option value="AR">Arkansas</option>
                                    <option value="CA">California</option>
                                    <option value="CO">Colorado</option>
                                    <option value="CT">Connecticut</option>
                                    <option value="DE">Delaware</option>
                                    <option value="DC">District Of Columbia</option>
                                    <option value="FL">Florida</option>
                                    <option value="GA">Georgia</option>
                                    <option value="HI">Hawaii</option>
                                    <option value="ID">Idaho</option>
                                    <option value="IL">Illinois</option>
                                    <option value="IN">Indiana</option>
                                    <option value="IA">Iowa</option>
                                    <option value="KS">Kansas</option>  
                                    <option value="KY">Kentucky</option>
                                    <option value="LA">Louisiana</option>
                                    <option value="ME">Maine</option>
                                    <option value="MD">Maryland</option>
                                    <option value="MA">Massachusetts</option>
                                    <option value="MI">Michigan</option>
                                    <option value="MN">Minnesota</option>
                                    <option value="MS">Mississippi</option>
                                    <option value="MO">Missouri</option>
                                    <option value="MT">Montana</option>
                                    <option value="NE">Nebraska</option>
                                    <option value="NV">Nevada</option>
                                    <option value="NH">New Hampshire</option>
                                    <option value="NJ">New Jersey</option>
                                    <option value="NM">New Mexico</option>
                                    <option value="NY">New York</option>
                                    <option value="NC">North Carolina</option>
                                    <option value="ND">North Dakota</option>
                                    <option value="OH">Ohio</option>
                                    <option value="OK">Oklahoma</option>
                                    <option value="OR">Oregon</option>
                                    <option value="PA">Pennsylvania</option>
                                    <option value="RI">Rhode Island</option>
                                    <option value="SC">South Carolina</option>
                                    <option value="SD">South Dakota</option>
                                    <option value="TN">Tennessee</option>
                                    <option value="TX">Texas</option>
                                    <option value="UT">Utah</option>
                                    <option value="VT">Vermont</option>
                                    <option value="VA">Virginia</option>
                                    <option value="WA">Washington</option>
                                    <option value="WV">West Virginia</option>
                                    <option value="WI">Wisconsin</option>
                                    <option value="WY">Wyoming</option>
                                    </select><br>
                                    <span class="error-message" style="color:red"></span>
                                </div>
                            </div>
 
                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right " for="zip">
                            Zip
                            </label>
                            <div class="col-md-9">
                                <input name="zip" required="" type="input" class="form-control js-required js-zip" id="zip" placeholder="" autocomplete="" value="<?php echo $currentUserData['zip']?>">
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
                                <input name="billing_address" required="" type="input" class="form-control js-required" id="billing_address" placeholder="" autocomplete="" value="<?php echo $currentUserData['billingAddress']?>">
                                <span class="error-message" style="color:red"></span>
                            </div>
                        </div>

                        <div class="form-group required row js-form-control">
                            <label class="col-md-3 col-form-label text-md-right " for="billing_zip">
                            Zip
                            </label>
                            <div class="col-md-9">
                                <input name="billing_zip" required="" type="input" class="form-control js-required js-zip" id="billing_zip" placeholder="" autocomplete="" value="<?php echo $currentUserData['billingZip']?>">
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
?>