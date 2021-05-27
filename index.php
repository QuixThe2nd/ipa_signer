<?php
$ipa = new CURLFile(realpath('file.ipa'));
$p12 = new CURLFile(realpath('file.p12'));
$mobileprovision = new CURLFile(realpath('file.mobileprovision'));
$password = file_get_contents('password.txt');

// Upload IPA
$curl = curl_init('https://api.starfiles.co/upload/upload_file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $ipa));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$ipa_output = json_decode(curl_exec($curl), true)['file'];
curl_close($curl);

// Upload P12
$curl = curl_init('https://api.starfiles.co/upload/upload_file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $p12));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$p12_output = json_decode(curl_exec($curl), true)['file'];
curl_close($curl);

// Upload Mobileprovision
$curl = curl_init('https://api.starfiles.co/upload/upload_file');
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: multipart/form-data'));
curl_setopt($curl, CURLOPT_POSTFIELDS, array('upload' => $mobileprovision));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
$mobileprovision_output = json_decode(curl_exec($curl), true)['file'];
curl_close($curl);

// Sign
$output = json_decode(file_get_contents('https://sign.starfiles.co?ipa=' . $ipa_output . '&p12=' . $p12_output . '&mobileprovision=' . $mobileprovision_output . '&password=' . $password), true)['file'];
file_put_contents('file_signed.ipa', file_get_contents('https://api.starfiles.co/direct/' . $output));
