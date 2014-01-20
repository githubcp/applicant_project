<html>
	<head>
    </head>
    <body>

<?PHP
require_once("AbstractModel.php");
require_once("Contact.php");
ini_set("display_errors", true);

$contact = new Contact();

$records = $contact->GetAll();

$ColCount = count($records);
$RowCount = (count($records,1)/count($records,0))-1;

echo "<table border=1>";
echo "<tr><td colspan=4>Contacts</td></tr>";
echo "<tr><td colspan=4><a href=create.php>New Contact</a></td></tr>";
echo "<tr><td>ID</td><td>Name</td><td colspan=2>Email</td></tr>";

for ($RowNum = 0; $RowNum < $RowCount; $RowNum++)
{
	echo "<tr>";
	echo "<td>".$records['id'][$RowNum]."</td>";
	echo "<td>".$records['name'][$RowNum]."</td>";
	echo "<td>".$records['email'][$RowNum]."</td>";
	echo "<td><a href=view.php?id=".$records['id'][$RowNum].">view</a> | ";
	echo "<a href=edit.php?id=".$records['id'][$RowNum].">edit</a> | ";
	echo "<a href=delete.php?id=".$records['id'][$RowNum].">delete</a></td>";
	echo "</tr>";
	
}

?>

    </body>
</html>