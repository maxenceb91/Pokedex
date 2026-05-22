<?php
session_start();
require_once 'users.php';

$user = getUserById($_SESSION['user_id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user) {
    if (isset($_POST['edit_username']) && !empty($_POST['username'])) {
        $user->setUsername(trim($_POST['username']));
        $user->save();
    } elseif (isset($_POST['edit_email']) && !empty($_POST['email'])) {
        $user->setEmail(trim($_POST['email']));
        $_SESSION['email'] = $user->email;
        $_SESSION['user_email'] = $user->email;
        $user->save();
    } elseif (isset($_POST['edit_password']) && !empty($_POST['password'])) {
        if(strlen($_POST['password']) < 8 ||
        !preg_match('/[A-Z]/', $_POST['password']) ||
        !preg_match('/[a-z]/', $_POST['password']) ||
        !preg_match('/[0-9]/', $_POST['password']) ||
        !preg_match('/[^a-zA-Z0-9]/', $_POST['password'])) {
            header('Location: ../pages/profile.php?error=invalid_password');
            exit();
        }

        $user->setPassword($_POST['password']);
        $user->save();
    }else if(isset($_POST['toggle-admin'])) {
        $targetUser = getUserById($_POST['edit_user_id']);
        $targetUser->admin = !$targetUser->admin;
        $targetUser->save();
        header('Location: ../pages/admin.php');
        exit();
    }
} 

header('Location: ../pages/profile.php');
exit();