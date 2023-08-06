<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();
        if (!is_admin())
        {
            redirect('dashboard');
        }

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = "User Management";
        $data['users'] = $this->admin->getUsers(userdata('ID_USER'));
        $this->template->load('templates/dashboard', 'user/data', $data);
    }

    private function _validasi($mode)
    {
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('no_telp', 'Nomor Telepon', 'required|trim');
        $this->form_validation->set_rules('role', 'Role', 'required|trim');

        if ($mode == 'add')
        {
            $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.USERNAME]|alpha_numeric');
            $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.EMAIL_USER]');
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[3]|trim');
            $this->form_validation->set_rules('password2', 'Konfirmasi Password', 'matches[password]|trim');
        }
        if ($mode == 'edit')
        {
            $db = $this->admin->get('user', ['ID_USER' => $this->input->post('id_user', true)]);
            if ($db)
            {
                $username = $this->input->post('username', true);
                $email = $this->input->post('email', true);

                $uniq_username = $db['USERNAME'] == $username ? '' : '|is_unique[user.USERNAME]';
                $uniq_email = $db['EMAIL_USER'] == $email ? '' : '|is_unique[user.EMAIL_USER]';

                $this->form_validation->set_rules('username', 'Username', 'required|trim|alpha_numeric' . $uniq_username);
                $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email' . $uniq_email);
            }
        }
    }

    public function add()
    {
        $this->_validasi('add');

        if ($this->form_validation->run() == false)
        {
            $data['title'] = "Tambah User";
            $data['tingkat'] = $this->admin->get('tingkat_event');
            $this->template->load('templates/dashboard', 'user/add', $data);
        }
        else
        {
            $input = $this->input->post(null, true);
            $input_data = [
                'USERNAME'      => $input['username'],
                'EMAIL_USER'    => $input['email'],
                'NAMA_USER'     => $input['nama'],
                'PASSWORD'      => password_hash($input['password'], PASSWORD_DEFAULT),
                'NO_TELP'       => $input['no_telp'],
                'ROLE'          => $input['role'],
                'FOTO'          => 'user.png',
                'IS_ACTIVE'     => '0',
            ];

            if ($this->admin->insert('user', $input_data))
            {
                set_pesan('data berhasil disimpan.');
                redirect('user');
            }
            else
            {
                set_pesan('data gagal disimpan', false);
                redirect('user/add');
            }
        }
    }

    public function edit($getId)
    {
        $id = encode_php_tags($getId);
        $this->_validasi('edit');

        if ($this->form_validation->run() == false)
        {
            $data['title'] = "Edit User";
            $data['user'] = $this->admin->get('user', ['ID_USER' => $id]);
            $data['tingkat'] = $this->admin->get('tingkat_event');
            $this->template->load('templates/dashboard', 'user/edit', $data);
        }
        else
        {
            $input = $this->input->post(null, true);
            $input_data = [
                'NAMA_USER'     => $input['nama'],
                'USERNAME'      => $input['username'],
                'EMAIL_USER'    => $input['email'],
                'NO_TELP'       => $input['no_telp'],
                'ROLE'          => $input['role']
            ];

            if ($this->admin->update('user', 'ID_USER', $id, $input_data))
            {
                set_pesan('data berhasil diubah.');
                redirect('user');
            }
            else
            {
                set_pesan('data gagal diubah.', false);
                redirect('user/edit/' . $id);
            }
        }
    }

    public function delete($getId)
    {
        $id = encode_php_tags($getId);
        if ($this->admin->delete('user', 'ID_USER', $id))
        {
            set_pesan('data berhasil dihapus.');
        }
        else
        {
            set_pesan('data gagal dihapus.', false);
        }
        redirect('user');
    }

    public function toggle($getId)
    {
        $id = encode_php_tags($getId);
        $status = $this->admin->get('user', ['ID_USER' => $id])['IS_ACTIVE'];
        $toggle = $status ? 0 : 1; //Jika user aktif maka nonaktifkan, begitu pula sebaliknya
        $pesan = $toggle ? 'user diaktifkan.' : 'user dinonaktifkan.';

        if ($this->admin->update('user', 'ID_USER', $id, ['IS_ACTIVE' => $toggle]))
        {
            set_pesan($pesan);
        }
        redirect('user');
    }
}
