<html>
	<head>
    	<script language="javascript">
			function GoHome()
			{
				window.location = "/"
			}
		</script>
    </head>
    <body>
<?php
	require_once("Contact.php");
	ini_set("display_errors", true);
	
	$contact = new Contact();
	
	if (isset($_GET['id']))
	{
		if (is_numeric($_GET['id']))
		{
			$contact->delete($_GET['id']);
			echo "<script>alert('Record Deleted');</script>";
		}
		else
		{
			echo "<script>alert('Invalid Record');</script>";
		}
	}

	echo "<script language='javascript'>window.location = '/'</script>";

?>
	</body>
</html>