<!-- Header file -->
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 

        <title>Install Mantis</title>
    </head>
    <body class="d-flex flex-column min-vh-100">
        <div class="container">
            <div class="card text-center">
                <div class="card-header">Instalator systemu Mantis</div>
                <form name="installServerForm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                    <div class="card-body">
                        <div class="">
                            <div class="form-floating">
                                <input type="Text" class="form-control" id="host" name="host" placeholder="host" required>
                                <label for="host">Nazwa hosta</label>
                                <p class="card-text text-start"><small class="text-muted">host</small></p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <input type="Text" class="form-control" id="DBName" name="DBName" placeholder="DBName" required>
                                <label for="DBName">Nazwa bazy danych</label>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <input type="Text" class="form-control" id="admin" name="admin" placeholder="admin" required>
                                <label for="admin">Nazwa administratora bazy</label>
                                <p class="card-text text-start"><small class="text-muted">Login administratora bazy</small></p>
                            </div>
                        </div>
                        <div class="mt-3">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="psswd" name="psswd" required>
                                <label for="psswd">Hasło administratora bazy</label>
                                <p class="card-text text-start"><small class="text-muted">Hasło administratora bazy</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" name="Install" value="Kontynuuj" class="btn btn-outline-primary">
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>