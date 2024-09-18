<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

$ipa = new CURLFile(realpath('file.ipa'));
$p12 = new CURLFile(realpath('file.p12'));
$mobileprovision = new CURLFile(realpath('file.mobileprovision'));
$password = file_get_contents('password.txt');

// Upload IPA
$curl = curl_init('https://upload.starfiles.co/file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $ipa));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($curl);
$output_decoded = json_decode($output, true);
if(!isset($output_decoded['file']))
    die('Failed ' . __LINE__ . ': ' . $output);
$ipa_output = $output_decoded['file'];
curl_close($curl);

// Upload P12
$curl = curl_init('https://upload.starfiles.co/file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $p12));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($curl);
$output_decoded = json_decode($output, true);
if(!isset($output_decoded['file']))
    die('Failed ' . __LINE__ . ': ' . $output);
$p12_output = $output_decoded['file'];
curl_close($curl);

// Upload Mobileprovision
$curl = curl_init('https://upload.starfiles.co/file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $mobileprovision));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$output = curl_exec($curl);
$output_decoded = json_decode($output, true);
if(!isset($output_decoded['file']))
    die('Failed ' . __LINE__ . ': ' . $output);
$mobileprovision_output = $output_decoded['file'];
curl_close($curl);

// Sign
var_dump(file_get_contents('https://api2.starfiles.co/sign_ipa?ipa=' . $ipa_output . '&p12=' . $p12_output . '&mobileprovision=' . $mobileprovision_output . '&password=' . $password));
