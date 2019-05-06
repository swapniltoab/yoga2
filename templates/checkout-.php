<?php

/*template name: Zingfit Checkout */

if(is_user_logged_in()){

get_header();?>

<div class="row page-title-div" style="background-image: url(<?php echo yoga_uri.'/images/HeroImage.jpg'; ?>); width: 100%;background-repeat: no-repeat;">
<h1 class="page-title-sec"><?php echo get_the_title(); ?></h1>
</div>

<?php

$regions = get_option('zingfit_regions');
$zingfit_access_token = get_transient('zingfit_access_token');
$zingfit_user_access_token = current_user_zingfit_access_token;
$regionId = '811593826090091886';
$seriesId = '';
$zingfit_gateways = get_option("zingfit_gateways");

if ($_GET && $_GET != '') {

if(array_key_exists('seriesId', $_GET)){

$seriesId = $_GET['seriesId'];
if ($zingfit_user_access_token) {
    global $zingfit;
    $seriesOrderId = $zingfit->getSeriesOrderID($zingfit_user_access_token, $regionId, $seriesId);
    $seriesInfo = $zingfit->getSeriesInfoById($zingfit_access_token, $regionId, $seriesId);
} else {
    logoutCureentUser();
}

if (array_key_exists('error', $seriesOrderId) && ($seriesOrderId['error'] || $seriesOrderId['error'] == 'Not found.')) {?>

<div class="container" style="padding: 50px 20px">

    <div class="row">
        <h2><?php echo $seriesOrderId['error']?></h2>
    </div>
    <hr>

</div>

<?php } else {
?>

<div class="container" >

    <div class="package-info" style="padding: 50px 20px">
        <h2>Package Detail</h2>

        <div class="package-detail">
            <span>Name:</span>
            <span><?php echo $seriesInfo->name ?></span>
        </div>

        <div class="package-detail">
            <span>Description:</span>
            <span><?php echo $seriesInfo->description ?></span>
        </div>

        <div class="package-detail">
            <span>Price:</span>
            <span><?php echo '$'.$seriesInfo->price->amount ?></span>
        </div>

        <div class="package-detail">
            <span>Type:</span>
            <span><?php echo $seriesInfo->seriesType ?></span>
        </div>

    </div>

    <div class="card custom-card mb-2">
        <div class="card-body">
            <form id="stripeform" class="" method="POST" action="/charge-card/">
                <input type="hidden" name="orderId" value="<?php echo $seriesOrderId['id'] ?>">
                <h3 class="card-title">Credit Card Information</h3>

                <div class="row">
                    <div class="col-md-8">

                        <div class="row">
                            <div class="col-md-3">
                            </div>
                            <div class="col-4">
                                <img class="w-100" src="<?php echo yoga_uri . '/images/creditcards.jpg' ?>" alt="">
                            </div>
                        </div>

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

                        <div class="form-group  row">
                            <!-- <label class="col-md-3 col-form-label text-md-right " for="saveCard">
                            Save My Card
                            </label> -->

                            <!-- <div class="col-md-9">
                                <label class="custom-control custom-checkbox">
                                    <input type="checkbox" name="saveCard" class="custom-control-input " value="true" checked="">
                                    <span class="custom-control-indicator"></span>
                                    <span class="custom-control-description">Yes</span>
                                </label>
                            </div> -->
                        </div>

                    </div>
                </div>

                <h3 class="card-title">Billing Information</h3>
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
                <div class="row" data-orderid="<?php echo $seriesOrderId['id'] ?>">
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

    var form = document.getElementById('stripeform');
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
    var form = document.getElementById('stripeform');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);
    // return false;
    form.submit();
    }
</script>

<?php
}
} else{ ?>
    <div class="container" style="padding: 50px 20px">

    <div class="row">
        <h2>Invalid access to the page</h2>
    </div>
    <hr>

    </div>
<?php
}
} else{ ?>
    <div class="container" style="padding: 50px 20px">

        <div class="row">
            <h2>Invalid access to the page</h2>
        </div>

    </div>
<?php
}
get_footer();
} else {
    $url = home_url();
    wp_redirect($url.'/register/');
    exit;
}
?>