<h1>Contacts</h1>

<?php 
	App::uses('AbstractModel','Contacts');
	App::uses('Contact','Contacts');
	
	$contact = new Contact();
	
	foreach($this->params['pass'] as $param)
	{
		$contactid = $param;
	}
	echo $contactid;

	$errCount = 0;
	
	if (isset($contactid))
	{
		if (is_numeric($contactid))
		{
			$contact->load($contactid);
		}
		else
		{
			echo "<script>alert('Invalid Record');</script>";
			echo "<script language='javascript'>window.location = '/'</script>";
		}
	}

	//echo "<form name='contactInput' action='edit.php?id=".$_GET['id']."' method='post'>";
	echo "<div class='ContactTitle'>Contacts</div>";
	echo "<div class='ContactBody'>";
	echo "<div class='label'>ID: </div><div class='InputValue'><input type='text' value='".$contact->getData('id')."' name='ContactID' disabled='true' /></div><br />";
	echo "<div class='label'>Name: </div><div class='InputValue'><input type='text' value='".$contact->getData('name')."' name='ContactName' disabled='true' /></div><br />";
	echo "<div class='label'>Email: </div><div class='InputValue'><input type='text' value='".$contact->getData('email')."' name='ContactEmail' disabled='true' /></div><br />";
	
	echo $this->Form->button('Edit', array('onclick' => "location.href='/CustomerParadigmProjects/edit/".$contact->getData('id')."'"));
	echo $this->Form->button('Delete', array('onclick' => "location.href='/CustomerParadigmProjects/delete/".$contact->getData('id')."'"));
	echo $this->Form->button('Home', array('onclick' => "location.href='/CustomerParadigmProjects/index'"));
	
	echo "</div>";

?>