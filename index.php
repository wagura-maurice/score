<?php

use EAFF\Repositories\MpesaRepository as MpesaRepository;

require_once 'app/start.php';

$mpesa = new MpesaRepository();

$JSON_DATA = file_get_contents('txn_data.txt');

$ARRAY_DATA = json_decode($JSON_DATA, true);

echo "<pre>";
print_r(json_decode($mpesa->getScore($ARRAY_DATA), true));