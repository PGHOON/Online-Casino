<?php
class Model
{
    private $dbh;

    function __construct($host, $dbname, $username, $password)
    {
        $dsn = "mysql:host=$host;dbname=$dbname";
        $this->dbh = new PDO($dsn, $username, $password);
    }

    function get_data($username, $password)
    {
        $stmt = $this->dbh->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) == 1) {
            if ($password == $result[0]['password']) {
                return $result;
            } else {
                return -1;
            }
        } else {
            return -2;
        }
    }
}
?>