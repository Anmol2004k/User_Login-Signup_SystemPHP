<?php
require_once "config.php";
require_once "session.php"; // Isko tabhi on karein agar session file bani hui hai

$error = ''; // Error variable ko bahar define karein taaki HTML mein show ho sake

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    $fullname = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST["confirm_password"]);
    
    // Check if email already exists
    if($query = $db->prepare("SELECT id FROM users WHERE email = ?")) {
        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();
        
        if ($query->num_rows > 0) {
            $error .= '<p class="error">The email address is already registered!</p>';
        } else {
            // Validate password length
            if (strlen($password) < 6) {
                $error .= '<p class="error">Password must have at least 6 characters.</p>';
            }
            // Validate confirm password
            if ($password != $confirm_password) {
                $error .= '<p class="error">Password did not match.</p>';
            }

            // Agar koi error nahi hai, toh insert karein
            if (empty($error)) {
                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                if($insertQuery = $db->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)")) {
                    $insertQuery->bind_param("sss", $fullname, $email, $password_hash);
                    $result = $insertQuery->execute();
                    
                    if ($result) {
                        $error .= '<p class="success">Your registration was successful!</p>';
                    } else {
                        $error .= '<p class="error">Something went wrong during insertion!</p>';
                    }
                    $insertQuery->close(); // Sirf tab close karein jab ye execute ho
                }
            }
        }
        $query->close(); // Email check wali query close
    }
    
    // Database connection close
    mysqli_close($db);
}
?>

<?php echo $error; ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Sign Up</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2>Register</h2>
                    <p>Please fill this form to create an account.</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>    
                        <div class="form-group">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>    
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary" value="Submit">
                        </div>
                        <p>Already have an account? <a href="login.php">Login here</a>.</p>
                    </form>
                </div>
            </div>
        </div>    
    </body>
</html>