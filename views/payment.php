<?php

$email = $_POST['email'];
$name = $_POST['name'];
$token = $_POST['stripeToken'];


if (filter_var($email, FILTER_VALIDATE_EMAIL) && !empty($name) && !empty($token)) {
    require('views/stripe.php');
    $stripe = new Stripe('sk_test_mE0mtRzk7gDgahVrbeNhydQh');
    $customer = $stripe->api('customers', [
        'source' => $token,
        'description' => $name,
        'email' => $email
    ]);

    $charge = $stripe->api('charges', [
        'amount' => 120000,
        'currency' => 'eur',
        'customer' => $customer->id,

    ]);


    die('Bravo votre paiement à bien été enregistré ');
}






