<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{
    public function get($table, $data = null, $where = null)
    {
        if ($data != null) {
            return $this->db->get_where($table, $data)->row_array();
        } else {
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
        $this->db->join('jenis j', 'e.jenis_id = j.id_jenis');
        $this->db->order_by('id_event');
        return $this->db->get('event e')->result_array();
    }

    public function getRegistrasi($event)
    {
        $this->db->join('event e', 'r.event_id = e.id_event');
        $this->db->like('nama_event', $event);
        $this->db->order_by('id_registrasi');
        return $this->db->get('registrasi r')->result_array();
    }

    public function getUploads()
    {
        $this->db->join('registrasi r', 'u.registrasi_id = r.id_registrasi');
        $this->db->order_by('registrasi_id');
        return $this->db->get('uploads u')->result_array();
    }

    public function chartEventMulai($bulan)
    {
        $like = '2023-' . $bulan;
        $this->db->like('tanggal_mulai', $like, 'after');
        return count($this->db->get('event')->result_array());
    }

    public function chartEventAkhir($bulan)
    {
        $like = '2023-' . $bulan;
        $this->db->like('tanggal_akhir', $like, 'after');
        return count($this->db->get('event')->result_array());
    }

    public function getMax($table, $field, $kode = null)
    {
        $this->db->select_max($field);
        if ($kode != null) {
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
}
