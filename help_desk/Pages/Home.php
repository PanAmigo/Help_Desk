<?php
    include (__DIR__.'/../Includes/Header.php');
    include (__DIR__.'/../Query/Login.php');
?>
    <div class="card mt-5">
        <div class="card-header text-center pt-3">
            <h1 class="h3 mb-3 fw-normal">Welcome in Mantis!</h1>
        </div>
        <form id="loginForm" class="form-horizontal" role="form" method="POST" action="">
            <div class="card-body">
                <div class="text-center">
                    <div class="mt-3">
                        <div class="form-floating">
                            <input type="text" class="form-control" id="Login" name="Login" placeholder="Twój login" required>
                            <label for="Login">Login</label>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="form-floating">
                            <input type="Password" class="form-control" id="Password" name="Password" placeholder="Password" required>
                            <label for="Password">Password</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer pt-4">
                <div class="d-grid col-4 mx-auto pb-3">
                    <button type="submit" class="btn btn-outline-primary">Zaloguj</button>
                </div>
                <?php 
                    if ($errorMessage != '') { ?>
                    <div class="mt-5">
                        <div id="login-alert" class="alert alert-danger col-sm-12"><?php echo $errorMessage; ?></div>                            
                    </div>
                    <?php } ?>
            </div>
        </form>
    </div>