<?php

require_once 'vendor/autoload.php';

$google_client = new Google_Client();
$google_client->setClientId('789504345800-09k5tdjsg95or8rbjm3vfj4qfe3je9pd.apps.googleusercontent.com');
$google_client->setClientSecret('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');
$google_client->setRedirectUri('http://localhost/API/index.php');
$google_client->addScope('email');
$google_client->addScope('profile');

?>