<?php
// Change this to your connection info.
$DATABASE_HOST = 'fdb25.awardspace.net';
$DATABASE_USER = '3453558_projeto8';
$DATABASE_PASS = 'ZlTNmTKN1TQL5cWnv6)y';
$DATABASE_NAME = '3453558_projeto8';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	echo "<script>alert('Não foi possível conectar ao Banco de Dados.');
		window.location.href='index.html';</script>";
}

// We need to check if the account with that cpf exists.
if ($stmt = $con->prepare('SELECT id, password FROM usuario WHERE cpf = ? OR email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('ss', $_POST['cpf'], $_POST['email']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		
		// Username already exists
		//echo 'CPF exists, please choose another!';
		echo "<script>alert('CPF e/ou email já existe(m) no sistema. Faça login.');
			window.location.href='index.html';</script>";
		
	} else {
		
		// Email Validation
		if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
			echo "<script>alert('O E-mail não é válido.');
				window.location.href='index.html';</script>";
		}
		
		// CRIAR VALIDAÇÃO CPF //////////////////////////
		/*
		// Invalid Characters Validation
		if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
			exit('Username is not valid!');
		}
		*/
		
		// Character Length Check
		if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 3) {
			echo "<script>alert('A senha deve ter entre 3 e 20 caracteres.');
				window.location.href='index.html';</script>";
		}
		
		// Insert new account
		
		// Username doesnt exists, insert new account
		
		//if ($stmt = $con->prepare('INSERT INTO accounts (cpf, password, email) VALUES (?, ?, ?)')) {
		if ($stmt = $con->prepare('INSERT INTO usuario (cpf, password, email, activation_code) VALUES (?, ?, ?, ?)')) {
			
			// We do not want to expose passwords in our database, so hash the password and use password_verify when a user logs in.
			//$password = password_verify($_POST['password'], PASSWORD_DEFAULT);
			$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
			
			//$stmt->bind_param('sss', $_POST['cpf'], $password, $_POST['email']);
			$uniqid = uniqid(); // activation_code
			$stmt->bind_param('ssss', $_POST['cpf'], $password, $_POST['email'], $uniqid);
			
			$stmt->execute();
			
			// echo 'You have successfully registered, you can now login!';
			echo "<script>alert('Registro criado com sucesso, agora você pode logar!');
				window.location.href='index.html';</script>";
						
			/*
			$from    = 'noreply@yourdomain.com';
			$subject = 'Account Activation Required';
			$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
			$activate_link = 'http://yourdomain.com/phplogin/activate.php?email=' . $_POST['email'] . '&code=' . $uniqid;
			$message = '<p>Please click the following link to activate your account: <a href="' . $activate_link . '">' . $activate_link . '</a></p>';
			mail($_POST['email'], $subject, $message, $headers);
			echo 'Please check your email to activate your account!';
			*/
			
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo "<script>alert('Não foi possível cadastrar com os dados inseridos.');
				window.location.href='index.html';</script>";
		}
		
	}
	$stmt->close();
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo "<script>alert('Não foi possível cadastrar com os dados inseridos.');
		window.location.href='index.html';</script>";
}
$con->close();
?>