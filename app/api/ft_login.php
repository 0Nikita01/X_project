<?php
    session_start();
    $_POST = json_decode( file_get_contents("php://input"), true );

    $login = $_POST["login"];
    $password = $_POST["password"];
    $auth = false;
    if ($password && $login)
    {
        $setting = json_decode( file_get_contents("./settings.json"), true );
        foreach ($setting as $key => $value)
        {
            if ($key == $login)
            {
                foreach ($value as $keyv => $val)
                {
                    if ($val['password'] == $password)
                    {
                        $auth = true;
                        $_SESSION["auth"] = true;
                        $_SESSION["user"] = $key;
                        echo json_encode( array("auth" => true));
                    }
                }
            }
        }
        if (!$auth)
        {
            echo json_encode( array("auth" => false));
        }
    }
    else
    {
        header("HTTP/1.0 400 Bad Request");
    }
?>