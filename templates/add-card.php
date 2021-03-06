<?php

/*template name: Zingfit Add Card */

get_header();
?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php
$regions = get_option('zingfit_regions');
$zingfit_user_access_token = current_user_zingfit_access_token;
$regionId = '811593826090091886';
$seriesId = '';

if ($zingfit_user_access_token) {
    global $zingfit;
    $seriesOrderId = $zingfit->getSeriesOrderID($zingfit_user_access_token, $regionId, $seriesId);
} else {
    logoutCureentUser();
}

$currentUserID = get_current_user_id();
$currentUserData = get_user_meta($currentUserID, 'zingfit_customer_data', true);

$zingfit_gateways = get_option("zingfit_gateways");

?>

<div class="container" style="padding: 50px 20px">

    <div class="card mb-2">
        <div class="card-body">
            <form id="saveCreditCardForm" class="" method="POST" action="/account/addcard/update">

                <div class="row">
                    <div class="col-md-8">

                        <div class="row cc-info-row">
                            <label class="col-12 col-md-3 col-form-label text-md-right " for="firstName">
                                Card Info
                            </label>

                            <div class="col-12 col-md-9">
                                <div id="number" class="form-control StripeElement--empty">
                                    <div id="card-element"></div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <h4 class="card-title my-4">BILLING DETAILS</h4>
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="firstName">
                            First Name
                            </label>
                            <div class="col-md-9">
                                <input name="firstName" type="input" class="form-control " id="firstName" value="<?php echo $currentUserData['firstName'] ?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="lastName">
                            Last Name
                            </label>
                            <div class="col-md-9">
                                <input name="lastName" type="input" class="form-control " id="lastName" value="<?php echo $currentUserData['lastName'] ?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="address">
                            Address
                            </label>
                            <div class="col-md-9">
                                <input name="billingAddress" type="input" class="form-control" id="address" value="<?php echo $currentUserData['billingAddress'] ?>">
                            </div>
                        </div>

                        <div class="form-group required row">
                            <label class="col-md-3 col-form-label text-md-right " for="zip">
                            Zip
                            </label>
                            <div class="col-md-9">
                                <input name="zip" type="input" class="form-control " id="zip" value="<?php echo $currentUserData['billingZip'] ?>">
                            </div>
                        </div>

                        <input type="hidden" name="gatewayId" value="<?php echo $zingfit_gateways[0]['id'] ?>" />

                    </div>
                </div>

                <hr>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-3"></div>
                            <div class="col-md-9">
                                <button type="submit" class="text-uppercase d-inline-block button">Save Card</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

</div>

<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
    var stripe = Stripe('<?php echo $zingfit_gateways[0]['stripeKey']?>');

    var elements = stripe.elements();

    var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
        color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
    };

    var card = elements.create('card', {style: style});

    card.mount('#card-element');

    card.addEventListener('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });

    var form = document.getElementById('saveCreditCardForm');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        } else {
        stripeTokenHandler(result.token);
        }
    });
    });

    function stripeTokenHandler(token) {
    var form = document.getElementById('saveCreditCardForm');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    form.submit();
    }
</script>

<?php
get_footer();
?>