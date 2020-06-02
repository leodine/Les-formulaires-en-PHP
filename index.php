<?php

require_once 'connec.php';

$pdo = new \PDO(DSN, USER, PASS);

$query = "SELECT * FROM friend";
$statement = $pdo->query($query);

//$friends = $statement->fetchAll();

$friends = $statement->fetchAll(PDO::FETCH_ASSOC);

echo "<ul>" . PHP_EOL;
foreach($friends as $friend) {
 	echo "<li>" . $friend['firstname'] . ' ' . $friend['lastname'] . "</li>" . PHP_EOL;    
}
echo "</ul>";
?>



<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>My Little Blog With PDO</title>
    
</head>
<body>
    
    <form  action="index.php"  method="post">
        <div>
            <label for="lastname">Lastname :</label>
            <input type="text"  id="lastname" name="lastname" required>
        </div><br>
        <div>
            <label for="firstname">Firstname :</label>
            <input type="text" id="firstname" name="firstname" required>
        </div>
        <br>
        <div >
            <button type="submit" id="submit" name="add">Submit</button>
        </div>
    </form>
    
<?php

if( isset( $_POST['add'] ) ) {
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];

	$query = "INSERT INTO friend (firstname, lastname) VALUES ('$firstname', '$lastname')";

	$statement = $pdo->prepare($query);

	$statement->bindValue(':lastname', $lastname, \PDO::PARAM_STR);
	$statement->bindValue(':firstname', $firstname, \PDO::PARAM_STR);

	$statement->execute();
	
	header('Location: index.php');
	die;
}


?>

</body>
</html>
