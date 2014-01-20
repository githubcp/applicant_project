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
	
	if (isset($_POST['CreatePosted']))
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

?>
		<form name="contactInput" action="create.php" method="post">
        	<div class="ContactTitle">Contacts</div>
            <div class="ContactBody">
            	<input type="hidden" name="CreatePosted" value="yes" />
            	<div class="label">Name: </div><div class="InputValue"><input type="text" value="" name="ContactName" /></div><br />
                <div class="label">Email: </div><div class="InputValue"><input type="text" value="" name="ContactEmail" /></div><br />
                <input type="Submit" value="Submit" name="Submit" />
                <input type="button" value="Home" name="Home" onClick="GoHome()" />
            </div>
        </form>
	</body>
</html>