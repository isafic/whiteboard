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
					'install' => true
					),
				'install' => array(
					'is_installed' => true),
				'settings' => array(
					'test_val' => 4,)
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
	echo "A program sikeresen települt. Szívesen kitörölheti az /install/ mappát.";
}



if ($conn){
	echo "Sikeresen csatlakozott! <br>";
	if (mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS ".$db."")){
		echo "Adatbázis megcsinálva.<br>";
	} else {
		echo "Az adott adatbázis már létezik.<br>";
	}
	
	mysqli_select_db($conn, $db);
	$querycheck='SELECT 1 FROM `whiteboard_data`';

	$query_result=$conn->query($querycheck);

	if ($query_result !== FALSE)
	{
	  echo "Az asztal már létezik.<br>";
	  if (mysqli_query($conn, "TRUNCATE TABLE whiteboard_data")){
			echo "Az asztal sikeresen visszaállítva.<br>";
			suc();
		} else{
			echo "Az asztal nem volt sikeresen visszaállítva. Kérem próbalkozzon újra.<br>";
		}
	} else
	{
		$sql = "CREATE TABLE whiteboard_data (id INT AUTO_INCREMENT,title VARCHAR(40) NOT NULL,description TEXT,owner VARCHAR(20),status TINYINT,primary key (id))";
		if (mysqli_query($conn, $sql)){
			echo "Asztal sikeresen megcsinálva. <br>";
			suc();
		} else {
			echo "Az asztal nem volt sikeresen megcsinálva. Kérem próbalkozzon újra. : " .mysqli_error($conn);
		}
	}
	
} else {
	echo "<br>A sikeres kapcsolat nem jött össze. Legyen szives bisztosítsa azt, hogy a belépő informácio hejesen volt beírva.";
}

?>
