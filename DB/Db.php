<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "QL_NhanSu";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $recordsPerPage = 5;

    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;

    $offset = ($currentPage - 1) * $recordsPerPage;

    $sql = "SELECT ma_nv, ten_nv, phai, noi_sinh, ma_phong, luong FROM NhanVien LIMIT :offset, :recordsPerPage";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->bindParam(':recordsPerPage', $recordsPerPage, PDO::PARAM_INT);
    $stmt->execute();
    $NhanVien = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $sqlCount = "SELECT COUNT(*) AS total FROM NhanVien";
    $stmtCount = $conn->prepare($sqlCount);
    $stmtCount->execute();
    $totalRecords = $stmtCount->fetch(PDO::FETCH_ASSOC)['total'];

    $totalPages = ceil($totalRecords / $recordsPerPage);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>