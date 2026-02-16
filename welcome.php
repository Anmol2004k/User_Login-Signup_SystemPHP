<?php
 session_start();

  if (!isset($_SESSION["userid"])) {
    header("location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Welcome</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-12">
                    <h1>Hello, <strong><?php echo $_SESSION["user"]["name"]; ?></strong>. Welcome to demo site.</h1>
                </div>
                <p class="mt-3">
                    <a href="logout.php" class="btn btn-secondary btn-lg active" role="button">Log Out</a>
                </p>
            </div>
        </div>
    </body>
</html>