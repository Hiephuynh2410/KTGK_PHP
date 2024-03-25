<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Employee</title>
</head>
<body>
    <h2>Edit Employee</h2>

    <?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "QL_NhanSu";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $ma_nv = $_GET['ma_nv'];
        $sql = "SELECT * FROM NhanVien WHERE ma_nv = :ma_nv";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':ma_nv', $ma_nv);
        $stmt->execute();
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$employee) {
            echo "Employee not found.";
            exit();
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $sql = "UPDATE NhanVien 
                    SET ten_nv = :ten_nv, phai = :phai, noi_sinh = :noi_sinh, ma_phong = :ma_phong, luong = :luong 
                    WHERE ma_nv = :ma_nv";
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
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>

    <form action="" method="post">
        <input type="hidden" name="ma_nv" value="<?= $employee['ma_nv'] ?>">

        <label for="ten_nv">Ten NV:</label>
        <input type="text" id="ten_nv" name="ten_nv" value="<?= $employee['ten_nv'] ?>" required><br><br>

        <label for="phai">Phai:</label>
        <select id="phai" name="phai">
            <option value="nam" <?php if($employee['phai'] === 'nam') echo 'selected'; ?>>Nam</option>
            <option value="nu" <?php if($employee['phai'] === 'nu') echo 'selected'; ?>>Nu</option>
        </select><br><br>

        <label for="noi_sinh">Noi Sinh:</label>
        <input type="text" id="noi_sinh" name="noi_sinh" value="<?= $employee['noi_sinh'] ?>"><br><br>

        <label for="ma_phong">Ma Phong:</label>
        <input type="text" id="ma_phong" name="ma_phong" value="<?= $employee['ma_phong'] ?>" required><br><br>

        <label for="luong">Luong:</label>
        <input type="number" id="luong" name="luong" value="<?= $employee['luong'] ?>" required><br><br>

        <input type="submit" value="Save Changes">
    </form>
</body>
</html>
