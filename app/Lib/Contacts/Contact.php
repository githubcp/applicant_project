<?php
//require_once("./AbstractModel.php");
Class Contact extends AbstractModel
{
	protected $_table = "contacts";
	protected $_pk	  = "id";
	private $dbHost = "localhost";
	private $dbUser = "slicery";
	private $dbPass = "justinm1";
	private $dbDatabase = "customerparadigm";
	protected $DevMode = false;

	public function connect()
	{
		$server = mysql_connect($this->dbHost, $this->dbUser, $this->dbPass);
		
		if (!mysql_select_db($this->dbDatabase, $server)) 
		{
		    echo 'Could not select database';
		    exit;
		}
		//return new mysqli($this->dbHost, $this->dbUser, $this->dbPass, $this->dbDatabase);
		return $server;
	}
	
	public function GetAll()
	{
		$connDB = $this->connect();
		$strSQL = "SELECT * FROM ".$this->_table." ORDER BY ".$this->_pk;
		$result = mysql_query($strSQL, $connDB);

		/*Check the Number of Rows*/
		$num_results = mysql_num_rows($result);
		
		/*Get the names of the fields*/
		//$tableInfo = $result->fetch_fields();
		//foreach ($tableInfo as $val)
		//{
		//	$fieldList[] = $val->name;
		//}

		$ColNum = 0;


		if ($num_results > 0)
		{
			while ($row = mysql_fetch_assoc($result))
			{
				$ColNum = 0;
				//while ($ColNum < $num_columns)
				//{
				//	$return[$fieldList[$ColNum]][] = $row[$fieldList[$ColNum]];
				//	$ColNum++;
				//}
				$return['id'][] = $row['id'];
				if ($this->DevMode) { echo "GetAll ID:".$row['id']."<br />"; }

				$return['name'][] = $row['name'];
				if ($this->DevMode) { echo "GetAll Name:".$row['name']."<br />"; }

				$return['email'][] = $row['email'];
				if ($this->DevMode) { echo "GetAll Email:".$row['email']."<br />"; }
			}
		}

		return $return;
	}
	
}
?>