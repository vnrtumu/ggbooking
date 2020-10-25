<?php 



if($_GET['payment_status'] != 'Credit')
	header('Location: failed.php?payment_request_id='.$_GET['payment_request_id'].'&payment_id='.$_GET['payment_id'].'&payment_status='.$_GET['payment_status']);

if(!@$_GET['payment_request_id'])
	header('Location: index.php');  



include 'config.php';

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/'.$_GET['payment_request_id'].'/');
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER,
            array("X-Api-Key:".$api_key,
                  "X-Auth-Token:".$api_token));
$response = curl_exec($ch);
curl_close($ch); 

$response_de = json_decode($response);

$unique_id = $response_de->payment_request->purpose;

$update_query = "UPDATE `slot_booking` SET `payment_success`='1', `payment_response`='".$response."' WHERE 1 AND unique_id = '".$unique_id."' ";
mysqli_query($connect, $update_query);


$select_query = "select * from `slot_booking` WHERE 1 AND unique_id = '".$unique_id."' ";
$result = mysqli_fetch_assoc(mysqli_query($connect, $select_query));

$name= $result['name'];
$email= $result['email'];
$phone= $result['phone'];
$type= $result['book_type'];
$persons= $result['persons'];
$price= $result['price'];
$package= $category[$result['package']];



if($result['payment_success'] == '1')
{
											$url = 'https://api.sendgrid.com/';
											$user = 'venkat690';
											$pass = 'sreevenky4';
											$request =  $url.'api/mail.send.json';
											$subject = 'Payment Success';
											$message = '<html><body><p><span style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);"></span></p>
<table style="border:none;border-collapse:collapse;">
    <tbody>
        <tr style="height:36.25pt;">
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Name</span></span></span></p>
            </td>
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">'.$name.'</span></span></span></p>
            </td>
        </tr>
        <tr style="height:36.25pt;">
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Email Id</span></span></span></p>
            </td>
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">'.$email.'</span></span></span></p>
            </td>
        </tr>
        <tr style="height:36.25pt;">
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Mobile No</span></span></span></p>
            </td>
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">'.$phone.'</span></span></span></p>
            </td>
        </tr>
        <tr style="height:36.25pt;">
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Type</span></span></span></p>
            </td>
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">'.$type.'</span></span></span></p>
            </td>
        </tr>
        <tr style="height:36.25pt;">
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">No of Person</span></span></span></p>
            </td>
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">'.$persons.'</span></span></span></p>
            </td>
        </tr>
		<tr style="height:36.25pt;">
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Game</span></span></span></p>
            </td>
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">'.$package.'</span></span></span></p>
            </td>
        </tr>
		<tr style="height:36.25pt;">
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Payment Status</span></span></span></p>
            </td>
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Success</span></span></span></p>
            </td>
        </tr>
        <tr style="height:36.25pt;">
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 400; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Amount</span></span></span></p>
            </td>
            <td style="border-left:solid #dce2e9 0.75pt;border-right:solid #dce2e9 0.75pt;border-bottom:solid #dce2e9 0.75pt;border-top:solid #dce2e9 0.75pt;vertical-align:middle;padding:5pt 5pt 5pt 5pt;overflow:hidden;overflow-wrap:break-word;">
                <p dir="ltr" style="line-height:1.38;margin-top:0pt;margin-bottom:0pt;"><span style="background-color: rgb(255, 255, 255);"><span style="color: rgb(0, 0, 0);"><span style="font-size: 12pt; font-family: Arial; font-weight: 700; font-style: normal; font-variant: normal; text-decoration: none; vertical-align: baseline; white-space: pre-wrap;">Rs. '.$price.'</span></span></span></p>
            </td>
        </tr>
    </tbody>
</table>
<p></p>
<p><span style="color: rgb(0, 0, 0); background-color: rgb(255, 255, 255);"><br></span></p>
<p><br></p></body></html>';
											
											 $params = array(
													'api_user'  => $user,
													'api_key'   => $pass,
													'to[0]'     => $email,
													'to[1]'     => "tvnr690@gmail.com",
													'subject'   => $subject,
													'html'      => $message,
													'text'      => '',
													'from'      => 'noreply@gamingalaxy.in'
												);

												// Generate curl request
												$session = curl_init($request);
												// Tell curl to use HTTP POST
												curl_setopt ($session, CURLOPT_POST, true);
												// Tell curl that this is the body of the POST
												curl_setopt ($session, CURLOPT_POSTFIELDS, $params);
												// Tell curl not to return headers, but do return the response
												curl_setopt($session, CURLOPT_HEADER, false);
												// Tell PHP not to use SSLv3 (instead opting for TLS)
												curl_setopt($session, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1_2);
											
												curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
											
												// obtain response
												$response = curl_exec($session);
												curl_close($session);
}
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
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
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
        <i class="checkmark">✓</i>
      </div>
        <h1>Success</h1> 
        <p>We received your purchase request<br/> we'll be in touch shortly!</p>
      </div>
    </body>
</html>