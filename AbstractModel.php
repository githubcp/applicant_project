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
			$strSQL = "INSERT INTO ".$this->_table." (Name, Email) VALUES (?,?)";
			$result = $connDB->prepare($strSQL);
			$result->bind_param("ss",$this->contactname, $this->contactemail);
			$result->execute();
			$this->contactid = $result->insert_id;			
		}
		else
		{
			$strSQL = "UPDATE ".$this->_table." SET ID = ?, Name = ?, Email = ? WHERE ".$this->_pk." = ?";
			
			$result = $connDB->prepare($strSQL);
			$result->bind_param("issi",$this->contactid,$this->contactname,$this->contactemail,$this->contactid);
			$result->execute();
		}
		$result->close();
	}
	
	public function load($id)
	{
		/*Sets the contact ID*/
		$this->contactid = $id;
		
		/*Connection to the Database*/
		$connDB = $this->connect();

		/*Places the strFields in the strSQL*/
		$strSQL = "SELECT ID, Name, Email FROM ".$this->_table." WHERE ".$this->_pk." = ?";
		
		/**/
		$result = $connDB->prepare($strSQL);
		$result->bind_param("i",$this->contactid);
		$result->execute();
		
		$result->bind_result($var1, $var2, $var3);
		
		while($result->fetch())
		{
			$this->contactid = $var1;
			$this->contactname = $var2;
			$this->contactemail = $var3;
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

		$strSQL = "DELETE FROM  ".$this->_table." WHERE ".$this->_pk." = ?";
		
		$result = $connDB->prepare($strSQL);
		$result->bind_param("i", $deleteID);
		$result->execute();
		$result->close();
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
		/*Checks to see if the passed variable is an array or a key.*/
		if (is_array($arr))
		{
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