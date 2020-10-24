<?php  
include "instamojo.php";
include 'config.php';

$name 		= 	$_POST['name'];
$phone 		= 	$_POST['phone'];
$email 		= 	$_POST['email'];
$date_slot 	= 	$_POST['date_slot'];
$time_slot 	= 	$_POST['time_slot'];
$book_type 	= 	$_POST['book_type'];
$package	=	$_POST['package'];
$reg_val	=	$_POST['reg_val'];
$persons	=	$_POST['persons'];
$unique_id	=	$package.'_'.uniqid();		

if($book_type == 'Regular')
	$price = array('mj'=>'695', 'la'=>'299','combo'=>'994');
else
	$price = array('mj'=>'595', 'la'=>'249','combo'=>'849');

if($email = 'rdharunravi@gmail.com')
	$price = 9;
else	
	$price = $price[$package];
	
	$insert_query = "INSERT INTO `slot_booking`(`name`, `email`, `phone`, `date_slot`, `time_slot`, `book_type`, `package`, `reg_val`, `persons`, `price`, `unique_id`) VALUES ('".$name."','".$email."','".$phone."','".$date_slot."','".$time_slot."','".$book_type."','".$package."','".$reg_val."','".$persons."','".$price."','".$unique_id."')";
	mysqli_query($connect,$insert_query);
	
	
//include 'payment-src/instamojo.php';   
    //Download from website
//$api = new Instamojo\Instamojo('YOU_PRIVATE_API_KEY', 'YOUR_PRIVATE_AUTH_TOKEN','https://test.instamojo.com/api/1.1/');

$api = new Instamojo\Instamojo($api_key, $api_token,'https://www.instamojo.com/api/1.1/');
try {
    $response = $api->paymentRequestCreate(array(
        "purpose" => $unique_id,
        "amount" => $price, 
        "buyer_name" => $name,
        "phone" => $phone,
        "send_email" => true,
        "send_sms" => true,
        "email" => $email,
        'allow_repeated_payments' => true,
        "redirect_url" => "http://hypertechno.in/success.php",
        "webhook" => "http://hypertechno.in/webhook.php"
        ));
    //print_r($response); 
    $pay_url = $response['longurl'];
    header("Location: $pay_url");
    exit();
}

catch (Exception $e) {
    print('Error: ' . $e->getMessage());
}     
?>