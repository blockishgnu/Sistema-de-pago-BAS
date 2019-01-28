<?php

require_once ('braintree-php-3.30.0/lib/Braintree.php');

define("ACCESS_TOKEN", 'access_token$sandbox$9wyz9gr9w6w3nhq7$fddc66ab5ee3f60df65e1b1e0e56a79d');

$gateway = new Braintree_Gateway(array(
    'accessToken' => ACCESS_TOKEN
));

echo ($clientToken = $gateway->clientToken()->generate());

?>
