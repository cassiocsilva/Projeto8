<?php

include 'dbConfig.php';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {

	// If there is an error with the connection, stop the script and display the error.
	echo json_encode('mysqli_connect_errno');
}


$json = file_get_contents('php://input');

// decoding the received JSON and store into $obj variable.
$obj = json_decode($json,true);
        
$email = $obj['email'];
$senha = $obj['senha'];
        
        
if($obj['email']==""){
        echo json_encode('Preencha campo EMAIL');
}
else if($obj['senha']==""){
        echo json_encode('Preencha campo SENHA');
}


// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT password FROM usuario WHERE email = ?')) {

	// Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
	$stmt->bind_param('s', $obj['email']);
	$stmt->execute();
        
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
        
                $stmt->bind_result($password);
		$stmt->fetch();
                
                if (password_verify($obj['senha'], $password)) {
                        echo json_encode('Verificado com sucesso');
		} else {
                        echo json_encode('Senha incorreta');                        
		}
	} else {
		echo json_encode('Email nao encontrado');
	}

	$stmt->close();
}

?>