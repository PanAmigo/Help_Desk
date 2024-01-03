<?php
    $isAdmin = ($_SESSION['user_role'] == 1);
    include(__DIR__.'/../Query/get_tickets_db.php');
    if ($isAdmin) {
        echo '<button onclick="showAdmin()">Panel Administratora</button>'."\n";
        echo '<button onclick="showUser()">Panel Użytkownika</button>'."\n";

        include(__DIR__.'/admin_panel.php');
    }
    ?>
    <div class='user'>
    <table id="data-table" border="1">
    <tr>
    <th onclick="sortTable(0)">Numer zgłoszenia</th>
    <th onclick="sortTable(1)">Data Zgłoszenia</th>
    <th onclick="sortTable(2)">Status</th>
    <th onclick="sortTable(3)">Ostatnia modyfikacja</th>
    <th onclick="sortTable(4)">Name</th>
    </tr>
    <?php
    while ($row = $data->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['Numer_zgłoszenia'] . '</td>';
        echo '<td>' . $row['Data_Zgłoszenia'] . '</td>';
        echo '<td>' . $row['Status'] . '</td>';
        echo '<td>' . $row['Ostatnia_modyfikacja'] . '</td>';
        echo '<td>' . $row['Name'] . '</td>';
        echo '<td><a href="Ticket.php?id=' . $row['Numer_zgłoszenia'] . '">Szczegóły</a></td>';
    }
    echo '</table>'."\n";
    $data->free();
    ?>
    <button onclick="location.href=\'new_ticket.php\'">Zgłoś błąd</button>
    </div>
    