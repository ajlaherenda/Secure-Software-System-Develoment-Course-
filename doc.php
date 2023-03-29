<?php
require 'vendor/autoload.php';

$openapi = \OpenApi\Generator::scan(['/Applications/MAMP/htdocs/lab-SSSD/api']);

header('Content-Type: application/json');
echo $openapi->toJson();

?>