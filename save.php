<?php

//Variables
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "";
$xml=simplexml_load_file('data.xml');
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Create database if not exists
$sql = "CREATE DATABASE IF NOT EXISTS myDB";
if (mysqli_query($conn, $sql)) {
    echo "Database created successfully<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

//"Reconnect"
mysqli_select_db ( $conn , "myDB" );

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}    

// Create table in database if not exists
$sql = "CREATE TABLE IF NOT EXISTS Person (
  id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  firstname VARCHAR(20) NOT NULL,
  lastname VARCHAR(20) NOT NULL,
  address VARCHAR(20) NOT NULL,
  email VARCHAR(50) NOT NULL,
  phone VARCHAR(50) NOT NULL,
  reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
  )";

if(mysqli_query($conn, $sql)){
    echo "Table person created successfully<br>";
} else {
    echo "Error creating table: " . mysqli_error($conn). "<br>";
}

// Save data
foreach($xml->children() as $data){
    if(!empty($data->firstname) and !empty($data->lastname) and !empty($data->address) and !empty($data->email) and !empty($data->phone)){

        $sql="INSERT INTO Person (`firstname`, `lastname`, `address`,`email`, `phone`)" . "VALUES ('$data->firstname','$data->lastname', '$data->address','$data->email','$data->phone')";

        $qry_code=utf8_decode($sql);
        
        echo "Data saved successfully.<br>";
        
        mysqli_query($conn,$qry_code) or die(mysqli_error($conn));
      
    }
    else {
        die("Data has not been saved because some fields are empty."); 
    }
}

mysqli_close($conn);
