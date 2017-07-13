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

         $addIncomingTitle = 'Title';
         $addIncomingDesc = 'description';
         
         if(!$conn){  
            die('Could not connect: '.mysqli_connect_error());  
         }  
         echo 'Connected successfully<br/>';  
  
         $sql = "ALTER TABLE whiteboard_data AUTO_INCREMENT = 0";   
         if(mysqli_query($conn, $sql)){  
         echo "Query successful!";
         } else {  
            echo("Error description: " . mysqli_error($conn));//echo "Table is not created successfully ";  
         }  
         mysqli_close($conn);  
      ?>  
   </body>
</html>

