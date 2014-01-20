<html>
	<head>
    	<script language="javascript">
			function GoHome()
			{
				window.location = "/"
			}
		</script>
    	<link rel="stylesheet" href="master.css" type="text/css">
    </head>
    <body>
<?php
	require_once("Contact.php");
	ini_set("display_errors", true);
	
	$contact = new Contact();
	$errCount = 0;
	
	if (isset($_POST['EditPosted']))
	{
		if ($_POST["ContactName"] == "")
		{
			$errCount++;
		}
		
		if ($_POST["ContactEmail"] == "")
		{
			$errCount++;
		}
		
		if ($errCount == 0)
		{
			$contact->load($_GET['id']);
			$contact->setData('name',$_POST["ContactName"]);
			$contact->setData('email',$_POST["ContactEmail"]);
			$contact->save();

			echo "Record has been saved";
		}
		else
		{
			echo "Please fill in both Name and Email.";
		}
	}
	else
	{
		if (isset($_GET['id']))
		{
			if (is_numeric($_GET['id']))
			{
				$contact->load($_GET['id']);
			}
			else
			{
				echo "<script>alert('Invalid Record');</script>";
				echo "<script language='javascript'>window.location = '/'</script>";
			}
	
		}

	}

	echo "<form name='contactInput' action='edit.php?id=".$_GET['id']."' method='post'>";
	echo "<div class='ContactTitle'>Contacts</div>";
	echo "<div class='ContactBody'>";
	echo "<input type='hidden' name='EditPosted' value='yes' />";
	echo "<div class='label'>ID: </div><div class='InputValue'><input type='text' value='".$contact->getData('id')."' name='ContactID' disabled='true' /></div><br />";
	echo "<div class='label'>Name: </div><div class='InputValue'><input type='text' value='".$contact->getData('name')."' name='ContactName' /></div><br />";
	echo "<div class='label'>Email: </div><div class='InputValue'><input type='text' value='".$contact->getData('email')."' name='ContactEmail' /></div><br />";
	echo "<input type='Submit' value='Submit' name='Submit' />";
	echo "<input type='button' value='Home' name='Home' onClick='GoHome()' />";
	echo "</div>";
	echo "</form>";

?>
	</body>
</html>