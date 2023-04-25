<?php
session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: ../Log_in/login.php");
    exit();
}

// Database Connection
$host = 'localhost';
$dbname = 'lance';
$username = 'root';
$password = '';

// Test Connection
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Query for Artist information
$query = "SELECT * FROM user";

$stmt = $conn->prepare($query);
$stmt->execute();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['userID'];
    $userName = $_POST['userName'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "UPDATE user SET userID = :userID, userName = :userName, firstName = :firstName, lastName = :lastName, email = :email, password = :password
                WHERE userID = :userID";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':userName', $userName);
    $stmt->bindParam(':firstName', $firstName);
    $stmt->bindParam(':lastName', $lastName);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Information</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
</head>
<body>
    <nav>
        <ul>
            <li><a href="admin.php">User Information</a></li>
            <li><a href="admin_balance.php">User Balance</a></li>
            <li><a href="../Log_in/logout.php">Logout</a></li>
        </ul>
    </nav>
    <div class="box">
        <h2>Welcome, Admin!</h2>
    </div>
    <div class="center">
    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { ?>
      <form method="POST" action="admin.php">
        <label>userID:</label>
        <input type="button" name="userID" value="<?php echo $row['userID']; ?>"><br>
        <label>userName:</label>
        <input type="text" name="userName" value="<?php echo $row['userName']; ?>"><br>
        <label>firstName:</label>
        <input type="text" name="firstName" value="<?php echo $row['firstName']; ?>"><br>
        <label>lastName:</label>
        <input type="text" name="lastName" value="<?php echo $row['lastName']; ?>"><br>
        <label>email:</label>
        <input type="text" name="email" value="<?php echo $row['email']; ?>"><br>
        <label>password:</label>
        <input type="password" name="password" value="<?php echo $row['password']; ?>"><br>
        <input type="submit" value="Edit">
      </form>
    <?php } ?>
    </div>
</body>
</html>