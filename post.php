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
  echo $output;
  curl_close($ch);
}

if ( ('POST' == $_SERVER['REQUEST_METHOD']) && (  $_POST['type'] == 'update' )) {
  $id = $_POST['id'];
  $key = $_POST['key'];
  $value = $_POST['value'];
  $url = $airtable_url . '/' . $id;
  $type = 'PATCH';
  $headers = array('Authorization: Bearer ' . $api_key, 'Content-type: application/json');
  $data = array("fields" => array( $key => $value ) );
  $json = json_encode($data);

update_airtable($url, $type, $json, $headers);
}

if ( ('POST' == $_SERVER['REQUEST_METHOD']) && (  $_POST['type'] == 'delete' )) {
  $id = $_POST['id'];
  $url = $airtable_url . '/' . $id;
  $type = 'DELETE';
  $headers = array('Authorization: Bearer ' . $api_key);
  $json = '';
  
  update_airtable($url, $type, $json, $headers);
}

if ( ('POST' == $_SERVER['REQUEST_METHOD']) && (  $_POST['type'] == 'create' )) {
  $url = $airtable_url;
  $type = 'POST';
  $headers = array('Authorization: Bearer ' . $api_key, 'Content-type: application/json');
  $value = '';
  $key = array('col_1', 'col_2', 'col_3');
  $data = array("fields" => array( $key[0] => $value, $key[1] => $value, $key[2] => $value ) );
  $json = json_encode($data);

update_airtable($url, $type, $json, $headers);
}