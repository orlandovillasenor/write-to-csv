<?php 
require_once('filestore.php');
class UserDataStore extends Filestore {
    public function __construct($filename = '') 
    {
        $filename = strtolower($filename);
        parent::__construct($filename);       
    }
}
$filename = "data/users.csv";
$users = new UserDataStore($filename);
// $users_data = $users->read();
$users_data = [];
$prospects = [];

if (isset($_POST['submit'])) {
 	$number = $_POST['number'];
 	for($i = 1; $i <= $number; $i++){
 	    $firstname = str_shuffle('qiernguxytf');
     	$lastname = str_shuffle('potjbmnwtd');
     	$email = "namedroppertest" . $i . "@mailinator.com";
    	$prospects = [$email, $firstname, $lastname];
    	array_push($users_data, $prospects);
    	$users->write($users_data);
    	$prospects = [];
 	}
 		// Log user input for number of leads to create and save to file data.txt
 		$data = fopen(dirname(__FILE__) . '/data.txt', 'a+');
        $newString = $number . "\n";
        fwrite($data, $newString);
        fclose($data);
}

if (isset($_POST['download'])) {
	
	header('Content-type: text/csv');
	header('Content-Disposition: attachment; filename="users.csv"');
	readfile('data/users.csv');
	exit(0);
}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Admin Page</title>
	</head>
	<body>
		<h2>Namedropper Test Leads</h2>
		<h3>Download Leads As .csv</h3>
        <form method="post" action"">
		<p>
	        <button type="submit" name="download">Download</button>
	    </p>
	    </form>
        <table>
        	<thead>
        		<th>Email</th>
        		<th>First Name</th>
        		<th>Last Name</th>
        	</thead>
        	<tbody>
	            <?php foreach ($users_data as $key => $rows) {
	            	echo "<tr>";
	            	foreach ($rows as $row) {
	            		echo "<td>";
	            		echo $row;
	            		echo "</td>";
	            	}
	            	echo "</tr>";
	            } ?>
	                
            </tbody>   
        </table>
	</body>
</html>