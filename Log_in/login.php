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