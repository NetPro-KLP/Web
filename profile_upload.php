<?
    session_start();
    include_once 'db.php';

    $db = new db();

    $operation = $_POST["oper"];

    $idx = $_SESSION["idx"];
    $result = $db->mysqli->query("select `pw` from accounts where idx='{$idx}'");
    $result = $result->fetch_array(MYSQLI_ASSOC);

    if($operation == "imgupload")
    {
        $filename = $_FILES['img']['name'];
        $exts = array('jpg', 'png', 'gif','jpeg');
        $temp = strtolower(end(explode('.', $filename)));
    	if(!in_array($temp, $exts))
    		exit();

        function generateRandomString($length = 10) {
            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $charactersLength = strlen($characters);
            $randomString = '';
            for ($i = 0; $i < $length; $i++) {
                $randomString .= $characters[rand(0, $charactersLength - 1)];
            }
            return $randomString;
        }

        $rand = generateRandomString();
        $uploaddir = './assets/img/';
        $fn =  $rand . "." . $temp;
        $uploadfile = $uploaddir . $fn;
        if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
            echo "성공적으로 업로드 되었습니다.\n";
        } else {
            var_dump($_FILES);
            print "Err!\n";
        }

        $db->mysqli->query("update `accounts` set profileimg='{$fn}' where idx='{$idx}'");
    }
    else
    {
        $id = $_POST["id"];
        $pw = $_POST["pw"];
        $pw_again = $_POST["pw-again"];
        $name = $_POST["name"];
        $position = $_POST["position"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];

        if($pw == $pw_again)
        {
            if($result["pw"] == hash("sha256", $pw . $db->getSalt()))
            {
                $db->mysqli->query("update `accounts` set `id`='{$id}',`name`='{$name}',`position`='{$position}',`email`='{$email}',`phone`='{$phone}' where idx='{$idx}'");
                echo "성공적으로 업데이트 되었습니다";
            }
            else
                echo "이전 비밀번호 틀림";
        }
        else
            echo "비밀번호 확인 맞지않음";
    }
?>