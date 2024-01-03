<?php
function urlOrigin($s, $use_forwarded_host = false)
{
    $ssl      = (!empty($s['HTTPS']) && $s['HTTPS'] == 'on');
    $sp       = strtolower($s['SERVER_PROTOCOL']);
    $protocol = substr($sp, 0, strpos($sp, '/')) . (($ssl) ? 's' : '');
    $port     = $s['SERVER_PORT'];
    $port     = ((!$ssl && $port == '80') || ($ssl && $port == '443')) ? '' : ':' . $port;
    $host     = ($use_forwarded_host && isset($s['HTTP_X_FORWARDED_HOST'])) ? $s['HTTP_X_FORWARDED_HOST'] : (isset($s['HTTP_HOST']) ? $s['HTTP_HOST'] : null);
    $host     = isset($host) ? $host : $s['SERVER_NAME'] . $port;
    return $protocol . '://' . $host;
}
function fullUrl($s, $use_forwarded_host = false)
{
    return urlOrigin($s, $use_forwarded_host) . $s['REQUEST_URI'];
}
$url = pathinfo(fullUrl($_SERVER));
$baseUrl = $url['dirname'];
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous" data-bs-no-jquery="true"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.9/dist/flatpickr.min.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
        <div class="card text-center">
            <form name="installBaseDataForm" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="POST">
                <div class="card-header">Instalator systemu Mantis</div>
                <div class="card-body">
                    <div class="mt-3">
                        <div class="form-floating">
                            <input type="Text" class="form-control" id="BaseUrl" name="BaseUrl" value="<?php echo $baseUrl; ?>" placeholder="BaseUrl" required>
                            <label for="BaseUrl">Adres serwisu</label>
                            <p class="card-text text-start"><small class="text-muted">Adres domenowy</small></p>
                        </div>
                    </div>
        </div>
        <div class="card text-center mt-2">
            <div class="card-header">Konto administratora</div>
            <div class="card-body">
                <div class="mt-3">
                    <div class="form-floating">
                        <input type="Text" class="form-control" id="name" name="name" placeholder="name" required>
                        <label for="name">Imię i Nazwisko</label>
                        <p class="card-text text-start"><small class="text-muted"></small></p>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="form-floating">
                        <input type="Text" class="form-control" id="login" name="login" placeholder="login" required>
                        <label for="login">Login</label>
                        <p class="card-text text-start"><small class="text-muted"></small></p>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="form-floating">
                        <input class="form-control" id="password" name="password" placeholder="password" value="<?php
                        function generateRandomPassword($length = 14) {
                            $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789%&@$#';
                            $password = '';
                            $charCount = strlen($characters);
                        
                            for ($i = 0; $i < $length; $i++) {
                                $password .= $characters[rand(0, $charCount - 1)];
                            };
                        
                            return $password;
                        }
                        $randomPassword = generateRandomPassword(14);
                        echo $randomPassword;
                        ?>"required readonly>
                        <label for="password">Twoje Hasło</label>
                        <p class="card-text text-start"><small class="text-muted"></small></p>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" name="InstallBaseData" value="Kontynuuj" class="btn btn-outline-primary">
            </div>
        </div>
        </form>
    </div>
</body>
</html>