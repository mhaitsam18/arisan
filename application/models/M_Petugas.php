<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Petugas extends CI_Model
{
    public function getData()
    {
        // $status = "pembayaran.status='proses'";
        $this->db->select('*, pembayaran.id as id_pembayaran, user.id as id_user, user.no_hp as noHp');
        // $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.id = pembayaran.id_user', 'right');
        $this->db->where('pembayaran.status', 'proses');
        $this->db->where('id_petugas', $this->session->userdata('id'));
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }

    public function getDataSukses()
    {
        $this->db->select('*, pembayaran.nama_lengkap AS nama_peserta, pembayaran.nominal AS nominal_peserta, pembayaran.bukti AS bukti_peserta, pembayaran.status AS status_peserta, pembayaran.id AS id_pembayaran');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.id = pembayaran.id_user', 'left');
        $this->db->join('pembayaran_bulanan', 'user.id_petugas = pembayaran_bulanan.id_petugas', 'left');
        $this->db->where('pembayaran.status', 'sukses');
        $this->db->where('user.id_petugas', $this->session->userdata('id'));
        $tgl = 'MAX(pembayaran.tanggal)';
        $this->db->where('tanggal >=', $tgl);
        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get();
    }

    public function getDataSuksesByTanggal()
    {
        $status = "pembayaran.status='sukses'";
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.id = pembayaran.id_user', 'left');
        $this->db->where($status);
        $this->db->where('id_petugas', $this->session->userdata('id'));
        $this->db->where('tanggal >', '2022-06-15');
        $this->db->where('tanggal >=', $this->input->post('tgl_awal'));
        $this->db->where('tanggal <=', $this->input->post('tgl_akhir'));
        $this->db->order_by('tanggal', 'ASC');
        return $this->db->get();
    }

    public function getDataCancel()
    {
        $status = "pembayaran.status='cancel'";
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.id = pembayaran.id_user', 'left');
        $this->db->where($status);
        $this->db->where('id_petugas', $this->session->userdata('id'));
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }

    public function getDataSetor()
    {
        $status = "pembayaran.status='cancel'";
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.id = pembayaran.id_user', 'left');
        $this->db->where($status);
        $this->db->where('id_petugas', $this->session->userdata('id'));
        $this->db->order_by('tanggal', 'DESC');
        return $this->db->get();
    }

    public function getDataLaporanSukses()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bulanan');
        $this->db->where('nama_lengkap', $this->session->userdata('nama_lengkap'));
        $data = array('proses', 'sukses');
        $this->db->where_in('status', $data);
        return $this->db->get();
    }

    public function getDataSetoran()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bulanan');
        $this->db->where('nama_lengkap', $this->session->userdata('nama_lengkap'));
        // $data = array('proses', 'sukses');
        $this->db->where_in('status', 'sukses');
        return $this->db->get();
    }

    public function getDataLaporanCancel()
    {
        $this->db->select('*');
        $this->db->from('pembayaran_bulanan');
        $this->db->where('nama_lengkap', $this->session->userdata('nama_lengkap'));
        $this->db->where('status', 'cancel');
        return $this->db->get();
    }

    public function jumlah()
    {
        $nama_lengkap = $this->session->userdata('nama_lengkap');
        // $this->db->select('sum(nominal) as nominal');
        // $this->db->from('pembayaran_bulanan');
        // $this->db->where('status', 'sukses');
        // $this->db->where('nama_lengkap', '$nama_lengkap');
        // return $this->db->get()->nominal;
        $sql = "SELECT sum(nominal) as nominal FROM pembayaran_bulanan WHERE status = 'sukses' and nama_lengkap = '$nama_lengkap'";
        $result = $this->db->query($sql);
        return $result->row()->nominal;
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

    public function getBarangPesertaAja($id_peserta = null)
    {
        $this->db->select('*');
        $this->db->from('target_barang');
        $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $this->db->join('user', 'user.id = target_barang.id_user', 'left');
        $this->db->where('id_user', $id_peserta);
        return $this->db->get();
    }

    public function getDataProgres($id_peserta = null)
    {
        $this->db->select('*, pembayaran.status as status_pembayaran');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.nama_lengkap = pembayaran.nama_lengkap', 'left');
        $this->db->where('user.id', $id_peserta);
        $this->db->where_in('pembayaran.status', array('proses', 'sukses'));
        return $this->db->get();
    }
}
