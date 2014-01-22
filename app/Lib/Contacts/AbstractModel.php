<?php

abstract class AbstractModel
{
	private $contactid = "";
	private $contactname = "";
	private $contactemail = "";
	
	public function save()
	{
		/*Connection to the Database*/
		$connDB = $this->connect();
		
		/*Check to see if it is going to be an update or an insert*/
		if ($this->contactid == "")
		{
			if ($this->DevMode) { echo "Create: There is no contactid. Going to add record<br />"; }
			$strSQL = "INSERT INTO ".$this->_table." (Name, Email) VALUES ('".$this->contactname."','".$this->contactemail."')";
			if ($this->DevMode) { echo "Save strSQL: ".$strSQL."<br />"; }
			$result = mysql_query($strSQL, $connDB);
			//$this->contactid = $result->insert_id;			
		}
		else
		{
			if ($this->DevMode) { echo "Updating record: ".$this->contactid."<br />"; }
			$strSQL = "UPDATE ".$this->_table." SET ID = ".$this->contactid.", Name = '".$this->contactname."', Email = '".$this->contactemail."' WHERE ".$this->_pk." = ".$this->contactid."";
			$result = mysql_query($strSQL, $connDB);
		}

	}
	
	public function load($id)
	{
		/*Sets the contact ID*/
		$this->contactid = $id;
		
		/*Connection to the Database*/
		$connDB = $this->connect();

		/*Places the strFields in the strSQL*/
		$strSQL = "SELECT ID, Name, Email FROM ".$this->_table." WHERE ".$this->_pk." = ".$this->contactid;
		
		/**/
		$result = mysql_query($strSQL, $connDB);

		while ($row = mysql_fetch_assoc($result))
		{
			$ColNum = 0;
			$this->contactid = $row['ID'];
			if ($this->DevMode) { echo "Load ID: ".$this->contactid."<br />"; }
			$this->contactname = $row['Name'];
			if ($this->DevMode) { echo "Load Name: ".$this->contactname."<br />"; }
			$this->contactemail = $row['Email'];
			if ($this->DevMode) { echo "Load Email: ".$this->contactemail."<br />"; }
		}

		return $this;
	}
	
	public function delete($id=false)
	{
		if ($id==false)
		{
			$deleteID = $this->contactid;
		}
		else
		{
			$deleteID = $id;
		}
		/*Connection to the Database*/
		$connDB = $this->connect();

		$strSQL = "DELETE FROM  ".$this->_table." WHERE ".$this->_pk." = ".$deleteID;
		
		$result = mysql_query($strSQL, $connDB);
		
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
				if ($this->DevMode) { echo "getData ID:".$this->contactid."<br />"; }
			}
			if ($key == "name")
			{
				$return = $this->contactname;
				if ($this->DevMode) { echo "getData Name:".$this->contactname."<br />"; }
			}
			if ($key == "email")
			{
				$return = $this->contactemail;
				if ($this->DevMode) { echo "getData Email:".$this->contactemail."<br />"; }
			}
		}

		return $return;
	}
	
	public function setData($arr, $value=false)
	{
		/*Checks to see if the passed variable is an array or a key.*/
		if (is_array($arr))
		{
			if ($this->DevMode) { echo "setData - Is Array: True<br />"; }
			/*Populates the appropriate fields as needed.*/
			if (array_key_exists("id",$arr)) 
			{
				$this->contactid = $arr["id"];
			}
			if (array_key_exists("name",$arr)) 
			{
				$this->contactname = $arr["name"];
			}
			if (array_key_exists("email",$arr)) 
			{
				$this->contactemail = $arr["email"];
			}
		}
		/*Populates the appropriate fields based on the value passed.*/
		else
		{
			if ($this->DevMode) { echo "setData - Is Array: False<br />"; }
			if ($arr == "id")
			{	
				if ($this->DevMode) { echo "setData - ID: ".$value."<br />"; }
				$this->contactid = $value;
			}
			
			if ($arr == "name")
			{
				if ($this->DevMode) { echo "setData - Name: ".$value."<br />"; }
				$this->contactname = $value;
			}
			
			if ($arr == "email")
			{
				if ($this->DevMode) { echo "setData - Email: ".$value."<br />"; }
				$this->contactemail = $value;
			}
		}
		
		return $this;
	}
}

?>