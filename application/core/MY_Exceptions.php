<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions
{

    public function show_db_error($severity, $message, $filepath, $line)
    {
        $this->ob_clean(); // Membersihkan output sebelum menampilkan halaman error

        // Load view halaman error database
        $ci = &get_instance();
        $ci->load->view('errors/html/db_error');
        exit;
    }
}
