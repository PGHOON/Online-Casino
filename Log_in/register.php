<?php
// Define database credentials
$host = "localhost";
$username = "root";
$password = "";
$dbname = "lance";

// Create a new PDO instance
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Prepare SQL statement to insert user data
$sql = "INSERT INTO user (userid, username, firstname, lastname, email, password) VALUES (?, ?, ?, ?, ?, ?)";

// Allocate new userid
$stmt = $pdo->prepare("SELECT MAX(userid) as maxid FROM user");
$stmt->execute();
$maxid = $stmt->fetch(PDO::FETCH_ASSOC)["maxid"];
$userid = $maxid + 1;

// Bind parameters and execute the SQL statement
$stmt = $pdo->prepare($sql);
$stmt->bindParam(1, $userid);
$stmt->bindParam(2, $_POST["username"]);
$stmt->bindParam(3, $_POST["firstname"]);
$stmt->bindParam(4, $_POST["lastname"]);
$stmt->bindParam(5, $_POST["email"]);
$stmt->bindParam(6, $_POST["password"]);

if ($stmt->execute()) {
    echo "<script>alert('Registration successful!');window.location.href='login.html';</script>";
} else {
    echo "Error: " . $stmt->errorCode() . " - " . implode(", ", $stmt->errorInfo());
}

// Close the database connection
$pdo = null;
?>
