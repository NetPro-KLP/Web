<?php
	include '../db.php';
	$db = new DB;

	$DBUSER = $db->getid();
	$DBPASSWD = $db->getpw();
	$DATABASE = $db->getdb();
	$TABLE = "rules_data";

	$type = $_POST["type"];

	if($type == "backup")
	{
		$filename = "backup-" . date('YmdHis');
		$option = $_POST["option-backup"];

		if($option == "SQL")
		{
			$filename .= ".sql";
			$mime = "application/octet-stream";
			$cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE $TABLE";
		}
		else if($option == "GZSQL")
		{
			$filename .= ".sql.gz";
			$mime = "application/x-gzip";
			$cmd = "mysqldump -u $DBUSER --password=$DBPASSWD $DATABASE $TABLE | gzip --best";
		}
		else if($option == "CSV")
		{
			$filename .= ".csv";
			$mime = "application/octet-stream";
			exec("mysqldump -u $DBUSER --password=$DBPASSWD --fields-terminated-by=',' --tab=/var/www/html/data $DATABASE $TABLE");
			$filepath = "/var/www/html/data/rules_data.txt";
		}
		else if($option == "RULES")
		{
			$filename .= ".rules";
			$mime = "application/octet-stream";
			$fuckingsql = '"' . "SELECT data FROM rules_data INTO OUTFILE '/var/www/html/data/rules_data.rules' FIELDS TERMINATED BY ',' LINES TERMINATED BY '\n'" . '"';
			exec("rm /var/www/html/data/rules_data.rules");
			exec("mysql -u$DBUSER -p$DBPASSWD $DATABASE -e " . $fuckingsql);
			$filepath = "/var/www/html/data/rules_data.rules";
		}

		header( "Content-Type: " . $mime );
		header( 'Content-Disposition: attachment; filename="' . $filename . '"' );

		if($option == "CSV" || $option == "RULES")
			readfile($filepath);
		else
			passthru( $cmd );

		exit(0);
	}
	else if($type == "recovery")
	{
		// webshell upload protect
		$filename = $_FILES["recovery-file"]["name"];
		$exts = array('csv', 'sql', 'rules');
		if(!in_array(strtolower(end(explode('.', $filename))), $exts))
			exit();

		$option = $_POST["option-recovery"];

		if($option == "SQL")
		{
			move_uploaded_file($_FILES['recovery-file']['tmp_name'] , "/var/www/html/data/rules_data.sql");
			exec("mysql -u$DBUSER -p$DBPASSWD $DATABASE < " . "/var/www/html/data/rules_data.sql");
			echo "<script>alert('적용 완료');window.location.href = '/RS';</script>";
		}
		else if($option == "CSV")
		{
			move_uploaded_file($_FILES['recovery-file']['tmp_name'] , "/var/www/html/data/rules_data.csv");
			exec("mysqlimport -u$DBUSER -p$DBPASSWD $DATABASE --fields-terminated-by=',' /var/www/html/data/rules_data.csv");
			echo "<script>alert('적용 완료');window.location.href = '/RS';</script>";
		}
		else if($option == "RULES")
		{
			move_uploaded_file($_FILES['recovery-file']['tmp_name'] , "/var/www/html/data/rules_data.rules");
			$rl = fopen("/var/www/html/data/rules_data.rules", "r");
			while (($line = fgets($rl)) !== false) {
    			if(isset($line))
    			{
                    $sql = "INSERT INTO `rules_data`(`data`) VALUES ('{$line}')";
                    $db->mysqli->query($sql);
                }
            }
    	    fclose($rl);
    	    echo "<script>alert('적용 완료');window.location.href = '/RS';</script>";
		}
	}
?>