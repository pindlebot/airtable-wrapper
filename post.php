<?php
include 'settings.php';

function update_airtable($url, $type, $json, $headers) {

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_TIMEOUT, 10);
  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $type);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
  curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  $output = curl_exec($ch);
  curl_close($ch);
}

$id = $_POST['id'];
$url = $airtable_url . '/' . $id;
$type = 'PATCH';
$headers = array('Authorization: Bearer ' . $api_key, 'Content-type: application/json');
$json = array("fields" => $_POST['update']);

if('POST' == $_SERVER['REQUEST_METHOD']) {
update_airtable($url, $json, $headers);
}
