<?php

defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->call->library('session');
    }

    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username === 'admin' && $password === 'admin123') {

                $this->session->set_userdata([
                    'logged_in' => true,
                    'username'  => $username
                ]);

                header('Location: /products');
                exit;
            }

            $data['error'] = 'Invalid username or password.';

            $this->call->view('auth/login', $data);
            return;
        }

        $this->call->view('auth/login');
    }

    public function logout()
    {
        $this->session->sess_destroy();

        header('Location: /login');
        exit;
    }
}