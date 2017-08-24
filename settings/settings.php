<?php
$lang = $_POST['lang'];
$uninstall = $_POST['uninstall'];



$configFile = dirname( dirname(__FILE__) ).'/config.ini';
$config = parse_ini_file($configFile, true);

$host = $config['database']['host'] ;
$user = $config['database']['user'] ;
$pass = $config['database']['pass']  ;
$dbname = $config['database']['db'] ;
$is_installed = $config['install']['is_installed'];

$loginInfo = array(
				'database' => array(
					'host' => $host,
					'user' => $user,
					'pass' => $pass,
					'db' => $dbname),
				'install' => array(
					'is_installed' => $is_installed),
				'settings' => array(
					'lang' => $lang)
	);

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



if ($uninstall != "true"){
write_ini_file($loginInfo, $configFile, true);}
else {
$loginInfo = array(
            'database' => array(
                'host' => "",
                'user' => "",
                'pass' => "",
                'db' => ""),
            'install' => array(
                'is_installed' => 0),
            'settings' => array(
                'lang' => $lang)

); 
write_ini_file($loginInfo, $configFile, true);}

// write_ini_file($loginInfo, $configFile, true);}

	






?>
