<?php 
	App::uses('AbstractModel','Contacts');
	App::uses('Contact','Contacts');
	
	$contact = new Contact();
	
	foreach($this->params['pass'] as $param)
	{
		$contactid = $param;
	}

	if (isset($contactid))
	{
		if (is_numeric($contactid))
		{
			$contact->delete($contactid);
			echo "<script>alert('Record Deleted');</script>";
		}
		else
		{
			echo "<script>alert('Invalid Record');</script>";
		}
	}

	echo "<script language='javascript'>window.location = '/CustomerParadigmProjects/index'</script>";

	

?>