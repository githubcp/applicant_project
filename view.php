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
	
	if (isset($_POST['ViewPosted']))
	{
		if (isset($_POST['Edit']))
		{
			echo "<script language='javascript'>window.location = '/edit.php?id=".$_GET['id']."'</script>";
		}
		
		if (isset($_POST['Delete']))
		{
			echo "<script language='javascript'>window.location = '/delete.php?id=".$_GET['id']."'</script>";
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
	echo "<input type='hidden' name='ViewPosted' value='yes' />";
	echo "<div class='label'>ID: </div><div class='InputValue'><input type='text' value='".$contact->getData('id')."' name='ContactID' disabled='true' /></div><br />";
	echo "<div class='label'>Name: </div><div class='InputValue'><input type='text' value='".$contact->getData('name')."' name='ContactName' disabled='true' /></div><br />";
	echo "<div class='label'>Email: </div><div class='InputValue'><input type='text' value='".$contact->getData('email')."' name='ContactEmail' disabled='true' /></div><br />";
	echo "<input type='Submit' value='Edit' name='Edit' />";
	echo "<input type='Submit' value='Delete' name='Delete' />";
	echo "<input type='button' value='Home' name='Home' onClick='GoHome()' />";
	echo "</div>";
	echo "</form>";

?>
	</body>
</html>