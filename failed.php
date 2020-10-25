<?php 
if($_GET['payment_request_id'] == '')
	header('Location: index.php');  

include 'config.php';
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://www.instamojo.com/api/1.1/payment-requests/'.$_GET['payment_request_id'].'/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:$api_key",
                  "X-Auth-Token:$api_token"));
$response = curl_exec($ch);
curl_close($ch); 

$response_de = json_decode($response);

$unique_id = $response_de->payment_request->purpose;

$update_query = "UPDATE `slot_booking` SET `payment_success`='0', `payment_response`='".$response."' WHERE 1 AND unique_id = '".$unique_id."' ";
mysqli_query($connect, $update_query);

?>
<html>
  <head>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">
  </head>
    <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #9c000e;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: black;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      b {
        color: #9c000e;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>
    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <b class="checkmark">X</b>
      </div>
        <h1>Payment Failed</h1> 
        <p>Your order is unsuccessful<br/> Please book the rooms again.</p>
      </div>
    </body>
</html>