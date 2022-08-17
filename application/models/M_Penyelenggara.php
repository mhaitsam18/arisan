<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Penyelenggara extends CI_Model
{
    public function getData()
    {
        $this->db->select('*, user.id as id_user');
        $this->db->from('user');
        $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $this->db->group_by('username');
        // $this->db->where('username', $this->session->userdata('username'));
        return $this->db->get();
    }
    public function getDataDetail($id = NULL)
    {
        $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $query = $this->db->get_where('user', array('user.id' => $id))->row();
        return $query;
        // $this->db->where('id', $id);
        // $query = $this->db->get('user');
        // return $query->row();
        // $this->db->select('*, user.id as id_user');
        // $this->db->from('user');
        // $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        // $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        // $this->db->where('id_user', $id);
        // return $this->db->get();
        // $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        // $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        // $this->db->where('user.id', $id);
        // $query = $this->db->get('user');
        // return $query->row();
    }

    public function getDataDetailByIdUser($id_user = NULL)
    {
        $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $query = $this->db->get_where('user', array('user.id' => $id_user))->result();
        return $query;
    }

    public function getDataDetailProgres($id_user = NULL)
    {
        $this->db->join('user', 'user.nama_lengkap = pembayaran.nama_lengkap', 'left');
        $query = $this->db->get_where('pembayaran', array('pembayaran.nama_lengkap' => $id_user))->result();
        return $query;
    }

    public function dataPeserta()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->order_by('nama_petugas', 'asc');
        return $this->db->get();
        // return $query->result();
    }

    public function getDataProses()
    {
        $status = "pembayaran_bulanan.status='proses'";
        $this->db->select('*, pembayaran_bulanan.id as id_pembayaran, petugas.id as id_petugas, petugas.no_hp as noHP');
        $this->db->from('pembayaran_bulanan');
        $this->db->join('petugas', 'petugas.id = pembayaran_bulanan.id_petugas');
        $this->db->where($status);
        return $this->db->get();
    }

    public function getDataSukses()
    {
        $status = "status='sukses'";
        $this->db->select('*');
        $this->db->from('pembayaran_bulanan');
        $this->db->where($status);
        return $this->db->get();
    }

    public function getDataSuksesByTanggal()
    {
        $status = "status='sukses'";
        $this->db->select('*');
        $this->db->from('pembayaran_bulanan');
        $this->db->where($status);
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }

    public function getDataCancel()
    {
        $status = "status='cancel'";
        $this->db->select('*');
        $this->db->from('pembayaran_bulanan');
        $this->db->where($status);
        return $this->db->get();
    }

    public function getBarangPeserta($id_peserta = null)
    {

        $this->db->select('*, COUNT(id_barang) AS jumlah, SUM(harga) AS sub_total');
        $this->db->from('user');
        $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $this->db->group_by('id_barang');
        $this->db->where('user.id', $id_peserta);
        return $this->db->get();
    }

    public function getDataProgres($id_peserta = null)
    {
        $this->db->select('*, pembayaran.status as status_pembayaran');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.nama_lengkap = pembayaran.nama_lengkap', 'left');
        $this->db->where('user.id', $id_peserta);
        return $this->db->get();
    }

    public function getTotalBayarPeserta()
    {
        $this->db->select('user.*, SUM(pembayaran.nominal) AS total_bayar');
        $this->db->from('user');
        $this->db->join('pembayaran', 'user.id = pembayaran.id_user', 'left');
        // $this->db->where('pembayaran.status', 'sukses');
        $this->db->order_by('created_at', 'desc');
        $this->db->group_by('user.id');
        return $this->db->get();
    }

    public function getTotalBayarPetugas()
    {
        $this->db->select('petugas.*, COUNT(user.id_petugas) AS jumlah_peserta, SUM(pembayaran_bulanan.nominal) AS total_bayar');
        $this->db->from('petugas');
        $this->db->join('user', 'petugas.id = user.id_petugas', 'left');
        $this->db->join('pembayaran_bulanan', 'petugas.id = pembayaran_bulanan.id_petugas', 'left');
        // $this->db->where('pembayaran.status', 'sukses');
        $this->db->order_by('petugas.created_at', 'desc');
        $this->db->group_by('petugas.id');
        return $this->db->get();
    }
}
