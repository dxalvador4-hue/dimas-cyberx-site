<?php
session_start();
header('Content-Type: application/json');

$db_users = 'database/database_users.json';
$db_logs = 'database/database_logs.json';
$db_attempts = 'database/database_attempts.json';

if (!file_exists('database')) { mkdir('database', 0777, true); }
if (!file_exists($db_users)) { file_put_contents($db_users, json_encode([])); }
if (!file_exists($db_logs)) { file_put_contents($db_logs, json_encode([])); }
if (!file_exists($db_attempts)) { file_put_contents($db_attempts, json_encode([])); }

function getUsers() { 
    global $db_users; 
    $data = @file_get_contents($db_users);
    return json_decode($data, true) ?: []; 
}
function saveUsers($data) { 
    global $db_users; 
    file_put_contents($db_users, json_encode($data, JSON_PRETTY_PRINT)); 
}
function addLog($email, $status) {
    global $db_logs;
    $logs = json_decode(@file_get_contents($db_logs), true) ?: [];
    $logs[] = [
        'time' => date('d-m-Y - H:i:s'),
        'email' => $email,
        'status' => $status
    ];
    file_put_contents($db_logs, json_encode($logs, JSON_PRETTY_PRINT));
}

$action = $_POST['action'] ?? '';

// ================= LOGIKA RESET PASSWORD ================= //
if ($action === 'reset') {
    $email = trim($_POST['email'] ?? '');
    $new_password = $_POST['new_password'] ?? '';

    $users = getUsers();
    $userFound = false;

    // Cari email dan timpa passwordnya
    foreach ($users as &$u) {
        if ($u['email'] === $email) {
            $u['password'] = $new_password;
            $userFound = true;
            break; // Stop pencarian setelah ketemu
        }
    }

    if ($userFound) {
        saveUsers($users); // Simpan ulang ke JSON
        addLog($email, 'PASSWORD_RESET');
        echo json_encode(['status' => 'success', 'message' => 'Sandi Diperbarui! Mengalihkan ke Login...']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Email Node tidak ditemukan!']);
    }
    exit;
}

// ================= LOGIKA REGISTER ================= //
if ($action === 'register') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($name) || empty($email) || empty($password)) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap!']);
        exit;
    }

    $users = getUsers();
    foreach ($users as $u) {
        if ($u['email'] === $email) {
            echo json_encode(['status' => 'error', 'message' => 'Node Email sudah terdaftar! Gunakan email lain.']);
            exit;
        }
    }

    $role = (count($users) === 0) ? 'ADMIN' : 'USER';
    $users[] = ['name' => $name, 'email' => $email, 'password' => $password, 'role' => $role];

    saveUsers($users);
    addLog($email, 'REGISTER_SUCCESS');

    echo json_encode(['status' => 'success', 'message' => 'Identitas Crypto Terbuat! Mengalihkan...']);
    exit;
}

// ================= LOGIKA LOGIN ================= //
if ($action === 'login') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    
    $users = getUsers();
    $validUser = null;

    foreach ($users as $u) {
        if ($u['email'] === $email && $u['password'] === $password) {
            $validUser = $u;
            break;
        }
    }

    if ($validUser) {
        $_SESSION['user_logged'] = true;
        $_SESSION['user_email'] = $validUser['email'];
        $_SESSION['user_name'] = $validUser['name'];
        $_SESSION['user_role'] = $validUser['role'];
        
        addLog($email, 'LOGIN_SUCCESS');
        echo json_encode(['status' => 'success', 'message' => 'Akses Diberikan!', 'role' => $validUser['role']]);
    } else {
        addLog($email, 'LOGIN_FAILED');
        global $db_attempts;
        $attempts = json_decode(@file_get_contents($db_attempts), true) ?: [];
        $attempts[] = ['ip' => $_SERVER['REMOTE_ADDR'] ?? 'UNKNOWN', 'time' => time()];
        file_put_contents($db_attempts, json_encode($attempts, JSON_PRETTY_PRINT));
        
        echo json_encode(['status' => 'error', 'message' => 'Kredensial Tidak Valid!']);
    }
    exit;
}

echo json_encode(['status' => 'error', 'message' => 'Invalid Request']);
exit;
