<?php

abstract class AbstractModel
{
	private $contactid = "";
	private $contactname = "";
	private $contactemail = "";
	
	public function save()
	{
		/*Connection to the Database*/
		$connDB = new mysqli("localhost","slicery","justinm1","customerparadigm");
		
		//$strSQL = "UPDATE CONTACTS SET ID = '?', Name = '?', Email = '?' WHERE ID = ".$this->contactid;
		$strSQL = "UPDATE CONTACTS SET ID = '".$this->contactid."', Name = '".$this->contactname."', Email = '".$this->contactemail."' WHERE ID = ".$this->contactid;
		
		$result = $connDB->prepare($strSQL);
		//$result->bind_param($this->contactid,$this->contactname,$this->contactemail);
		$result->execute();
	}
	
	public function load($id)
	{
		/*Sets the contact ID*/
		$this->contactid = $id;
		
		/*Connection to the Database*/
		$connDB = new mysqli("localhost","slicery","justinm1","customerparadigm");

		/*Places the strFields in the strSQL*/
		$strSQL = "SELECT ID, Name, Email FROM CONTACTS WHERE ID = ".$this->contactid;
		
		/**/
		if ($result = $connDB->prepare($strSQL))
		{
			$result->execute();
			
			$result->bind_result($var1, $var2, $var3);
			
			while($result->fetch())
			{
				$this->contactid = $var1;
				$this->contactname = $var2;
				$this->contactemail = $var3;
			}
		}

		return $this;
	}
	
	public function delete($id)
	{
	}
	
	public function getData($key=false)
	{
		if ($key == false)
		{
			$return = array("id"=>$this->contactid,"name"=>$this->contactname,"email"=>$this->contactemail);
		}
		else
		{
			if ($key == "id")
			{
				$return = $this->contactid;
			}
			if ($key == "name")
			{
				$return = $this->contactname;
			}
			if ($key == "email")
			{
				$return = $this->contactemail;
			}
		}
		return $return;
	}
	
	public function setData($arr, $value=false)
	{
		if (is_array($arr))
		{
			$this->contactid = $arr["id"];
			$this->contactname = $arr["name"];
			$this->contactemail = $arr["email"];
		}
		else
		{
			if ($arr == "id")
			{
				$this->contactid = $value;
			}
			
			if ($arr == "name")
			{
				$this->contactname = $value;
			}
			
			if ($arr == "email")
			{
				$this->contactemail = $value;
			}
		}
		
		return $this;
	}
}

?>