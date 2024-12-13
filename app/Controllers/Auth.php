<?php

namespace App\Controllers;

use App\Models\UserModel;


class Auth extends BaseController
{

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->validation = \Config\Services::validation();
    }

    public function login()
    {
        $data = ['title' => 'Login'];
        return view('auth/login', $data);
    }

    public function loginAuth()
    {
        helper(['form']);
        $validation = \Config\Services::validation();

        $validation->setRules([
            'email' => 'required|valid_email',
            'password' => 'required|min_length[6]|max_length[255]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }
        $model = new UserModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();

        if ($data) {
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if ($verify_pass) {
                $ses_data = [
                    'user_id'       => $data['id'],
                    'fullname'     => $data['fullname'],
                    'email'    => $data['email'],
                    'role'    => $data['role'],
                    'status'    => $data['status'],
                    'logged_in' => TRUE
                ];
                session()->set($ses_data);
                session()->setFlashdata('success', 'Login berhasil');
                if ($data['role'] == 'admin') {
                    return redirect()->to('/admin');
                } else {
                    return redirect()->to('/');
                }
            } else {
                session()->setFlashdata('error', 'Password salah');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('error', 'Email tidak terdaftar');
            return redirect()->to('/login');
        }
    }

    public function register()
    {
        $data = ['title' => 'Register'];
        return view('auth/register', $data);
    }

    public function store()
    {
        helper(['form', 'url']);
        $validation = \Config\Services::validation();
        $validation->setRules([
            'fullname' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|valid_email|is_unique[users.email]',
            'nohp' => 'required|min_length[10]|max_length[13]',
            'password' => 'required|min_length[6]|max_length[255]|matches[password_confirm]',
            'password_confirm' => 'required|matches[password]',
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            return redirect()->back()->withInput()->with('error', $validation->getErrors());
        }

        $data = [
            'fullname' => $this->request->getVar('fullname'),
            'email' => $this->request->getVar('email'),
            'nohp' => $this->request->getVar('nohp'),
            'alamat' => NULL,
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'role' => 'user',
        ];

        $this->userModel->insert($data);
        if ($this->userModel->errors()) {
            return redirect()->back()->withInput()->with('error', $this->userModel->errors());
        }
        session()->setFlashdata('success', 'Registrasi berhasil');
        return redirect()->to('/login');
    }

    public function logout()
    {
        session()->destroy();
        session()->setFlashdata('success', 'Logout berhasil');
        return redirect()->to('/login');
    }

    public function profil()
    {
        $data = [
            'title' => 'Profil',
            'user' => $this->userModel->where('id', session()->get('user_id'))->first(),
        ];
        if (session()->get('role') == 'admin') {
            return view('admin/profil', $data);
        } else {
            return view('profil', $data);
        }
    }

    public function edit_profil()
    {
        $this->validation->setRules([
            'fullname' => 'required|min_length[3]|max_length[20]',
            'email' => 'required|valid_email',
            'nohp' => 'required|min_length[10]|max_length[13]',
            'alamat' => 'max_length[255]',
        ]);

        if (!$this->validation->withRequest($this->request)->run()) {
            session()->setFlashdata('error', implode('<br>', $this->validation->getErrors()));
            return redirect()->back();
        }

        $this->userModel->save([
            'id' => session()->get('user_id'),
            'fullname' => $this->request->getPost('fullname'),
            'email' => $this->request->getPost('email'),
            'nohp' => $this->request->getPost('nohp'),
            'alamat' => $this->request->getPost('alamat'),
        ]);
        session()->setFlashdata('success', 'Profil berhasil diperbarui');
        return redirect()->to('/profil');
    }
}
