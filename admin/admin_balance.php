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
$query = "SELECT * FROM account";

$stmt = $conn->prepare($query);
$stmt->execute();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userID = $_POST['userID'];
    $balance = $_POST['balance'];

    $query = "UPDATE balance SET userID = :userID, balance = :balance
                WHERE userID = :userID";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':balance', $balance);
    $stmt->execute();
  }
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Balance</title>
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
        <label>balance:</label>
        <input type="text" name="balance" value="<?php echo $row['balance']; ?>"><br>
        <input type="submit" value="Edit">
      </form>
    <?php } ?>
    </div>
</body>
</html>