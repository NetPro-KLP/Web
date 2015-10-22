<?php
    include_once 'db.php';
    $db = new db();

    $name = $_POST["name"];
    $hazzard = $_POST["hazzard"];
    $payload = $_POST["payload"];
    $date = $_POST["date"];


    $result = $db->mysqli->query("select content from `alarm` where type = 1");
    $row = $result->fetch_array(MYSQL_ASSOC);
    $content = $row["content"];

    $content = str_replace("{{name}}",$name,$content);
    $content = str_replace("{{hazzard}}",$hazzard,$content);
    $content = str_replace("{{payload}}",$payload,$content);
    $content = str_replace("{{date}}",$date,$content);

    $result = $db->mysqli->query("select content from `alarm` where type = 2");
    while($row = $result->fetch_array(MYSQL_ASSOC)){
        $mailto = $row["content"];
        $subject = "KLP-Firewall 악성 패킷 감지 이메일 알람";
        $headers = "From: KLP-Firewall <netproklp@gmail.com>";
        mail($mailto,$subject,$content,$headers);
    }

    $result = $db->mysqli->query("select content from `alarm` where type = 3");
    while($row = $result->fetch_array(MYSQL_ASSOC)){
        $bunho = str_replace("-", "", $row["content"]);
        array_push($bunhos, $bunho);
    }

    $SENDER = "010-4261-2666";
    $RECEIVERS = $bunhos;
    $CONTENT = "방화벽 악성 패킷 감지";
    $APPID = "KLP-Firwall";
    $APIKEY = "6dc4fa90786a11e595d00cc47a1fcfae";

    $data = array(
    			"sender" => $SENDER,
    			"receivers" => $RECEIVERS,
    			"content" => $CONTENT,
    		);

    $ch = curl_init("https://api.bluehouselab.com/smscenter/v1.0/sendsms");
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_USERPWD, "$APPID:$APIKEY");
    curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Content-Type: application/json; charset=utf-8"));
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    $response_header = curl_getinfo($ch);
    curl_close($ch);


?>