<?php
$output = '';
$output .=
'<h3>Register For Interesting Technologies</h3>
<div style="
	width: 100%;
	text-align: center;
	background-color: #b7cad4;
	padding: 5px;
	display: block;
	text-decoration: none;
  	-moz-border-radius: 5px;
  	border-radius: 5px;">';
$use = "TRUE";

//Get information
$email = $_REQUEST['email'];
$uname = $_REQUEST['uname'];
$fname = $_REQUEST['fname'];
$lname = $_REQUEST['lname'];
$photo = $_POST['photo'];

function register_form($email, $uname, $fname, $lname)
{    return '
    <form name="register" action="'.curPageURL().'"method="post">
    <br>
    Email Address: <input type="text" name="email" value="'.$email.'"><br><br>
    Username: <input type="text" name="uname" value="'.$uname.'"><br><br>
    Password: <input type="password" name="password"><br><br>
    Again: <input type="password" name="password2"><br><br>
    First Name: <input type="text" name="fname" value="'.$fname.'"><br><br>
    Last Name: <input type="text" name="lname" value="'.$lname.'"><br><br>
    Photo URL: <input type="text" name="photo"><br><br><br>
    By clicking Register you agree to our policy located <a href="?page=user/policy" target="new">here</a><br>
    <input type="submit" name="submit" value="Register">
    </form>';
}

if($_POST['submit'] == "Register")
{
	$passwd = $_REQUEST['password'];
	$passwd2 = md5($_REQUEST['password2']);
	$output .= "Testing Provided Information...<br><br>";

	//Lets run some tests on the "guests" information

	if(strlen($passwd) < 7)
	{
		$use = "FALSE";
		$output .= 'The password must be six or more characters!<br>';
	}

	if(checkEmail($email) == FALSE)
	{
		$use = "FALSE";
		$output .= 'The Email you have entered is Invalid!<br>';
	}

	$passwd = md5($passwd);
	
	$get_info = mysql_query("SELECT * FROM ".plug_database("Users")); //articles asscoiated with categories
		//if (! $get_info) { print "Bad query: " . mysql_error(); }

	while($row = mysql_fetch_array($get_info))
	{
		$username = $row['username'];
		$email_addr = $row['email'];

		if(strtolower($uname) == strtolower($username))
		{
			$use = "FALSE";
			$output .= "The username {$uname} is already taken, Sorry!<br>";
		}

		if(strtolower($email) == strtolower($email_addr))
		{
			$use = "FALSE";
			$output .= "The owner of {$email} already has an account!<br>";
		}
	}

	if($fname == NULL)
	{
		$use = "FALSE";
		$output .= 'You must fill in your FIRST and LAST name to register, Thank you.<br>';
	}

	if($lname == NULL)
	{
		$use = "FALSE";
		$output .= 'You must fill in your FIRST and LAST name to register, Thank you.<br>';
	}

	if(strlen($uname) < 5)
	{
		$use = "FALSE";
		$output .= 'Your username must be greater then 5 [FIVE] characters.<br>';
	}

	if($passwd != $passwd2)
	{
		$use = "FALSE";
		$output .= 'Your passwords did not match up.<br>';
	}

	//Lets see if the "guest" will become a member

	if($use == "TRUE")
	{
		$test = mysql_query("INSERT INTO ".plug_database("Users")."
		(first_name, last_name, username, password, register_date, photo, email) VALUES ('$fname', '$lname', '$uname', '$passwd', NOW(), '$photo', '$email')");
		if (! $test) { print "There was an Unexpected error, try again later. Sorry!"; } else { $output .= "Thank you, you have been registered, you may now <a href=\"?page=user/login\">Login!</a>"; }

		$to = $email;
		$subject = "Madtast.com";
		$body = "Hello, {$fname} ${lname}, Thank you for registering!\nOn the site <a href=\"http://madtast.com/\">http://madtast.com</a>
			you will find various projects, currently we are in the development stages, your new username and password should allow you to access all of our projects.\n
			Because the site is still in development stages we will send you updates on our new and current projects as well as opertunitys to perticipate.";
		if (mail($to, $subject, $body))
		{
			$output .= 'Check your email!';
		}
		else
		{
			$output .= 'Email Failed!';
		}
	}
}
else
{
    $output .= register_form($email, $uname, $fname, $lname);
}

$output .= '</div>';?>
