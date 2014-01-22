<h1>Contacts</h1>

<?php 
App::uses('AbstractModel','Contacts');
App::uses('Contact','Contacts');

$contact = new Contact();
$results = $contact->GetAll();

/*$displayFields = array('ID'=>'id',
					'Name'=>'name',
					'Email'=>'email');

$actions = array('View'=> array('Contacts/View', 'id'),
				'Edit'=> array('Contacts/Edit', 'id'),
				'Delete'=> array('Contacts/Delete', 'id'));

$this->Table->createTable('contacts',
								$results,
								$displayFields,
								$actions,
								'You do not have any contacts listed');
*/

		function GetArrayKeys(array $array)
		{
			$keys = array();
			
			foreach($array as $key => $value)
			{
				$keys[] = $key;
			}
			return $keys;
		}
		
		$contact = new Contact();
		
		$records = $contact->GetAll();
		
		$ColCount = count($records);
		$ColSpan = $ColCount + 1;
		$RowCount = (count($records,1)/count($records,0))-1;
		$ColumnNames = GetArrayKeys($records);
		
		echo "<table class='MasterTable' cellspacing=0>";
		echo "<tr class='ContactTitle'><td colspan=".$ColSpan.">Contacts</td></tr>";
		echo "<tr><td class='ContactNew' colspan=".$ColSpan."><a href=/CustomerParadigmProjects/create>New Contact</a></td></tr>";
		//echo "<tr><td>ID</td><td>Name</td><td colspan=2>Email</td></tr>";
		echo "<tr>";
		for ($ColNum = 0; $ColNum < $ColCount; $ColNum++)
		{
			if ($ColNum == 0)
			{
				$AddAttributes = "class='ContactHeaderLeft'";
			}
			elseif ($ColNum == $ColCount-1)
			{
				$AddAttributes = "class='ContactHeaderRight' colspan=2";
			}
			else
			{
				$AddAttributes = "class='ContactHeader'";
			}
			echo "<td ".$AddAttributes.">".$ColumnNames[$ColNum]."</td>";
		}
		echo "<td class>&nbsp;</td></tr>";
		
		for ($RowNum = 0; $RowNum < $RowCount; $RowNum++)
		{
			echo "<tr>";
			for ($ColNum = 0; $ColNum < $ColCount; $ColNum++)
			{
				if ($ColNum == 0)
				{
					$AddAttributes = "class='ContactCellLeft'";
				}
				else
				{
					$AddAttributes = "class='ContactCell'";
				}
				echo "<td ".$AddAttributes.">".$records[$ColumnNames[$ColNum]][$RowNum]."</td>";
			}
			echo "<td class='ContactCellRight'><a href=view/".$records['id'][$RowNum].">view</a> | ";
			echo "<a href=edit/".$records['id'][$RowNum].">edit</a> | ";
			echo "<a href=delete/".$records['id'][$RowNum].">delete</a></td>";
			echo "</tr>";
			
		}	

?>