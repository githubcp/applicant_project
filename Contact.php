<?php
require_once("./AbstractModel.php");
Class Contact extends AbstractModel
{
	protected $_table = "contacts";
	protected $_pk	  = "id";
	private $dbHost = "localhost";
	private $dbUser = "slicery";
	private $dbPass = "justinm1";
	private $dbDatabase = "customerparadigm";
	
	public function connect()
	{
		return new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbDatabase);
	}
	
	public function GetAll()
	{
		$connDB = $this->connect();
		$strSQL = "SELECT * FROM contacts ORDER BY id";
		$result = $connDB->query($strSQL);

		/*Check the Number of Rows*/
		$num_results = $result->num_rows;
		$num_columns = $result->field_count;
		
		/*Get the names of the fields*/
		$tableInfo = $result->fetch_fields();
		foreach ($tableInfo as $val)
		{
			$fieldList[] = $val->name;
		}

		$ColNum = 0;

		while ($ColNum < $num_columns)
		{
			//echo "<td>".$fieldList[$ColNum]."</td>";
			//iterate to the next value
			$ColNum++;
		}

		if ($num_results > 0)
		{
			while ($row = $result->fetch_assoc())
			{
				$ColNum = 0;
				while ($ColNum < $num_columns)
				{
					$return[$fieldList[$ColNum]][] = $row[$fieldList[$ColNum]];
					$ColNum++;
				}
			}
		}
		
		return $return;
	}
	
}
?>