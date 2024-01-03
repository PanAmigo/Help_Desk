<?php
if (!file_exists("Config/Database_config.php")) {
    header("Location: install.php");
} else {
    header("Location: Pages/Home.php");
}
?>