<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_login();

        $this->load->model('Admin_model', 'admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->form_validation->set_rules('ID_EVENT', 'Event', 'required');

        if ($this->form_validation->run() == false)
        {
            $data['title'] = "Laporan";
            $data['event'] = $this->admin->getEvent();
            $this->template->load('templates/dashboard', 'laporan/form', $data);
        }
        else
        {
            $idEvent = $this->input->post('ID_EVENT');
            $query = $this->admin->getLaporanEvent($idEvent);
            $this->_cetak($query);
        }
    }

    private function _cetak($query)
    {
        $this->load->library('CustomPDF');

        $table = 'Data Registrasi';
        $tanggal = 'Apa aja Boleh';

        $pdf = new FPDF();
        $pdf->AddPage('P', 'Letter');
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(190, 7, 'Laporan ' . $table, 0, 1, 'C');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(190, 4, 'Tanggal : ' . $tanggal, 0, 1, 'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial', 'B', 10);

        $event = reset($query);

        $pdf->Cell(61, 10, 'Jenis Event : ' . $event['NAMA_JENIS_EVENT'], 0, 0, 'L');
        $pdf->Cell(61, 10, 'Nama Event : ' . $event['NAMA_EVENT'], 0, 0, 'C');
        $pdf->Cell(61, 10, 'Tingkat : ' . $event['NAMA_TINGKAT_EVENT'], 0, 0, 'R');
        $pdf->Ln(20);

        $pdf->SetFont('Arial', '', 12);
        $contact = reset($query);
        $pdf->Cell(40, 7, 'Contact Person', 0, 0, 'L');
        $pdf->Cell(40, 7, ': ' . $contact['NAMA_CONTACT_PERSON'], 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(40, 7, 'No Telepon', 0, 0, 'L');
        $pdf->Cell(40, 7, ': ' . $contact['NO_TELP_CONTACT_PERSON'], 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(40, 7, 'Email', 0, 0, 'L');
        $pdf->Cell(40, 7, ': ' . $contact['EMAIL_CONTACT_PERSON'], 0, 0, 'L');


        $pdf->Ln(20);
        $team = reset($query);
        $pdf->Cell(40, 7, 'Nama Team', 0, 0, 'L');
        $pdf->Cell(70, 7, ': ' . $team['NAMA_TEAM'], 0, 0, 'L');
        $pdf->Cell(40, 7, 'Kota', 0, 0, 'L');
        $pdf->Cell(40, 7, ': ' . $team['KOTA'], 0, 0, 'L');
        $pdf->Ln();
        $pdf->Cell(40, 7, 'Sekolah', 0, 0, 'L');
        $pdf->Cell(70, 7, ': ' . $team['SEKOLAH'], 0, 0, 'L');
        $pdf->Cell(40, 7, 'Provinsi', 0, 0, 'L');
        $pdf->Cell(40, 7, ': ' . $team['PROVINSI'], 0, 0, 'L');
        $pdf->Ln(10);
        $pdf->Cell(40, 7, 'Jumlah Peserta', 0, 0, 'L');
        $pdf->Cell(40, 7, $team['JUMLAH_PESERTA'], 0, 0, 'L');
        $pdf->Ln();
        $pdf->Ln(20);

        $pdf->Cell(50, 7, 'Nama Peserta', 1, 0, 'C');
        $pdf->Cell(50, 7, 'Foto Peserta', 1, 0, 'C');
        $pdf->Ln();

        foreach ($query as $d)
        {
            $pdf->SetFont('Arial', '', 12);
            $pdf->Cell(50, 7, $d['NAMA_PESERTA'], 1, 0, 'C');
            $pdf->Cell(50, 7, $d['FOTO_PESERTA'], 1, 0, 'C');
            $pdf->Ln();
        }

        $file_name = $table . ' ' . $tanggal;
        $pdf->Output('I', $file_name);
    }
}
