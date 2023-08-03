<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null)
        {
            return $this->db->get_where($table, $data)->row_array();
        }
        else
        {
            return $this->db->get_where($table, $where)->result_array();
        }
    }

    public function update($table, $pk, $id, $data)
    {
        $this->db->where($pk, $id);
        return $this->db->update($table, $data);
    }

    public function insert($table, $data, $batch = false)
    {
        return $batch ? $this->db->insert_batch($table, $data) : $this->db->insert($table, $data);
    }

    public function delete($table, $pk, $id)
    {
        return $this->db->delete($table, [$pk => $id]);
    }

    public function getUsers($id)
    {
        /**
         * ID disini adalah untuk data yang tidak ingin ditampilkan. 
         * Maksud saya disini adalah 
         * tidak ingin menampilkan data user yang digunakan, 
         * pada managemen data user
         */

        $this->db->where('id_user !=', $id);
        return $this->db->get('user')->result_array();
    }

    public function getEvent()
    {
        $this->db->join('jenis_event j', 'e.ID_JENIS_EVENT = j.ID_JENIS_EVENT');
        $this->db->join('tingkat_event t', 'e.ID_TINGKAT_EVENT = t.ID_TINGKAT_EVENT');
        $this->db->order_by('e.ID_JENIS_EVENT');
        return $this->db->get('event e')->result_array();
    }

    public function getFotoEvent($id)
    {
        $this->db->select('FOTO_EVENT');
        $this->db->where('ID_EVENT =', $id);
        return $this->db->get('event')->result_array();
    }

    public function getEventId($id)
    {
        $this->db->where('ID_EVENT =', $id);
        return $this->db->get('event')->result_array();
    }

    public function getJenisEvent()
    {
        return $this->db->get('jenis_event')->result_array();
    }

    public function getSchedule()
    {
        $this->db->select('t.ID_TEAM, t.NAMA_TEAM, t.SEKOLAH, t.TINGKAT');
        $this->db->join('event e', 'r.ID_EVENT = e.ID_EVENT');
        $this->db->join('team t', 'r.ID_REGISTRASI = t.ID_REGISTRASI');
        $this->db->where('r.STATUS_REGISTRASI', '1');
        $this->db->order_by('r.ID_REGISTRASI');
        return $this->db->get('registrasi r')->result_array();
    }
    public function getTeamPeserta($idRegistrasi)
    {
        $this->db->join('team t', 'r.ID_REGISTRASI = t.ID_REGISTRASI');
        $this->db->join('peserta p', 'p.ID_TEAM = t.ID_TEAM');
        $this->db->join('contact_person c', 'c.ID_CONTACT_PERSON = t.ID_CONTACT_PERSON');
        $this->db->where('r.ID_REGISTRASI =', $idRegistrasi);
        return $this->db->get('registrasi r')->result_array();
    }

    public function getTeam()
    {
        $multiClause = array(
            'r.STATUS_REGISTRASI' => 1,
            'e.STATUS_EVENT' => 'dibuka',
        );
        $this->db->select('e.ID_JENIS_EVENT, e.NAMA_EVENT, r.JUMLAH_PESERTA,t.KOTA, t.NAMA_TEAM, t.SEKOLAH, t.TINGKAT');
        $this->db->join('event e', 'r.ID_EVENT = e.ID_EVENT');
        $this->db->join('team t', 'r.ID_REGISTRASI = t.ID_REGISTRASI');
        $this->db->where($multiClause);
        $this->db->or_where('e.STATUS_EVENT', 'berjalan');
        $this->db->order_by('r.ID_REGISTRASI');
        return $this->db->get('registrasi r')->result_array();
    }

    public function getRegistrasiAll()
    {
        $this->db->join('event e', 'r.ID_EVENT = e.ID_EVENT');
        $this->db->join('team t', 'r.ID_REGISTRASI = t.ID_REGISTRASI');
        $this->db->order_by('r.ID_REGISTRASI');
        return $this->db->get('registrasi r')->result_array();
    }

    public function getRegistrasi($event)
    {
        $this->db->join('event e', 'r.ID_EVENT = e.ID_EVENT');
        $this->db->like('NAMA_EVENT', $event);
        $this->db->order_by('ID_REGISTRASI');
        return $this->db->get('registrasi r')->result_array();
    }

    public function getUploads()
    {
        $this->db->join('registrasi r', 'u.registrasi_id = r.id_registrasi');
        $this->db->order_by('registrasi_id');
        return $this->db->get('uploads u')->result_array();
    }

    public function getJadwal()
    {
        $this->db->select('e.ID_EVENT,e.ID_JENIS_EVENT, e.NAMA_EVENT,e.STATUS_EVENT, j.NAMA_JENIS_EVENT');
        $this->db->where('STATUS_EVENT', 'dibuka');
        $this->db->or_where('STATUS_EVENT', 'berjalan');
        return $this->db->get('event')->result_array();
    }

    public function getAtributEvent()
    {
        $this->db->select('e.ID_EVENT,e.ID_JENIS_EVENT, e.NAMA_EVENT,e.STATUS_EVENT, j.NAMA_JENIS_EVENT');
        $this->db->join('jenis_event j', 'e.ID_JENIS_EVENT = j.ID_JENIS_EVENT');
        $this->db->where('e.STATUS_EVENT', 'dibuka');
        $this->db->or_where('e.STATUS_EVENT', 'berjalan');
        return $this->db->get('event e')->result_array();
    }

    public function getAtributAll()
    {
        $this->db->select('t.NAMA_TINGKAT_EVENT,j.NAMA_JENIS_EVENT,e.NAMA_EVENT,a.ID_ATRIBUT,a.FOTO_ATRIBUT,a.NAMA_ATRIBUT, e.ID_EVENT,e.TGL_MULAI_EVENT,e.TGL_AKHIR_EVENT');
        $this->db->join('tingkat_event t', 'e.ID_TINGKAT_EVENT = t.ID_TINGKAT_EVENT');
        $this->db->join('atribut a', 'e.ID_EVENT = a.ID_EVENT');
        $this->db->join('jenis_event j', 'e.ID_JENIS_EVENT = j.ID_JENIS_EVENT');
        return $this->db->get('event e')->result_array();
    }

    public function getAtribut()
    {
        $this->db->join('registrasi r', 'u.registrasi_id = r.id_registrasi');
        $this->db->order_by('registrasi_id');
        return $this->db->get('uploads u')->result_array();
    }

    public function chartEventMulai($bulan)
    {
        $like = '2023-' . $bulan;
        $this->db->like('TGL_MULAI_EVENT', $like, 'after');
        return count($this->db->get('event')->result_array());
    }

    public function chartEventAkhir($bulan)
    {
        $like = '2023-' . $bulan;
        $this->db->like('TGL_AKHIR_EVENT', $like, 'after');
        return count($this->db->get('event')->result_array());
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null)
        {
            $this->db->like($field, $kode, 'after');
        }
        return $this->db->get($table)->row_array()[$field];
    }

    public function count($table)
    {
        return $this->db->count_all($table);
    }

    public function sum($table, $field)
    {
        $this->db->select_sum($field);
        return $this->db->get($table)->row_array()[$field];
    }

    public function min($table, $field, $min)
    {
        $field = $field . ' <=';
        $this->db->where($field, $min);
        return $this->db->get($table)->result_array();
    }

    public function get_upcoming_events()
    {
        $tanggal_sekarang = date('Y-m-d');
        $this->db->where('TGL_AKHIR_EVENT <', $tanggal_sekarang);
        $this->db->where('STATUS_EVENT !=', 'ditutup');
        $query = $this->db->get('event');
        return $query->result();
    }

    public function update_status_selesai($id_event)
    {
        $this->db->where('ID_EVENT', $id_event);
        $this->db->update('event', array('STATUS_EVENT' => 'ditutup'));
    }
}
