<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{
    protected $user;

    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');

        $userId = $this->session->userdata('login_session')['user'];
        $this->user = $this->admin->get('user', ['ID_USER' => $userId]);
    }

    public function index()
    {
        $data['title'] = "Profile";
        $data['user'] = $this->user;
        $this->template->load('templates/dashboard', 'profile/user', $data);
    }

    private function _validasi()
    {
        // $db = $this->admin->get('user', ['ID_USER' => $this->input->post('ID_USER', true)]);
        // $username = $this->input->post('USERNAME', true);
        // $email = $this->input->post('EMAIL', true);

        // $uniq_username = $db['USERNAME'] == $username ? '' : '|is_unique[user.USERNAME]';
        // $uniq_email = $db['EMAIL_USER'] == $email ? '' : '|is_unique[user.EMAIL_USER]';

        $this->form_validation->set_rules('USERNAME', 'Username', 'required|trim|alpha_numeric');
        $this->form_validation->set_rules('EMAIL_USER', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('NAMA_USER', 'Nama', 'required|trim');
        $this->form_validation->set_rules('NO_TELP', 'Nomor Telepon', 'required|trim|numeric');
    }

    private function _config()
    {
        $config['upload_path']      = "./assets/img/avatar";
        $config['allowed_types']    = 'gif|jpg|jpeg|png';
        $config['encrypt_name']     = TRUE;
        $config['max_size']         = '2048';

        $this->load->library('upload', $config);
    }

    public function setting()
    {
        $this->_validasi();
        $this->_config();

        if ($this->form_validation->run() == false) {
            $data['title'] = "Profile";
            $data['user'] = $this->user;
            $this->template->load('templates/dashboard', 'profile/setting', $data);
        } else {
            $input = $this->input->post(null, true);
            if (empty($_FILES['FOTO']['tmp_name'])) {
                $insert = $this->admin->update('user', 'ID_USER', $input['ID_USER'], $input);
                if ($insert) {
                    set_pesan('perubahan berhasil disimpan.');
                } else {
                    set_pesan('perubahan tidak disimpan.');
                }
                redirect('profile/setting');
            } else {
                if ($this->upload->do_upload('FOTO') == false) {
                    echo $this->upload->display_errors();
                    die;
                } else {
                    if (userdata('FOTO') != 'user.png') {
                        $old_image = FCPATH . 'assets/img/avatar/' . userdata('FOTO');
                        if (!unlink($old_image)) {
                            set_pesan('gagal hapus foto lama.');
                            redirect('profile/setting');
                        }
                    }

                    $input['FOTO'] = $this->upload->data('file_name');
                    $update = $this->admin->update('user', 'ID_USER', $input['ID_USER'], $input);
                    if ($update) {
                        set_pesan('perubahan berhasil disimpan.');
                    } else {
                        set_pesan('gagal menyimpan perubahan');
                    }
                    redirect('profile/setting');
                }
            }
        }
    }

    public function ubahpassword()
    {
        $this->form_validation->set_rules('password_lama', 'Password Lama', 'required|trim');
        $this->form_validation->set_rules('password_baru', 'Password Baru', 'required|trim|min_length[3]|differs[password_lama]');
        $this->form_validation->set_rules('konfirmasi_password', 'Konfirmasi Password', 'matches[password_baru]');

        if ($this->form_validation->run() == false) {
            $data['title'] = "Ubah Password";
            $this->template->load('templates/dashboard', 'profile/ubahpassword', $data);
        } else {
            $input = $this->input->post(null, true);
            if (password_verify($input['password_lama'], userdata('PASSWORD'))) {
                $new_pass = ['PASSWORD' => password_hash($input['password_baru'], PASSWORD_DEFAULT)];
                $query = $this->admin->update('user', 'ID_USER', userdata('ID_USER'), $new_pass);

                if ($query) {
                    set_pesan('password berhasil diubah.');
                } else {
                    set_pesan('gagal ubah password', false);
                }
            } else {
                set_pesan('password lama salah.', false);
            }
            redirect('profile/ubahpassword');
        }
    }
}
