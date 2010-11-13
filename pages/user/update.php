<?php
$output = '';
$use = "TRUE";

$output .= '<center><h3>Update Your Madtast Profile</h3></center>
<div class="information">';

$get_info = mysql_query("SELECT * FROM ".plug_database("Users")." WHERE id = '{$_SESSION['user_id']}'");
while($row = mysql_fetch_array($get_info))
{
	$fname = $row['first_name'];
	$lname = $row['last_name'];
	$username = $row['username'];
	$email = $row['email'];
	$password = $row['password'];
	$photo = $row['photo'];
}

if($_POST['submit'] == "Update")
{
	//$passwd = $_REQUEST['password'];
	//$passwd2 = md5($_REQUEST['password2']);
	$output .= "Testing Provided Information...<br><br>";
	$email = $_REQUEST['email'];
	$uname = $_REQUEST['uname'];
	$fname = $_REQUEST['fname'];
	$lname = $_REQUEST['lname'];
	$photo = $_POST['photo'];

	//Lets run some tests on the "guests" information

	if(checkEmail($email) == FALSE)
	{
		$use = "FALSE";
		$output .= 'The Email you have entered is Invalid!<br>';
	}

	$passwd = md5($passwd);

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

	if(strlen($username) < 5)
	{
		$use = "FALSE";
		$output .= 'Your username must be greater then 5 [FIVE] characters.<br>';
	}

	//Lets see if the "guest" will become a member

	if($use == "TRUE")
	{
		$test = mysql_query("UPDATE ".plug_database("Users")." SET first_name='$fname', last_name='$lname', photo='$photo', email='$email' WHERE id = {$_SESSION['user_id']}");
		if (! $test) { print "There was an Unexpected error, try again later. Sorry!"; } else { $output .= "Success... Your profile has been updated!"; }
	}
}
$output .= '
<form name="update" action="'.curPageURL().'"method="post">
<br>
Email Address: <input type="text" size="70" name="email" value="'.$email.'"><br><br>
Username: <input type="text" size="50" name="uname" value="'.$username.'" disabled="true"><br><br>
First Name: <input type="text" size="60" name="fname" value="'.$fname.'"><br><br>
Last Name: <input type="text" size="60px" name="lname" value="'.$lname.'"><br><br>
Photo URL: <input type="text" size="75px" name="photo" value="'.$photo.'"><br>
The photo should be sized 100x100, this may also be an avatar.<br><br>
By clicking Update you agree our terms of service again located <a href=?page=user/policy" target="new">here</a><br>
<input type="submit" name="submit" value="Update">
</form>
</div>';?>
