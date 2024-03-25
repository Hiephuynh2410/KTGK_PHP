<?php
if(isset($_GET['ma_nv'])) {
    $ma_nv = $_GET['ma_nv'];
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "QL_NhanSu";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "DELETE FROM NhanVien WHERE ma_nv = :ma_nv";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':ma_nv', $ma_nv);

        $stmt->execute();

        header("Location: list.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request!";
}
?>
