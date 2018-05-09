<?php

session_start();

// connect to database

$db = mysqli_connect();


//Defining an Array to get the error in it and show it on page, whatever the error is.
$errors = array();
 //Query for client side email check if it exists in db 
//check for AJAX call
if (isset($_POST['ajax_'])) {
	//echo $_POST['email'];
	
	$query = "SELECT COUNT(*) AS cntUser FROM customers WHERE email='".$_POST['email']."'";

	$result = mysqli_query($db,$query);

	$row = mysqli_fetch_array($result);

	$count = $row['cntUser'];

	// Return total rows found
	echo $count;
}

// REGISTER USER

if (isset($_POST['reg_user'])) {

	// receive all input values from the form
	
	$forename = mysqli_real_escape_string($db, $_POST['forename']);
	if ($forename == ""){
		array_push($errors, "Forename field is empty ");
	}
	$surname = mysqli_real_escape_string($db, $_POST['surname']);
	if ($surname == ""){
		array_push($errors, "Surname field is empty ");
	}
	$email = mysqli_real_escape_string($db, $_POST['email']);
	if ($email == ""){
		array_push( $errors, "Email field is empty ");
	}
	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
	if ($password_1 == ""){
		array_push($errors, "Password field is empty ");
	}
	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	if ($password_2 == ""){
		array_push($errors, "Password re-enter field is empty ");
	}

 //Query for server side email check if it exists in db 

	$query = "SELECT COUNT(*) AS cntUser FROM customers WHERE email='".$_POST['email']."'";

	$result = mysqli_query($db,$query);

	$row = mysqli_fetch_array($result);

	$count = $row['cntUser'];

	// Return total rows found
	//echo $count;


//Server side email validation

	if (!empty($email)) {

		$regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i";

		if(preg_match($regex, $email) && $count < 1){


			echo( $email." is a valid email. We can accept it. <br>");
		} else { 
			array_push($errors, $email." is an invalid email. Please try again.");
		}  
	}

//Server side password validation

		if (!empty($password_1)) {

			$regexpwd = '/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/';

			if(preg_match($regexpwd, $password_1)){


				echo ($password_1 . " is a valid password. We can accept it. <br>");
			} else { 
				array_push($errors, $password_1 . " is an invalid password. Please try again with at least one number and one uppercase and lowercase letter, and at least 8 or more characters.");
			} 
		}
		
//Matching passwords
			
		if ($password_1 !== $password_2) {

			array_push($errors, "The two passwords do not match");

		}

		if (count($errors) > 0) {
	//print_r($errors);
			for($x = 0; $x <count($errors); $x++){
				echo $errors[$x].'<br>';
			}
		}else{
			// register user if there are no errors in the form

			/*if (count($errors) == 0) {

				$password = ($password_1);
			}*/

			if($count > 0){
				echo " error: Email is already in use.<br>";
			}else{        
				
				$password = md5($password_1);
				//$password_2 = md5($password_2);        
				
				$query = "INSERT INTO customers (forename, surname, email, password)

				VALUES('$forename', '$surname','$email', '$password')";



				$return = mysqli_query($db, $query);  

		 //echo $query.'<br>'.$return;
				if($return){

					$_SESSION['success'] = "Welcome";

					header('location: index.php');
					exit;
				}else{
					echo 'Something went wrong. Please try again'; 
				}

			}
		}

		//}
	//}
}

// LOGIN USER

global $db, $email;



if (isset($_POST['login_user'])) {
	$email = mysqli_real_escape_string($db, $_POST['email']);

	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);

	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

	$password_1 = md5($_REQUEST['password_1']);

	$password_2 = md5($_REQUEST['password_2']);


	if (empty($email)) {
		array_push($errors, "Email is required");
	}
	if (empty($password_1)) {
		array_push($errors, "Password is required");
	}


	if ($password_1 !== $password_2) {

		array_push($errors, "The two passwords do not match");

	}


	if (count($errors) == 0) {
		$password = ($password_1);
		echo $email . $password;
		$query = "SELECT * FROM customers WHERE email='$email' AND password='$password'";
		$results = mysqli_query($db, $query);

		echo mysqli_num_rows($results);

		if (mysqli_num_rows($results) == 1) {


			$_SESSION['email'] = $email;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}else {
			array_push($errors, "Wrong email/password combination");
		}
	}
}



//FORGOT PASSWORD


$email = "";
$password = "";

if(isset($_POST['sendmail'])){

	$email = $_POST["email"];
        //$password = $_POST["password"];


	$chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*_";
	$newpassword = substr(str_shuffle($chars), 0, 8);
	require 'PHPMailerAutoload.php';
	require 'credential.php';

	$query = "UPDATE customers SET password = '".md5($newpassword)."' WHERE email= '$email'";


//echo 'Your new password is ' .$newpassword;exit;
	if(mysqli_query($db,$query)){
		$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
		try {
			//Server settings
		//	$mail->SMTPDebug = 3;                                 // Enable verbose debug output
			$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = true;                               // Enable SMTP authentication
			$mail->Username = EMAIL;                 // SMTP username
			$mail->Password = PASS;                           // SMTP password
			$mail->SMTPSecure = 'tsl';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 587;                                    // TCP port to connect to

			//Recipients
			$mail->setFrom(EMAIL, 'Sender');
			$mail->addAddress($_POST['email']);     // Add a recipient
			
			$mail->addReplyTo(EMAIL);

			//Content
			$mail->isHTML(true);                                  // Set email format to HTML
			
			$mail->Body    = 'Your new password is ' .$newpassword;


			$mail->send();
			echo 'Message has been sent. Your new password has been sent to your emails.';
		} catch (Exception $e) {
			echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
		}
	}else{
		echo 'Please Try Again';
	}
}

?>