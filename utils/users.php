<?php
require_once 'pdo.php';

class User {
    public $id = 0;
    public $username = '';
    public $email = '';
    public $password_hash = ''; 
    public $icon_url = '';
    public $created_at = '';

    function getIcon() {
        return $this->icon_url ?: '/Pokedex/assets/default.jpg';
    }

    function save() {
        global $pdo;
        if ($this->id) {
            $stmt = $pdo->prepare('UPDATE users SET username = ?, email = ?, password_hash = ?, icon_url = ? WHERE id = ?');
            $stmt->execute([$this->username, $this->email, $this->password_hash, $this->icon_url, $this->id]);
        } else {
            $stmt = $pdo->prepare('INSERT INTO users (username, email, password_hash, icon_url) VALUES (?, ?, ?, ?)');
            $stmt->execute([$this->username, $this->email, $this->password_hash, $this->icon_url]);
            $this->id = $pdo->lastInsertId();
        }
    }
}

function addUser($username = '', $email = '', $password = '') {
    $user = new User();
    $user->username = $username;
    $user->email = $email;
    $user->password_hash = password_hash($password, PASSWORD_DEFAULT);
    $user->save();
    return $user;
}

function authenticateUser($email = '', $password = '') {
    global $pdo;
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($row && password_verify($password, $row['password_hash'])) {
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['user_email'] = $row['email'];
        $_SESSION['user'] = $row;
        return true;
    }
    return false;
}

global $pdo;
$users = []; 
$stmt = $pdo->query('SELECT * FROM users');
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $user = new User();
    
    foreach ($row as $key => $value) {
        if (property_exists($user, $key)) {
            $user->$key = $value;
        }
    }
    
    $users[] = $user;
}

function getUserById($id = 0) {
    global $users;
    foreach ($users as $user) {
        if ($user->id == $id) {
            return $user;
        }
    }
    return null;
}

function getUsers() {
    global $users;
    return $users;
}

?>