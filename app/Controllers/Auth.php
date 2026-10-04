<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('staff_id')) {
            return redirect()->to(site_url('customers'));
        }
        return view('auth/login', ['title' => 'Staff Sign In', 'activePage' => 'login', 'error' => null, 'username' => '']);
    }

    public function attempt()
    {
        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');
        $user = $username === '' ? null : (new UserModel())->where('username', $username)->first();

        // A stored hash is checked without comparing or storing plain text passwords.
        if ($user === null || ! password_verify($password, (string) ($user['password'] ?? ''))) {
            return view('auth/login', [
                'title' => 'Staff Sign In', 'activePage' => 'login',
                'error' => 'The username or password is incorrect.', 'username' => $username,
            ]);
        }

        // Rotate the session ID when privileges change to prevent session fixation.
        session()->regenerate(true);
        session()->set(['staff_id' => (int) $user['id'], 'staff_name' => $user['full_name']]);
        return redirect()->to(site_url('customers'))->with('success', 'Welcome back, ' . $user['full_name'] . '.');
    }

    public function logout()
    {
        // Destroy all login state and send the browser to the public sign-in page.
        session()->destroy();
        return redirect()->to(site_url('login'));
    }
}
