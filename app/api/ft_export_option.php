<?php
    session_start();

    if ($_SESSION["auth"] != true)
    {
        header("HTTP/1.0 403 Forbidden");
        die;
    }

    $_POST = json_decode(file_get_contents("php://input"), true);

    $flag = $_POST["flag"];
    $upage = false;

    if ($flag)
    {
        $settings = json_decode( file_get_contents("./settings.json"), true );
        $user = $_SESSION["user"];
        $arr = array(
                "name"     => "",
                "scoreXP"  => "",
                "score"    => "",
                "status"   => "",
                "avatar"   => ""
        );
        
        foreach ($settings as $key => $value)
        {
            if ($user == $key)
            {
                $arr['name']    = $value[0]['name'];
                $arr['scoreXP'] = $value[0]['scoreXP'];
                $arr['score']   = $value[0]['score'];
                $arr['status']  = $value[0]['status'];
                $arr['avatar']  = $value[0]['avatar'];
                break;
            }
        }
        //print_r($arr);
        echo json_encode($arr);
    }
    else
    {
        header("HTTP/1.0 400 Bad Request");
    }
?>