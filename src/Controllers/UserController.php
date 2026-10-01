<?php

namespace App\Controllers;

use App\Models\User;

class UserController
{
    public function index()
    {
        $users = User::all();
        view('users/index', compact('users'));
    }

    public function create()
    {
        view('users/create');
    }

    public function store()
    {
        $user = new User();
        $user->email = $_POST['email'] ?? '';

        $password = $_POST['password'] ?? '';
        // Always store hashed password
        $user->password = password_hash($password, PASSWORD_BCRYPT);

        $user->save();
        redirect('/users');
    }

    public function view()
    {
        $user = $this->findUser();
        if (!$user) {
            return;
        }
        view('users/view', compact('user'));
    }

    public function edit()
    {
        $user = $this->findUser();
        if (!$user) {
            return;
        }
        view('users/edit', compact('user'));
    }

    public function update()
    {
        $user = $this->findUser();
        if (!$user) {
            return;
        }
        $user->email = $_POST['email'] ?? $user->email;

        // Update password only if provided
        if (!empty($_POST['password'])) {
            $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        }

        $user->save();
        redirect('/users');
    }

    public function destroy()
    {
        $user = $this->findUser();
        if (!$user) {
            return;
        }
        $user->delete();
        redirect('/users');
    }

    private function findUser()
    {
        $value = $_GET['id'] ?? null;
        $id = is_scalar($value) ? filter_var($value, FILTER_VALIDATE_INT) : false;
        $user = $id === false ? null : User::find($id);
        if (!$user) {
            http_response_code(404);
            echo 'User not found.';
        }
        return $user;
    }
}