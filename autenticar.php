<?php
session_start();

include 'dbConfig.php';

// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// If there is an error with the connection, stop the script and display the error.
if ( mysqli_connect_errno() ) {
	echo "<script>alert('Não foi possível conectar ao Banco de Dados.');
		window.location.href='index.html';</script>";
}

// Now we check if the data from the login form was submitted, isset() will check if the data exists.
if ( !isset($_POST['email'], $_POST['password']) ) {
	// Could not get the data that should have been sent.
	echo "<script>alert('Preencha os campos Email e Senha.');
		window.location.href='index.html';</script>";
}

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT id, password FROM usuario WHERE email = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the email is a string so we use "s"
	$stmt->bind_param('s', $_POST['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();

	if ($stmt->num_rows > 0) {
		$stmt->bind_result($id, $password);
		$stmt->fetch();
		// Account exists, now we verify the password.
		// Note: remember to use password_hash in your registration file to store the hashed passwords.
		
		// Se você não quiser usar nenhum método de criptografia de senha, basta substituir o seguinte código:
		// if (password_verify($_POST['password'], $password)) {
		// por if ($_POST['password'] === $password) {
			
		if (password_verify($_POST['password'], $password)) {
			// Verification success! User has loggedin!
			// Create sessions so we know the user is logged in, they basically act like cookies but remember the data on the server.
			session_regenerate_id();
			$_SESSION['loggedin'] = TRUE;
			$_SESSION['id'] = $id;
			$_SESSION['email'] = $_POST['email'];
			
			//echo 'Welcome ' . $_SESSION['name'] . '!';
			header('Location: ./home.php');
		} else {
			echo "<script>alert('Senha incorreta.');
				window.location.href='index.html';</script>";
		}
	} else {
		echo "<script>alert('Email não encontrado.');
			window.location.href='index.html';</script>";
	}

	$stmt->close();
}
?>

