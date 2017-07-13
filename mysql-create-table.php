<html>
   <head>
   </head>
   
   <body>
      <?php  
         $host = 'localhost';  
         $user = 'root';  
         $pass = 'toor';  
         $dbname = 'WHITEBOARD';  
         $conn = mysqli_connect($host, $user, $pass,$dbname);  
         
         if(!$conn){  
            die('Could not connect: '.mysqli_connect_error());  
         }  
         echo 'Connected successfully<br/>';  
  
         $sql = "create table whiteboard_data (id INT AUTO_INCREMENT,title VARCHAR(40) NOT NULL,description TEXT,owner VARCHAR(20),status TINYINT,primary key (id))";   
         if(mysqli_query($conn, $sql)){  
         echo "Table created successfully";
         } else {  
            echo("Error description: " . mysqli_error($conn));//echo "Table is not created successfully ";  
         }  
         mysqli_close($conn);  
      ?>  
   </body>
</html>

