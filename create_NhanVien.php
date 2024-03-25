<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create NhanVien</title>
</head>
<body>
    <h2>Create New Employee</h2>

    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "QL_NhanSu";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $sql = "INSERT INTO NhanVien (ma_nv, ten_nv, phai, noi_sinh, ma_phong, luong) 
                        VALUES (:ma_nv, :ten_nv, :phai, :noi_sinh, :ma_phong, :luong)";
                $stmt = $conn->prepare($sql);

                $stmt->bindParam(':ma_nv', $_POST['ma_nv']);
                $stmt->bindParam(':ten_nv', $_POST['ten_nv']);
                $stmt->bindParam(':phai', $_POST['phai']);
                $stmt->bindParam(':noi_sinh', $_POST['noi_sinh']);
                $stmt->bindParam(':ma_phong', $_POST['ma_phong']);
                $stmt->bindParam(':luong', $_POST['luong']);

                $stmt->execute();

                header("Location: list.php");
                exit(); 

            }

              // Truy vấn để lấy danh sách phòng ban
              $sqlPhongBan = "SELECT ma_phong, ten_phong FROM PhongBan";
              $stmtPhongBan = $conn->prepare($sqlPhongBan);
              $stmtPhongBan->execute();
  
              $phongBanList = $stmtPhongBan->fetchAll();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>

    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="ma_nv">Ma NV:</label>
        <input type="text" id="ma_nv" name="ma_nv" required><br><br>

        <label for="ten_nv">Ten NV:</label>
        <input type="text" id="ten_nv" name="ten_nv" required><br><br>

        <label for="phai">Phai:</label>
        <select id="phai" name="phai">
            <option value="nam">Nam</option>
            <option value="nu">Nu</option>
        </select><br><br>

        <label for="noi_sinh">Noi Sinh:</label>
        <input type="text" id="noi_sinh" name="noi_sinh"><br><br>

        <label for="ma_phong">Ma Phong:</label>
        <select id="ma_phong" name="ma_phong" required>
            <?php foreach ($phongBanList as $phong) : ?>
                <option value="<?php echo $phong['ma_phong']; ?>"><?php echo $phong['ten_phong']; ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label for="luong">Luong:</label>
        <input type="number" id="luong" name="luong" required><br><br>

        <input type="submit" value="Submit">
    </form>
</body>
</html>
