<?php
    session_destroy();
    include (__DIR__.'/../Config/Database_config.php');
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $login = $_POST["Login"];
        $password = $_POST["Password"];
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        $query = "SELECT * FROM User WHERE login = '$login'";
        $result = $link->query($query);
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if(password_verify($password, $row["password"])){
                $_SESSION['user_id'] = $row["Id_User"];
                $_SESSION['user_role'] = $row["Id_type"];
                $_SESSION['Id_company'] = $row["Id_company"];
                header("location: ../Pages/Panel.php");
            }
            else{
                $errorMessage = "Błędne dane logowania, skontaktuj się z administratorem.";
            }
        } else {
            $errorMessage = "Błąd logowania. Spróbuj ponownie.";
        }
    }
?>