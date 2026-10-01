<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function registerForm()
    {
        view('auth/register');
    }

    public function register()
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $passwordConfirm = $_POST['password_confirm'] ?? '';

        if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($password) < 8 || $password !== $passwordConfirm) {
            view('auth/register', ['error' => 'Enter a valid email and matching passwords of at least 8 characters.', 'email' => $email]);
            return;
        }

        if (User::findBy('email', $email)) {
            view('auth/register', ['error' => 'An account with this email already exists.', 'email' => $email]);
            return;
        }

        $user = new User();
        $user->email = $email;
        $user->password = password_hash($password, PASSWORD_DEFAULT);
        $user->save();
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        session_regenerate_id(true);
        redirect('/posts');
    }

    public function loginForm()
    {
        view('auth/login');
    }

    public function login()
    {
        $email = trim($_POST['email'] ?? '');
        $user = User::findBy('email', $email);

        if (!$user || !password_verify($_POST['password'] ?? '', $user->password)) {
            view('auth/login', ['error' => 'Email or password is incorrect.', 'email' => $email]);
            return;
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        redirect('/posts');
    }

    public function logout()
    {
        $_SESSION = [];
        session_destroy();
        redirect('/');
    }
}