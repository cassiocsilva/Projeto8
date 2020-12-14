<?php


        $json = file_get_contents('php://input');

         // decoding the received JSON and store into $obj variable.
        $obj = json_decode($json,true);

/*
console.log('jsonCompleto: ' + jsonCompleto);

jsonCompleto: {
"login":"T@t.co",
"position":{"mocked":false,"timestamp":1602420028543,
"coords":{"speed":0,"heading":0,"altitude":0,"accuracy":699.9990234375,"longitude":-47.1677451,"latitude":-23.0479702}},
"timestampToDate":"2020-10-11T12:40:28.543Z"}
*/
        
        
/*
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);

echo json_encode($arr);
*/        
        
        $login = $obj['login'];  // BD
        $position = $obj['position'];
        
        date_default_timezone_set('America/Sao_Paulo');
        
        $timestamp = $position['timestamp'];
        $timestampToDate = date("Y-m-d H:i:s", $timestamp / 1000);
        
        $timestampPhp = date("Y-m-d H:i:s");
        $data = date("Y-m-d");
        $hora = date("H:i:s");
        
        $coords = $position['coords'];
        
        $speed = $coords['speed'] *3.6; // BD
        $heading = $coords['heading']; // BD
        $altitude = $coords['altitude']; // BD
        $accuracy = $coords['accuracy']; // BD
        $longitude = $coords['longitude']; // BD
        $latitude = $coords['latitude']; // BD
        
        $response2 = array('0_posicao' => 'Registrada!!! ',
        '1_login' => $login, 
        '2_latitude' => $latitude, 
        '3_longitude' => $longitude, 
        '4_timestamp' => $timestamp, 
        '5_timestampToDate' => $timestampToDate, 
        '6_timestampPhp' => $timestampPhp
        );
        
        //echo json_encode($response2);
        
        
        


include 'dbConfig.php';

// Try and connect using the info from dbConfig.php
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	echo json_encode('mysqli_connect_errno');
}

        
        if ($stmt = $con->prepare('INSERT INTO posicao (email,timestamp,data,hora,velocidade,direcao,
                                altitude,acuracia,latitude,longitude) VALUES (?,?,?,?,?,?,?,?,?,?)')) {
        
			$stmt->bind_param('ssssssssss',$login,$timestampPhp,$data,$hora,$speed,$heading,
                                $altitude,$accuracy,$latitude,$longitude);
			
			$stmt->execute();
			
			// echo 'You have successfully registered, you can now login!';
			echo json_encode($response2);
                        
                        $stmt->close();
        
        } else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo json_encode('Falha no registro posicao');
                        
                        $stmt->close();
		}
        
        
        
        
        
        
        
        
?>