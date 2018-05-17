<?php
    require __DIR__ . '/../vendor/autoload.php';

    //define('SITE_URL', 'localhost/infs3202_project/index.php');
    //define('SITE_URL', 'Infs3202_Project');
    define('SITE_URL', 'https://infs3202-97300266.uqcloud.net');

    $paypal = new \PayPal\Rest\ApiContext(
        new \PayPal\Auth\OAuthTokenCredential(
            'Aa3JuAqm4QMvrZCRuwdxnjKjNgPa3cvlgK-co4EHkpQ-H3fIM-3W1dhfZQck3g-6b37cgYTWX3uIwqGf',
            'EChbiuGJmDoqbzQstsI4c-sWwO5Jmhxdv4ex9FJa6nKnwrgfj0nEcP2emz8NGDyHnWE5iGZNdy0oPYlW'
        )
    );


?>