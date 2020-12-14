<?php


        $json = file_get_contents('php://input');

         // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);

        $nome = $obj['nome'];
        $cpf = $obj['cpf'];
        $email = $obj['email'];
        $password= $obj['password'];
        
        
        if($obj['nome']==""){
          echo json_encode('Preencha campo NOME');
        }
        else if($obj['cpf']==""){
          echo json_encode('Preencha campo CPF');
        }
        else if($obj['email']==""){
          echo json_encode('Preencha campo EMAIL');
        }
        else if($obj['password']==""){
          echo json_encode('Preencha campo SENHA');
        }
        

        else{
        
include 'dbConfig.php';
        

// Try and connect using the info from dbConfig.php
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	echo json_encode('mysqli_connect_errno');
}


        if ($stmt = $con->prepare('SELECT activation_code FROM usuario WHERE email = ? ')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $obj['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
                if ($stmt->num_rows > 0) {		
                        // Username already exists
                        //echo 'CPF exists, please choose another!';
                        echo json_encode('Usuario ja existe');
                        $stmt->close();
		
                }
        }
        
        
        if ($stmt = $con->prepare('INSERT INTO usuario (cpf, password, email, activation_code) VALUES (?, ?, ?, ?)')) {
			
			// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
			//$password = password_verify($_POST['password'], PASSWORD_DEFAULT);
			$password = password_hash($obj['password'], PASSWORD_DEFAULT);
			
			//$stmt->bind_param('sss', $_POST['cpf'], $password, $_POST['email']);
			$uniqid = uniqid(); // activation_code
			$stmt->bind_param('ssss', $obj['cpf'], $password, $obj['email'], $uniqid);
			
			$stmt->execute();
			
			// echo 'You have successfully registered, you can now login!';
			echo json_encode('Registrado com sucesso'); 
                        
                        $stmt->close();
        
        } else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo json_encode('Falha no cadastro');
                        
                        $stmt->close();
		}
        
        
        }
?>