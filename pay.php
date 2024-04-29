<?php

require __DIR__ . "/vendor/autoload.php";
$stripeKey = "sk_test_51Of1SOHYuE0wbQQSW6RjMPfmEXsNxUjmgxiHBPNQkj8Hr3ou7qJ5HNYylcBxSx0RfffB0qaJtlOyuDYIxAgUxXiJ00ZxOxEF0o";

$from = $_GET['from'];
$to = $_GET['to'];
$days = $_GET['days'];
$flyers = $_GET['flyers'];
$fullName = $_GET['fullName'];
$email = $_GET['email'];
$phoneNumber = $_GET['phoneNumber'];
$departureDate = $_GET['departureDate'];

$prices = array(
    'SKP' => array(
        'IST' => array(1099, 1999, 2799),
        'LIS' => array(1999, 3499, 4999),
        'LND' => array(1499, 2799, 3999),
        'PAS' => array(1499, 2799, 3999),
        'ROM' => array(799, 1499, 2149),
        'ANT' => array(1099, 1999, 2799),
        'BEJ' => array(7999, 13999, 19999),
        'MUM' => array(7999, 13999, 19999),
        'SEO' => array(5999, 9999, 15999),
        'TOK' => array(4999, 8999, 12999),
        'ARZ' => array(2999, 4999, 7499),
        'BUE' => array(7999, 13999, 19999),
        'NYC' => array(2499, 4499, 6999),
        'SFR' => array(3799, 6999, 9999),
        'SPL' => array(6999, 12999, 19999)
    ),
    'PRN' => array(
        'IST' => array(1209, 2199, 3079),
        'LIS' => array(2199, 3849, 5499),
        'LND' => array(1649, 3079, 4399),
        'PAS' => array(1649, 3079, 4399),
        'ROM' => array(879, 1649, 2364),
        'ANT' => array(1209, 2199, 3079),
        'BEJ' => array(8799, 15399, 21999),
        'MUM' => array(8799, 15399, 21999),
        'SEO' => array(6599, 10989, 17598),
        'TOK' => array(5499, 9899, 14289),
        'ARZ' => array(3299, 5499, 8249),
        'BUE' => array(8799, 15399, 21999),
        'NYC' => array(2749, 4949, 7699),
        'SFR' => array(4169, 7699, 10998),
        'SPL' => array(7699, 14289, 21999)
    ),
    'TIA' => array(
        'IST' => array(1130, 2060, 2883),
        'LIS' => array(2060, 3605, 5149),
        'LND' => array(1544, 2883, 4159),
        'PAS' => array(1544, 2883, 4159),
        'ROM' => array(823, 1544, 2213),
        'ANT' => array(1130, 2060, 2883),
        'BEJ' => array(8239, 14319, 20799),
        'MUM' => array(8239, 14319, 20799),
        'SEO' => array(6179, 10198, 16398),
        'TOK' => array(5149, 9269, 13388),
        'ARZ' => array(3089, 5149, 7724),
        'BUE' => array(8239, 14319, 20799),
        'NYC' => array(2573, 4643, 7500),
        'SFR' => array(3927, 7209, 10399),
        'SPL' => array(7209, 13388, 20799)
    )
);
$priceModifier = 5;
$pricePercentage = ($priceModifier / 100);
$priceOptions = $prices[$from][$to][0];
$priceModified = $priceOptions + ($pricePercentage * $priceOptions);
$price = $priceModified;
\Stripe\Stripe::setApiKey($stripeKey);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/rudieta-travel-app/success.php?fullName=$fullName&email=$email&phoneNumber=$phoneNumber&flyers=$flyers&days=$days&from=$from&to=$to&departureDate=$departureDate",
    "locale" => "auto",
    "line_items" => [
        [
            "quantity" => $flyers,
            "price_data" => [
                "currency" => "eur",
                "unit_amount" =>  $price * 100,
                "product_data" => [
                    "name" => "Travel $from - $to",
                    'description' => 'Travel'
                ],

                ]],
            ],
            'custom_fields' => [
                [
                  'key' => 'fullName',
                  'label' => [
                    'type' => 'custom',
                    'custom' => 'Full Name',
                  ],
                  'type' => 'text',
                ],
              ],
              'phone_number_collection' => ['enabled' => true],
]);
http_response_code(303);
header("Location: " . $checkout_session->url);