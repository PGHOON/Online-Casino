<?php
    //Set our database account credentials
    $host = 'localhost';
    $dbname = 'lance';
    $username = 'root';
    $password = '';

    //Connect to our database using PDO
    try{
        $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    } catch (PDOException $e){
        echo "Connection failed: " . $e ->getMessage();
    }

    //Check if the form has been submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        //Retrieve user input from the form
        $username = $_POST['username'];
        $password = $_POST['password'];

        //Query the database for the user
        $stmt = $db->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        //Check if the user exists and the password is correct
        if ($user && $password == $user['password']) {
            //Redirect the user to the dashboard page
            echo "You are logged in!<br>" . $username;
            exit;
        } else {
            //Display an error message if the login fails
            $error = 'Invalid username or password';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lance Log-in</title>
    <link rel="stylesheet" type="text/css" href="login.css">
</head>

<body>
    <img src="logo_vector.png" alt="Logo" class="center">
    <div class="container">
        <form method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password">
            <input type="submit" value="Login">
            <?php if (isset($error)) { ?>
                <div class="error"><?php echo $error; ?></div>
            <?php } ?>
            <div class="sign-up">
                <a href="register.html"> I don't have an account</a>
            </div>
            <div class="find-pw">
                <a href="#"> I forgot my password</a>
            </div>
        </form>
    </div>
</body>

</html>
