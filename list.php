
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

    $is_admin = ($_SESSION['role'] == 'admin');
    $isUsername = $_SESSION['usename']
?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List User</title>
    <style>
    table {
      border-collapse: collapse;
      width: 100%;
    }
    th, td {
      text-align: left;
      padding: 8px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background-color: #f2f2f2;
    }
    a { 
    background-color: #04AA; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    border-radius: 10px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    }
    .buttonLogout {
        display: flex;
        justify-content: space-around;
    }
  </style>
</head>
<body>
    <h1>List of Users</h1>
    <?php include 'DB/Db.php'; ?>
    <p>Welcome, <?php echo  $isUsername; ?></p>
    <form class="buttonLogout" action="logout.php" method="post">

    <input  type="submit" value="Logout">
    </form>
    <table border='1'>
    <?php if ($is_admin): ?>
            <a href="create_NhanVien.php">Create New Employee</a>
    <?php endif; ?>

        <tr>
            <th>Ma NV</th>
            <th>Ten NV</th>
            <th>Phai</th>
            <th>Noi Sinh</th>
            <th>Ma Phong</th>
            <th>Luong</th>
            <?php if ($is_admin): ?>
                <th>Action</th> 
            <?php endif; ?>
        </tr>
        <?php foreach ($NhanVien as $user): ?>
            <tr>
                <td><?= $user['ma_nv'] ?></td>
                <td><?= $user['ten_nv'] ?></td>
                <td>
                    <?php if ($user['phai'] === 'nam'): ?>
                        <img src="./img/usermale.jpg" alt="Male">
                    <?php elseif ($user['phai'] === 'nu'): ?>
                        <img src="./img/userfemale.jpg" alt="Female">
                    <?php else: ?>
                        <img src="unknowngender.jpg" alt="Unknown Gender">
                    <?php endif; ?>
                </td>
                <td><?= $user['noi_sinh'] ?></td>
                <td><?= $user['ma_phong'] ?></td>
                <td><?= $user['luong'] ?></td>
                <?php if ($is_admin): ?>
                <td>
                    <a class="buttonEdit" href="edit_nhanvien.php?ma_nv=<?= $user['ma_nv'] ?>">Edit</a>
                    <a href="delete_NhanVien.php?ma_nv=<?= $user['ma_nv'] ?>" onclick="return confirm('Are you sure you want to delete this employee?')">Delete</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php endforeach; ?>
    </table>
    <div>
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="list.php?page=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
</body>
</html>
