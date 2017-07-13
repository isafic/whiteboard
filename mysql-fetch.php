<html>
   <head>
   </head>
   
   <body>
      <?php 
         function fetchData(){
            $host = 'localhost';  
            $user = 'root';  
            $pass = 'toor';  
            $dbname = 'WHITEBOARD';  
            $conn = mysqli_connect($host, $user, $pass,$dbname);
            global $entry;
            $entry = [];
            if(!$conn){  
               die('Could not connect: '.mysqli_connect_error());  
            }  
            echo 'Connected successfully<br/>';  
     
            $sql = "SELECT * FROM whiteboard_data ORDER BY id asc";   

            if($result = mysqli_query($conn, $sql)){  
               $num_rows = mysqli_num_rows($result);
               //echo($num_rows);
               while($row = mysqli_fetch_array($result)){
                  $id = $row['id'];
                  $title = $row['title'];
                  $description = $row['description'];
                  $owner = $row['owner'];
                  $status = $row['status'];
                  $entry[$id] = [
                     'title' => $title, 
                     'description' => $description,
                     'owner' => $owner, 
                     'status' => $status
                  ];


                  
               }
            } else {  
               echo("Error description: " . mysqli_error($conn)); 
            }  
            mysqli_close($conn);  
         }




      ?>  
   </body>
</html>

