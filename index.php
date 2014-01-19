<?PHP
require_once("AbstractModel.php");
require_once("Contact.php");
ini_set("display_errors", true);

$contact = new Contact();

$contact->load(1);
print_r($contact->getData()); 
// Should print:
// id => 1,
// name => John Doe
// email => john@doe.com
echo '<br/><br/>';
echo $contact->getData('name');
//Should print:
// John Doe

$contact->setData('name', 'John Walker')->save(); //Should run an UPDATE query
echo '<br/><br/>';
print_r($contact->load(1)->getData());
//Should print
// id => 1,
// name => John Walker
// email => john@doe.com

$contact->setData(array(
"id" => 1,
"name" => "John Doe the 2nd",
"email" => "john@doe2.com"
))->save();
echo '<br/><br/>';
print_r($contact->load(1)->getData());
//Should print
// id => 1,
// name => John Doe the 2nd
// email => john@doe2.com

print "<table width='400' border='0' align='center' cellpadding='3' cellspacing='1'>";
print "<tr>";
print "<td><strong>Contact Form </strong></td>";
print "</tr>";
print "</table>";

?>