<?php
    include (__DIR__.'/../Query/get_users.php');
    include (__DIR__.'/../Query/insert_new_client.php');
    include (__DIR__.'/../Query/get_user_types.php');
    echo $_SESSION['query'];
?>        
    <div class='admin' style="display:none">
        <button onclick="show_users()">Wyświetl użytkowników</button>
        <button onclick="show_company()">Wyświetl Klientów</button>
        
        <div class='users_all' style="display:none">
            <table id="data-users-table" border="1">
            <tr>
            <th onclick="sortTable(0)">ID</th>
            <th onclick="sortTable(1)">Imie</th>
            <th onclick="sortTable(2)">Uprawnienia</th>
            <th onclick="sortTable(3)">Firma</th>
            <th onclick="sortTable(4)">Edycja</th>
            </tr>
            <?php
            while ($row = $data_users->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['Name'] . '</td>';
                echo '<td>' . $row['user_type_name'] . '</td>';
                echo '<td>' . $row['company_name'] . '</td>';
                echo '<td><button type="button"  class="btn btn-primary" id="user-edit-btn" data-toggle="modal" data-user_id="'.$row['ID'].'">Edycja</td>';
            }
            ?>
            </table>
            <button type="button" id="add_new_user" data-toggle="modal" data-target="#user_new_modal">Dodaj nowego!</button>
            
            <div class="modal fade" id="user_edit_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="user_name">Nazwa</label>
                                <input type="text" class="form-control" id="user_name" placeholder="<?php echo $_SESSION['one_user_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="user_login">Login</label>
                                <input type="text" class="form-control" id="user_login" placeholder="Wprowadź login użytkownika">
                            </div>
                            <div class="form-group">
                                <label for="user_permissions">Uprawnienia</label>
                                <?php
                                    echo '<select class="w3-select" id="user_permissions">';
                                    while ($row_type = mysqli_fetch_assoc($data_types)) {
                                        $typeId = $row_type['Id_type'];
                                        $typeName = $row_type['name'];
                                        echo "<option value='$typeId'>$typeName</option>";}
                                    echo '</select>';
                                ?>
                            </div>
                            <div class="form-group">
                                <label for="user_company">Firma</label>
                                <?php
                                    echo '<select class="w3-select" id="user_company">';
                                    while ($row_company = mysqli_fetch_assoc($data_company2)) {
                                        $companyId = $row_company['Id_company'];
                                        $companyName = $row_company['company_name'];
                                        echo "<option value='$companyId'>$companyName</option>";
                                    }
                                    echo '</select>';
                                ?>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="user_update_btn">Zapisz</button>
                            <button type="button" class="btn btn-primary" id="user_delete_btn">Usuń</button>
                            <button type="button" class="btn btn-primary" id="change_psswd_btn">Zmień Hasło</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class='company' style="display:none">
            <table id="data-company-table" border="1">
            <tr>
            <th onclick="sortTable(0)">ID</th>
            <th onclick="sortTable(1)">Nazwa</th>
            <th onclick="sortTable(2)">Pracowników</th>
            <th onclick="sortTable(3)">Edytuj</th>
            </tr>
            <?php
            while ($row = $data_company->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['Id_company'] . '</td>';
                echo '<td>' . $row['company_name'] . '</td>';
                echo '<td>' . $row['users'] . '</td>';
                echo '<td><button type="button" class="btn btn-primary client-edit-btn" data-toggle="modal" data-target="#client_edit_modal" data-client_id="' . $row['Id_company'] . '">Edycja</button></td>';
            }
            ?>
            </table>
            <button type="button" class="btn btn-primary" id="new_client" data-toggle="modal" data-target="#add_client_modal">Dodaj nowego!</button>
            <div class="modal fade" id="add_client_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_client_modal_title">Wpisz nazwę nowej firmy</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="text" name="New_client" id="New_client" placeholder="Nazwa firmy">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Anuluj</button>
                                    <button type="submit" class="btn btn-primary">Dodaj</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="client_edit_modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="add_client_modal_title">Edytuj Klienta</h5>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <input type="text" name="New_client" id="New_client_name" placeholder="Wprowadź nową nazwę">
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="edit_client_btn">Edytuj</button>
                                    <button type="button" class="btn btn-primary" id="delete-client-btn">Usuń</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="delete-confirm-modal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="delete_confirm_modal_title">Potwierdź Usunięcie</h5>
                        </div>
                        <div class="modal-body">
                            Czy na pewno chcesz usunąć tego klienta? Usunięcie go spowoduje usunięcie również wszystkich przypisanych do niego użytkowników.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="delete_confirm">Tak</button>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                <div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Operacja zakończona sukcesem</h5>
                            </div>
                            <div class="modal-body">
                                <p>Operacja została pomyślnie zakończona.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="error-modal" tabindex="-1" role="dialog" aria-labelledby="error-modal-label" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="error-modal-label">Błąd!</h5>
                        </div>
                        <div class="modal-body">
                            <p id="error-modal-body">Wystąpił błąd. Proszę spróbować ponownie.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="passwordModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Nowe hasło</h4>
                    </div>
                    <div class="modal-body">
                        <p id="passwordText"></p>
                    </div>
                </div>
            </div>
        </div>

        <div id="user_new_modal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <h2>Dodaj nowego użytkownika</h2>
                    </div>
                    <div class="modal-body">
                        <form id="userForm">
                        <label for="name">Imię i Nazwisko:</label>
                        <input type="text" id="name" name="name" required><br>

                        <label for="login">Login:</label>
                        <input type="text" id="login" name="login" required><br>

                        <label for="permissions_new">Uprawnienia:</label>
                        <select id="permissions_new" name="permissions_new">
                        <?php
                            while ($row_type = mysqli_fetch_assoc($data_types2)) {
                                $typeId = $row_type['Id_type'];
                                $typeName = $row_type['name'];
                                echo "<option value='$typeId'>$typeName</option>";}
                            echo '</select>';
                        ?>
                        </select>
                        <label for="client_new">Klient:</label>
                        <select id="client_new" name="client_new">
                        <?php
                            while ($row_company = mysqli_fetch_assoc($data_company3)) {
                                $companyId = $row_company['Id_company'];
                                $companyName = $row_company['company_name'];
                                echo "<option value='$companyId'>$companyName</option>";
                            }
                            echo '</select>';
                        ?>
                        </select>
                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="saveButton">Zapisz</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal fade" id="passwordModal_new_user">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Hasło</h4>
                    </div>
                    <div class="modal-body">
                        <p id="user_passwordText"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../java_script/delete_client.js"></script>
    <script src="../java_script/edit_client.js"></script>
    <script src="../java_script/edit_user.js"></script>
    <script src="../java_script/add_user.js"></script>

