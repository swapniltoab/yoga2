<?php

/*template name: Zingfit Add Card */

get_header();

$regions = get_option('zingfit_regions');
$wpUserId = get_current_user_id();
$zingfit_user_access_token = get_transient('zingfit_customer_access_token_'.$wpUserId);
$regionId = '811593826090091886';
$seriesId = '';

if ($zingfit_user_access_token) {
    global $zinfit;
    $seriesOrderId = $zingfit->getSeriesOrderID($zingfit_user_access_token, $regionId, $seriesId);
}

$zingfit_gateways = get_option("zingfit_gateways");

?>

<div class="container" style="padding: 50px 20px">

    <div class="row">
        <h2>ADD NEW CARD</h2>
    </div>

    <hr>

    <div class="card mb-2">
        <div class="card-body">
            <form id="saveCreditCardForm" class="" method="POST" action="/account/addcard/update">

                <div class="row">
                    <div class="col-md-8">

                        <div class="row">
                            <label class="col-md-3 col-form-label text-md-right " for="firstName">
                                Card Info
                            </label>

                            <div class="col-md-9">
                                <div id="number" class="form-control StripeElement--empty">
                                    <div id="card-element"></div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <h3 class="card-title">BILLING DETAILS</h3>
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
    // form.submit();
    }
</script>

<?php
get_footer();
?>