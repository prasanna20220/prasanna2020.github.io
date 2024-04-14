<?php

//Receive the RAW post data.
$content = trim(file_get_contents("php://input"));

//Attempt to decode the incoming RAW post data from JSON.
$postdata = json_decode($content, true);

if(isset($postdata['URI'])) {
  $uri = $postdata['URI'];
  //$param1 = array();
  //$param1["USR_MOBNO"] = $postdata['USR_MOBNO'];
  //$param1["USR_PWD"] = $postdata['USR_PWD'];
  //$posts1 = json_encode($param1);
  $posts1 = $content;

  $url1 = "http://18.142.129.209:2019/PartsSpeedsWcfService/MobApp.svc/".$uri;
  $ch1 = curl_init ($url1);
  curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt ($ch1, CURLOPT_POSTFIELDS, $posts1);
  curl_setopt ($ch1, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch1, CURLOPT_SSL_VERIFYHOST, false);
  curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  
  curl_setopt($ch1, CURLOPT_TIMEOUT, 5);
  curl_setopt($ch1, CURLOPT_CONNECTTIMEOUT, 5);

  $response1 = curl_exec ($ch1);
  if(!$response1){
      die('Error: "' . curl_error($ch1) . '" - Code: ' . curl_errno($ch1));
  }
  curl_close($ch1);

  /* echo html_entity_decode($response); */
  
  $resdata = json_decode($response1, true);
  /* $result1 = $resdata['GetCrmLeaveResult'];
  print_r($response1);

  echo "code: ". $resdata['GetCrmLeaveResult'][0]['STA_CODE']. "<br />";

  echo json_encode($result1[0]). "<br />"; */

  print_r($response1);

}

?>