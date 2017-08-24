<?php
session_start();
//error_reporting(E_ERROR);
$host = $_POST['host'];
$user = $_POST['user'];  
$pass = $_POST['pass'];  
$dbname = "'".$_POST['db']."'";  
$db = $_POST['db'];
$language = $_POST['lang'];

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
					'lang' => $language,)
	);

$configFile = dirname( dirname(__FILE__) ).'/config.ini';
$config = parse_ini_file($configFile, true);

if ($config['settings']['lang'] == "en") {
	include dirname( dirname(__FILE__) )."/lang/en.php";
	$LANG = "en";
} elseif ($config['settings']['lang'] == "hu") {
	include dirname( dirname(__FILE__) )."/lang/hu.php";
	$LANG = "hu";
}

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
	global $lang;
	write_ini_file($loginInfo, $configFile, true);
	echo $lang['installSuccess'];
	
}



if ($conn){
	echo $lang['connectSuccess'];
	if (mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS ".$db."")){
		echo $lang['dbCreated'];
	} else {
		echo $lang['dbExists'];
	}
	
	mysqli_select_db($conn, $db);
	$querycheck='SELECT 1 FROM `whiteboard_data`';

	$query_result=$conn->query($querycheck);

	if ($query_result !== FALSE)
	{
	  echo $lang['tableExists'];
	  if (mysqli_query($conn, "TRUNCATE TABLE whiteboard_data")){
			echo $lang['tableReset'];
			suc();
		} else{
			echo $lang['tableNotReset'];
		}
	} else
	{
		$sql = "CREATE TABLE whiteboard_data (id INT AUTO_INCREMENT,title VARCHAR(40) NOT NULL,description TEXT,owner VARCHAR(20),status TINYINT,primary key (id))";
		if (mysqli_query($conn, $sql)){
			echo $lang['tableCreated'];
			suc();
		} else {
			echo $lang['tableNotCreated'].mysqli_error($conn);
		}
	}
	
} else {
	echo $lang['notConnected'];
}

?>
