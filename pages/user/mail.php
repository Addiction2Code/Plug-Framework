<?php
if(!plug_logged_in()) { plug_do_login(); }
else
{
	if (isset($_REQUEST['submit']))
	{
		$to = $_REQUEST['to'];
		$query = mysql_query("SELECT id, email FROM ".plug_database("Users")." WHERE id={$to}");
		while($row = mysql_fetch_array($query))
		{
			$id = $row['id'];
			$recipient = $row['email'];
		}
		$name = $_REQUEST['name'];
		$email = $_REQUEST['email']; 
		$subject = $_REQUEST['subject'];
		$message = "Reply to the Email above, or you can also goto: http://madtast.com/?page=user/mail&select={$id}\n\n";
		$message .= $_REQUEST['message'];
		ini_set('Madtast Mail', $email);
		mail($recipient, $subject, $message, $email);

		$output .= "Thanks for sending your message!";
	}
	else
	{
		$sid = $_REQUEST['select'];
		$query = mysql_query("SELECT id, username FROM ".plug_database("Users")."");
		while($row = mysql_fetch_array($query))
		{
			$id = $row['id'];
			if($id == $sid)
			{
				$users .= "<option value=\"{$id}\" SELECTED>{$row['username']}</option>";
			}
			else
			{
				$users .= "<option value=\"{$id}\">{$row['username']}</option>";
			}
		}
		$query = mysql_query("SELECT first_name, last_name, email FROM ".plug_database("Users")." WHERE id={$_SESSION['user_id']}");
		while($row = mysql_fetch_array($query))
		{

			$your_email = $row['email'];
			$your_name = $row['first_name'].' '.$row['last_name'];
		}
		$output .= "<form method='post' action='".curPageURL()."'>
		<input name='email' type='hidden' value='{$your_email}'/>
		Recipient: <select name='to'>{$users}</select> <br />
		Subject: <input name='subject' type='text' /><br />
		<input name='name' type='hidden' value='{$your_name}' />
		Message:<br />
		<textarea name='message' rows='15' cols='90'></textarea><br />
		<input name='submit' value='Send' type='submit' />
		</form>";
	}
}
?>
