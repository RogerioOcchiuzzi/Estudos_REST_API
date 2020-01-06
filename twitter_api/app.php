<?php
namespace TwitterApp;

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/src/Twitter.php';

use TwitterApp\Twitter;

$path = __DIR__ . '\twitter_php7.json';
$jsonCredentials = file_get_contents($path);
$credentials = json_decode($jsonCredentials, true);
$twitter = new Twitter($credentials['key'], $credentials['secret']);