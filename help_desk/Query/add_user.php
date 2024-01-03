<?php
    include (__DIR__.'/../Config/Database_config.php');

    function generateRandomPassword($length = 14) {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%&@$#';
        $password = '';
        $charCount = strlen($characters);
    
        for ($i = 0; $i < $length; $i++) {
            $password .= $characters[rand(0, $charCount - 1)];
        };
    
        return $password;
    };
 
    $randomPassword = generateRandomPassword(14);
    $password_hash = password_hash($randomPassword, PASSWORD_DEFAULT);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST['login']; 
        $password = $password_hash; 
        $id_type = $_POST['permissions_new']; 
        $name = $_POST['name'];
        $id_company = $_POST['client_new'];}
    

    $query = "INSERT INTO User (login, password, Id_type, Name, Id_company) VALUES ('$login','$password','$id_type','$name','$id_company')";
    $result = $link->query($query);
    if ($result) {
        $response["success"] = true;
        $response["message"] = "Dodano nowego użytkownika.";
        $response["password"] = $randomPassword;
    } else {
        $response["success"] = false;
        $response["message"] = "Wystąpił błąd podczas dodawania danych użytkownika: " . $link->error;
    }
    echo json_encode($response);
?>