<?php
include (__DIR__.'/../Includes/Header.php');
$_SESSION['ticket_id'] = $_GET['id'];
include (__DIR__.'/../Config/Database_config.php');
include (__DIR__.'/../Query/get_details.php');
include (__DIR__.'/../Query/get_users.php');
include (__DIR__.'/../Query/get_statuses.php');
include (__DIR__.'/../Query/get_ticket_comments.php');
?>
<body>
    <h1>Szczegóły zgłoszenia</h1>
    <div class="ticket-details-row">
        <div class="ticket-detail">
            <label>Numer zgłoszenia:</label>
            <input class="w3-input" type="text" id="numer_zgloszenia" name="numer_zgloszenia" value=<?php echo $row["id_ticket"] ?> readonly disabled>
        </div>
        <div class="ticket-detail">
            <label>Data zgłoszenia:</label>
            <input class="w3-input" type="text" id="data_zgloszenia" name="data_zgloszenia" value=<?php echo $row["filing_date"] ?> readonly disabled>
        </div>
        <div class="ticket-detail">
            <label for="new_status">Status:</label>
            <?php
            if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2){
                echo '<select class="w3-select" id="new_status" name="status">';
                while ($row_status = mysqli_fetch_assoc($data_statuses)) {
                    $statusId = $row_status['Id_status'];
                    $statusName = $row_status['status'];
                    if ($statusName == $row["status_name"]) {
                        echo "<option value='$statusId' selected>$statusName</option>";
                    }
                    else {
                        echo "<option value='$statusId'>$statusName</option>";
                    }
                }
                echo '</select>';
            }
            else{
                echo '<input class="w3-input" type="text" id="new_status" name="status" value='.$row["status_name"].' readonly disabled>';
            }
            ?>
        </div>
    </div>
    <div class="ticket-details-row">
        <div class="ticket-detail">
            <label>Ostatnia modyfikacja:</label>
            <input class="w3-input" type="text" id="ostatnia_modyfikacja" name="ostatnia_modyfikacja" value=<?php echo $row["last_update"] ?> readonly disabled>
        </div>
        <div class="ticket-detail">
            <label>Utworzony przez:</label>
            <input class="w3-input" type="text" id="utworzony_przez" name="utworzony_przez" value=<?php echo $row["reporter_name"] ?> readonly disabled>
        </div>
        <div class="ticket-detail">
            <label>Marka:</label>
            <input class="w3-input" type="text" id="marka" name="marka" value=<?php echo $row["company_name"] ?> readonly disabled>
        </div>
        <div class="ticket-detail">
            <label>Przypisany Pracownik:</label>
            <?php
            if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2){
                echo '<select class="w3-select" id="new_operator" name="przypisany_pracownik">'.'/n';
                echo "<option value='NULL'>Oczekuje na przypisanie</option>";
                while ($row_user = mysqli_fetch_assoc($data_users)) {
                    $employeeId = $row_user['ID'];
                    $employeeName = $row_user['Name'];
                    if($employeeName == $row["operator_name"]){
                        echo "<option value='$employeeId' selected>$employeeName</option>";}
                        else {
                            echo "<option value='$employeeId'>$employeeName</option>";
                        }
                }
                echo '</select>';
            }
            else{
                echo '<input class="w3-input" type="text" id="new_operator" name="przypisany_pracownik" value='.$row["operator_name"].' readonly>';
            }
            ?>
        </div>
    </div>
    <div class="ticket-details-textarea">
        <label>Treść:</label>
        <textarea class="w3-input" id="content" name="content" rows="5" readonly><?php echo $row["ticket_content"] ?></textarea>
    </div>
    <div>
        <?php
            if($_SESSION['user_role'] == 1 || $_SESSION['user_role'] == 2){
                echo '<button type="button" class="btn btn-primary" id="update_ticket_btn">Zapisz zmiany!</button>'."\n";
            }
        ?>
        <button type="button" class="btn btn-primary" id="ticket_add_coment" data-toggle="modal" data-target="#add_comment_modal">Dodaj Komentarz!</button>
        <div class="modal fade" id="add_comment_modal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="add_comment_modal">Wpisz swoje uwagi</h5>
                        </button>
                    </div>
                    <div class="modal-body">
                        <textarea name="new_coment" id="new_coment" style='width: 100%'></textarea>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="add_new_comment">Dodaj</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div id="discussion-container" class="discussion-container">
        <?php
        include (__DIR__.'/../Query/get_comments.php');
        echo "<hr class='comment-divider'>";
        while ($row_comment = mysqli_fetch_assoc($data_comments)) {
            $commentContent = $row_comment['response'];
            $commentDate = $row_comment['date'];
            $commentAuthor = $row_comment['name'];
            echo "<div class='comment-container'>";
            echo "<div class='comment-header'>";
            echo "<div class='comment-author'>$commentAuthor</div>";
            echo "<div class='comment-date'>$commentDate</div>";
            echo "</div>";
            echo "<div class='comment-content'>$commentContent</div>";
            echo "</div>";
            echo "<hr class='comment-divider'>";
        }
        ?>
    </div>


</body>
<script src="../java_script/update_ticket.js"></script>
