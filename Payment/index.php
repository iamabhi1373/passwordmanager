<?php
require_once('vendor/autoload.php');

\Stripe\Stripe::setApiKey('sk_test_51P4fXZSJMmbUlpePWtYTaF8ReisUmV593ogQhzFlc3C7EOodm1JW8uGrWByg2ccDylCrpSiehYRWCugJpuGuIzcL00UHDfBzK0');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['stripeToken'];
    $amount = 1000; // $10.00 in cents

    try {
        $charge = \Stripe\Charge::create([
            'amount' => $amount,
            'currency' => 'usd',
            'description' => 'Example Charge',
            'source' => $token,
        ]);

        // Payment successful
        echo "<h2 style='text-align: center'>Payment successful!</h2>";
    } catch (\Stripe\Exception\CardException $e) {
        // Payment failed
        echo "<h2 style='text-align: center'>Payment failed: " . $e->getError()->message . "</h2>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Form</title>
    <script src="https://js.stripe.com/v3/"></script>
</head>
<body>
    <form action="" method="post" id="payment-form">
        <label for="card-element">
            Credit or debit card
        </label>
        <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
        </div>

        <!-- Used to display form errors. -->
        <div id="card-errors" role="alert"></div>

        <button type="submit">Submit Payment</button>
    </form>

    <script>
        var stripe = Stripe('pk_test_your_publishable_key');
        var elements = stripe.elements();

        var style = {
            base: {
                color: "#32325d",
            }
        };

        var card = elements.create("card", { style: style });
        card.mount("#card-element");

        card.addEventListener('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Token created successfully, submit form
                    var tokenInput = document.createElement('input');
                    tokenInput.setAttribute('type', 'hidden');
                    tokenInput.setAttribute('name', 'stripeToken');
                    tokenInput.setAttribute('value', result.token.id);
                    form.appendChild(tokenInput);
                    form.submit();
                }
            });
        });
    </script>
</body>
</html>
