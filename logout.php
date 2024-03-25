<?php
session_start();

// Xóa tất cả các biến session
$_SESSION = array();

// Nếu bạn muốn xóa cả cookie, bạn nên sử dụng session_destroy() kèm theo xóa cookie
// Chú ý: Điều này sẽ xóa session cookie, nhưng không xóa cookie khác.
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hủy session
session_destroy();

// Chuyển hướng người dùng về trang đăng nhập
header("location: login.php");
exit;
?>
