<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbexample";
$xml=simplexml_load_file('data.xml');
$count=0;

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// SQL to create table on PHPAdmin
$sql = "CREATE TABLE IF NOT EXISTS Person (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(20) NOT NULL,
lastname VARCHAR(20) NOT NULL,
address VARCHAR(20) NOT NULL,
email VARCHAR(50) NOT NULL,
phone VARCHAR(50) NOT NULL,
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
  echo "Table Person created successfully<br>";
} else {
  echo "Error creating table: " . $conn->error;
}

foreach($xml->children() as $data){
    if(!empty($data->firstname) and !empty($data->lastname) and !empty($data->address) and !empty($data->email) and !empty($data->phone)){

        $sql="INSERT INTO Person (`firstname`, `lastname`, `address`,`email`, `phone`)" . "VALUES ('$data->firstname','$data->lastname', '$data->address','$data->email','$data->phone')";

        $qry_code=utf8_decode($sql);
        
        echo "Data saved successfully.<br>";
        
        mysqli_query($conn,$qry_code) or die(mysqli_error($conn));
    
        $count++;
    }
    else {
        die("Data has not been saved because some fields are empty."); 
    }
}


$conn->close();
?>