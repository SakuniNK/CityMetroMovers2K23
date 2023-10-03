
<?php
include 'classes/DbConnector.php'; 

use PDO;
use classes\DbConnector;


$dbcon = new DbConnector();
$con = $dbcon->getConnection();

$sql = "SELECT * FROM route";
try{
    $stmt = $con->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $stmt;
} catch (PDOException $ex){
    die("Connection Failed".$ex->getMessage());
}

                    
while($result) {
        $routeno = $row['Route_no'];
        $routestrt = $row['Route_start'];
        $routeend = $row['Route_end'];
        

}
?>

