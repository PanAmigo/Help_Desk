<?php
session_start();

const configFile = "Config/Database_config.php";
if (!isset($_SESSION["Progress"])) {
    $_SESSION["Progress"] = 0;
}

if (isset($_POST["Install"]) && $_SESSION["Progress"] == 1) {
    $_SESSION["Progress"] = 2;
}

if (isset($_POST["InstallBaseData"]) && $_SESSION["Progress"] == 4) {
    $_SESSION["Progress"] = 5;
}

switch ($_SESSION["Progress"]) {
    case 1:
        include("Config/install_new.php");
        break;
    case 2:
        $file = fopen(configFile, "w");
        $config = "<?php
                    \$host=\"" . $_POST['host'] . "\";
                    \$user=\"" . $_POST['admin'] . "\";
                    \$password=\"" . $_POST['psswd'] . "\";
                    \$database=\"" . $_POST['DBName'] . "\";
                    \$link_install = mysqli_connect(\$host, \$user, \$password, \$database);\n
                    \$link = new mysqli(\$host, \$user, \$password, \$database);\n";


        if (!fwrite($file, $config)) {
            print "Nie mogę zapisać do pliku ($file)";
            exit;
        }
        fclose($file);
        $_SESSION["Progress"] = 3;
        echo "<p>Plik konfiguracyjny utworzony. Strona zostanie odświeżona!</p>";
        echo "<script>
                setTimeout(function() {
                    location.reload();
                }, 2500);
            </script>";
        break;

    case 3:
        echo "<p>Tworzenie bazy danych ...</p>";
        if (file_exists("Config/sql.php")) {
            include("Config/Database_config.php");
            include("Config/sql.php");

            echo "Tworzę tabele bazy: " . $database . ".<br>\n";
            mysqli_select_db($link_install, $database) or die(mysqli_error($link_install));
            for ($i = 0; $i < count($create); $i++) {
                echo "<p>" . $i . ". <code>" . $create[$i] . "</code></p>\n";
                $result=mysqli_query($link_install, $create[$i]);

                echo "$result\n";
            }
            echo "<p>Baza została utworzona! Strona zostanie odświeżona</p>";
            echo "<script>
                setTimeout(function() {
                   location.reload();
                }, 2500);
            </script>";
            $_SESSION["Progress"] = 4;
        } else {
            echo "<p>Skrypt do tworzenia bazy nie istnieje!<br> Upewnij się że plik znajduje się w folderze: <code>DataBase</code></p>";
        };
        break;

    case 4:
        include("Config/install_data.php");
        break;

    case 5:
        $config = "\n# App configuration: \n
        \$baseUrl=\"" . $_POST['BaseUrl'] . "\";
        ";
        if (is_writable(configFile)) {
            if (!$file = fopen(configFile, 'a')) {
                echo "Nie mogę otworzyć pliku (" . configFile . ")";
                exit;
            }
            if (fwrite($file, $config) == FALSE) {
                echo "Nie mogę zapisać do pliku (" . configFile . ")";
                exit;
            }
            echo "Sukces, zapisano (<code>konfigurację</code>) do pliku (" . configFile . "). Strona zostanie odświeżona";
            fclose($file);
            $_SESSION["Progress"] = 6;
            echo "<script>
                setTimeout(function() {
                    location.reload();
                }, 2500);
            </script>";
        } else {
            echo "Plik " . configFile . " nie jest zapisywalny! <br> Zmień uprawnienia i odśwież stronę!";
        }
        break;

    case 6:
        include("Config/Database_config.php");

        $passwordHash = password_hash($_POST["password"], PASSWORD_DEFAULT);

        $insert_ticket_status = "INSERT INTO `Status_type` (`status`) VALUES ('new'), ('inspection'), ('works in progress'), ('testing'), ('closed')";
        $result = $link->query($insert_ticket_status);
        $insert_user_status = "INSERT INTO `User_type` (`name`) VALUES ('Admin'), ('Operator'), ('Klient');";
        $result = $link->query($insert_user_status);
        $insert2 = "INSERT INTO `Company` (`name`) VALUES ('mantis')";
        $result = $link->query($insert2);
        $query = "INSERT INTO `User`(`password`, `Name`, `login`, `Id_type`, `Id_company`)
        VALUES('" . $passwordHash . "', '" . $_POST["name"] . "', '" . $_POST["login"] . "', '1', '1')";
        $result = $link->query($query);

        //mysqli_select_db($link_install, $database) or die(mysqli_error($link_install));
        //for ($i = 0; $i < count($insert); $i++) {
        //    echo "<p>" . $i . ". <code>" . $insert[$i] . "</code></p>\n";
        //    mysqli_query($link_install, $insert[$i]);
        //}
    
        echo "<p>Utworzono konto administratora! Strona zostanie odświeżona</p>";
        echo "<script>
                setTimeout(function() {
                    location.reload();
                }, 2500);
           </script>";
        $_SESSION["Progress"] = 7;
        break;

    case 7:
        header("Location: Pages/Home.php");
        break;

    default:
        echo "<h2>Instalator aplikacji</h2>";
        echo "<h3>Postępuj zgodnie z instrukcjami</h3>";
        if (file_exists(configFile)) {
            if (is_writable(configFile)) {
                $_SESSION["Progress"] = 1;
                echo "<p>Rozpoczynanie instalacji!</p>";
                echo '<script>
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    </script>';
            } else {
                echo "<p>Zmień uprawnienia do pliku <code>" . configFile . "</code><br>np. <code>chmod o+w " . configFile . "</code></p>";
                echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
            }
        } else {
            echo "<p>Stwórz plik <code>" . configFile . "</code><br>np. <code>touch " . configFile . "</code><br>Po czym odśwież strone</p>";
            echo "<p><button class=`btn btn-info' onClick='window.location.href=window.location.href'>Odśwież stronę</button></p>";
        }
        break;
    }
?>