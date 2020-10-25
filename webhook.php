<?php

$data = $_POST;
$mac_provided = $data['mac'];  // Get the MAC from the POST data
unset($data['mac']);  // Remove the MAC key from the data.

$ver = explode('.', phpversion());
$major = (int) $ver[0];
$minor = (int) $ver[1];

if($major >= 5 and $minor >= 4){
     ksort($data, SORT_STRING | SORT_FLAG_CASE);
}
else{
     uksort($data, 'strcasecmp');
}

// You can get the 'salt' from Instamojo's developers page(make sure to log in first): https://www.instamojo.com/developers
// Pass the 'salt' without the <>.
$mac_calculated = hash_hmac("sha1", implode("|", $data), "7aafd2f1772d40d39f729377733b251b");

if($mac_provided == $mac_calculated){
    // dd($data);
    echo "MAC is fine";
    // Do something here
    if($data['status'] == "Credit"){

       // Payment was successful, mark it as completed in your database  
    }
    else{
       // Payment was unsuccessful, mark it as failed in your database
    }
}
else{
    echo "Invalid MAC passed";
}
?>