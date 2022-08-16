<?php

$messageUser;
$messageText;
$pageType;
$postId;
$slug;
$captcha;

$messageUser = filter_input(INPUT_POST, 'messageUser', FILTER_VALIDATE_EMAIL);
$messageText = filter_input(INPUT_POST, 'messageText', FILTER_SANITIZE_STRING);
$pageType = filter_input(INPUT_POST, 'pageType', FILTER_SANITIZE_STRING);
$postId = filter_input(INPUT_POST, 'postId', FILTER_SANITIZE_STRING);
$slug = filter_input(INPUT_POST, 'slug', FILTER_SANITIZE_STRING);

$captcha = filter_input(INPUT_POST, 'token', FILTER_SANITIZE_STRING);
  if(!$captcha){
    echo '
Please check the the captcha form.
';
    exit;
  }
  $secretKey = "6Lc-t1QhAAAAAC51-vcjxN0Apv97Taf_EH6PMZWD";
  $ip = $_SERVER['REMOTE_ADDR'];

  // post request to server
  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = array('secret' => $secretKey, 'response' => $captcha);

  $options = array(
    'http' => array(
      'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
      'method'  => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $response = file_get_contents($url, false, $context);
  $responseKeys = json_decode($response,true);
  header('Content-type: application/json');
  if($responseKeys["success"]) {
    include('addMessage.php');
    echo json_encode(array('success' => 'true'));
  } else {
    echo json_encode(array('success' => 'false'));
  }
?>