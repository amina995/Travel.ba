<?php 
     $conn = new mysqli('127.0.0.1', 'dbuser', 'dbpassword', 'travel final');
      // Check connection
      if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
      } 

 ?>