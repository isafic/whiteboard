<?php
session_start();
//error_reporting(E_ERROR);
$host = $_POST['host'];
$user = $_POST['user'];  
$pass = $_POST['pass'];  
$dbname = "'".$_POST['db']."'";  
$db = $_POST['db'];

$_SESSION['host'] = $host;
$_SESSION['user'] = $user;
$_SESSION['pass'] = $pass;
$_SESSION['db'] = $db;

$conn = mysqli_connect($host, $user, $pass); 

$loginInfo = array(
				'database' => array(
					'host' => $host,
					'user' => $user,
					'pass' => $pass,
					'db' => $db,
					),
				'settings' => array(
					'test_val' => 3,)
	);

$configFile = dirname( dirname(__FILE__) ).'/config.ini';

function write_ini_file($assoc_arr, $path, $has_sections=FALSE) { 
    $content = ""; 
    if ($has_sections) { 
        foreach ($assoc_arr as $key=>$elem) { 
            $content .= "[".$key."]\n"; 
            foreach ($elem as $key2=>$elem2) { 
                if(is_array($elem2)) 
                { 
                    for($i=0;$i<count($elem2);$i++) 
                    { 
                        $content .= $key2."[] = \"".$elem2[$i]."\"\n"; 
                    } 
                } 
                else if($elem2=="") $content .= $key2." = \n"; 
                else $content .= $key2." = \"".$elem2."\"\n"; 
            } 
        } 
    } 
    else { 
        foreach ($assoc_arr as $key=>$elem) { 
            if(is_array($elem)) 
            { 
                for($i=0;$i<count($elem);$i++) 
                { 
                    $content .= $key."[] = \"".$elem[$i]."\"\n"; 
                } 
            } 
            else if($elem=="") $content .= $key." = \n"; 
            else $content .= $key." = \"".$elem."\"\n"; 
        } 
    } 

    if (!$handle = fopen($path, 'w')) { 
        return false; 
    }

    $success = fwrite($handle, $content);
    fclose($handle); 

    return $success; 
}


function suc(){
	global $loginInfo;
	global $configFile;
	write_ini_file($loginInfo, $configFile, true);
	echo "Whiteboard was installed successfully! Feel free to delete the /install/ folder.";
}



if ($conn){
	echo "Connected successfully! <br>";
	if (mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS ".$db."")){
		echo "Database created.<br>";
	} else {
		echo "Database alrady exists.<br>";
	}
	
	mysqli_select_db($conn, $db);
	$querycheck='SELECT 1 FROM `whiteboard_data`';

	$query_result=$conn->query($querycheck);

	if ($query_result !== FALSE)
	{
	  echo "Table exists.<br>";
	  if (mysqli_query($conn, "TRUNCATE TABLE whiteboard_data")){
			echo "Table reset successfully. <br>";
			suc();
		} else{
			echo "Table was not reset successfully. Please try again. <br>";
		}
	} else
	{
		$sql = "CREATE TABLE whiteboard_data (id INT AUTO_INCREMENT,title VARCHAR(40) NOT NULL,description TEXT,owner VARCHAR(20),status TINYINT,primary key (id))";
		if (mysqli_query($conn, $sql)){
			echo "Table was created successfully.  <br>";
			suc();
		} else {
			echo "Table was not created successfully. Please try again. : " .mysqli_error($conn);
		}
	}
	
} else {
	echo "<br>Could not connect successfully. Please check that your login information is correct.";
}

?>
