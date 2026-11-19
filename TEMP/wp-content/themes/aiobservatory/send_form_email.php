<?php
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = "j.irwin@avionicapps.com";
    $email_subject = "AvionicApps Form Submittal";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted.<br /><br /> ";
 
        echo "These errors appear below.<br /><br />";
 
        echo "<font color='red'> $error </font><br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 //Check that data was entered
 
    if(!isset($_POST['first_name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['telephone']) ||
 
        !isset($_POST['comments'])) {
 
        died('No data entered');      
 
    }
 
     
 //Assign the html form fields to PHP variables
    $first_name = $_POST['first_name']; 
 
    $email_from = $_POST['email']; 
 
    $telephone = $_POST['telephone'];
 
    $comments = $_POST['comments']; 
 
     
 
    $error_message = "";
	
	
 //---------------------------------------------------------------------------VALIDATION START
 //Validation on email...if not error
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
 
 //Validation on first name...if not error

    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$first_name)) {
 
    $error_message .= 'The First Name you entered does not appear to be valid.<br />';
 
  }
 
 
 
 //Validation on comments...if not error
 
  if(strlen($comments) < 2) {
 
    $error_message .= 'The Comments you entered do not appear to be valid.<br />';
 
  }

 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
 //---------------------------------------------------------------------------VALIDATION END
 
 
 
 
 
 
  // Message in body of email
    $email_message = "Form details below.\n\n";
 
     
 
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 
     
	 
 // Labels in body of email
    $email_message .= "First Name: ".clean_string($first_name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
 
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
     
 
     
 
// create email headers
 
$headers = 'From: '.$email_from."\r\n".
 
'Reply-To: '.$email_to."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers); 
 
 
 

 
 
 
 
 
 
 
 // Success html follows
?>
 
 
<!DOCTYPE html>
<html lang="en">
<head>

<title>Contacts</title>

<meta charset="utf-8">

<link rel="stylesheet" href="css/camera.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/grid.css" type="text/css" media="screen">
<link rel="stylesheet" href="css/style.css" type="text/css" media="screen">

<script src="js/jquery.js"></script>
<script src="js/jquery-migrate-1.1.1.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<link rel="stylesheet" href="css/ie.css" type="text/css" media="screen">
<link href='http://fonts.googleapis.com/css?family=Lato:300italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:300' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:400' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Lato:700' rel='stylesheet' type='text/css'>
<![endif]-->
</head>

<body>


<header>
  <div class="container_12">
    <div class="grid_12">
      <div class="wrapper"> 
        <nav>
        </nav>
      </div>
    </div>
  </div>
</header>



<div id="content">
  <div class="inner pad1">
    <div class="container_12">
      <div class="wrapper h-pad">
        <div class="grid_7">
          
		  <h2>Thanks for the message!</h2>
		  Someone from our sales team will contact you shortly
		  <br>
		  <br>
		  <a href="index.html">Home</a>
		  
            <div class="wrapper">
            <div class="grid_4 alpha">
				
            </div>
          </div>
        </div>
		
        <div class="grid_4 prefix_1"></div>
        
      </div>
    </div>
  </div>
</div>

</body>
</html>
  
 
<?php
 
}
 
?>