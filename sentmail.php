<?php
// define variables and set to empty values
$name = $email = $phone = $subject = $message = $msgbody = "";
$headers = '';
$Err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	//name validation
	 if (empty($_POST["name"])) {
		$Err .= "\n Name is required";
	  } else {
		$name = test_input($_POST["name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
		  $Err .= "\n Only letters and white space allowed";
		}
	  }

	//email validation
	if (empty($_POST["email"])) {
		$Err .= "\n Email is required";
	  } else {
		$email = test_input($_POST["email"]);
		// check if e-mail address is well-formed
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  $Err .= "\n Invalid email format";
		}
	  }

	//Phone Validation
	if (empty($_POST["phone"])) {
		$Err .= "\n Phone is required";
	  } else {
		$phone = test_input($_POST["phone"]);
		// check if phone no. is numeric
		if (!is_numeric($phone)) {
		  $Err .= "\n Invalid Phone Number format";
		}
	  }


	//Subject Validation
	if (empty($_POST["subject"])) {
		$Err .= "\n Subject is Required";
	} else {
		$subject = test_input($_POST["subject"]);
	}

	//Message Validation
	if (empty($_POST["msg"])) {
		$Err .= "\n Message is Required";
	} else {
		$message = test_input($_POST["msg"]);
	}

	  /*$name = test_input($_POST["name"]);
	  $email = test_input($_POST["email"]);
	  $phone = test_input($_POST["phone"]);
	  $subject = test_input($_POST["subject"]);
	  $message = test_input($_POST["msg"]);*/


	$to = "sgs.engineer@gmail.com";
	$msgsubject = "ApsonTraders.com : " . $subject;
	$headers .= 'From:' . $email . "\r\n";
	//$headers .= 'Cc: sgs.engineer@yahoo.co.in' . "\r\n";

	$msgbody = "Following Message is recieved : " . "\n\n" . "Name : " .$name . "\n\n" . "Email : " .$email . "\n\n" . "Phone : " . $phone. "\n\n" . "Subject : " . $subject . "\n\n" . "Message : " . $message . "\n\n". "Thanks";

	if(!empty($Err)){
		/*echo 'Please Correct these errors : ' . $Err;*/
        echo json_encode(array(
            'status' => 'error',
            'message'=> 'Please Correct these errors : '.$Err
        ));
	} else {
		if(true/*mail($to,$msgsubject,$msgbody,$headers)*/){
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Message Sent Successfully. We will reply shortly !'
            ));
			//echo 'Message Sent Successfully. We will reply shortly !';
			//echo $to.' '.$msgsubject.' '.$headers.' '.$msgbody;
		} else{
			echo 'Error in Mail';
		}
	}
}
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>