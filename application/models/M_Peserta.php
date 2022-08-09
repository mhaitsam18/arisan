<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_Peserta extends CI_Model
{
    public function getData()
    {
        $this->db->select('*, COUNT(id_barang) AS jumlah, SUM(harga) AS sub_total');
        $this->db->from('user');
        $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $this->db->group_by('id_barang');
        $this->db->where('username', $this->session->userdata('username'));
        return $this->db->get();
    }

    public function getJumlahBayar()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $this->db->where('username', $this->session->userdata('username'));
        return $this->db->get();
    }

    public function getDataPembayaran()
    {
        $this->db->select('*, pembayaran.status as status_pembayaran');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.nama_lengkap = pembayaran.nama_lengkap', 'left');
        $this->db->where('username', $this->session->userdata('username'));
        // $this->db->where('pembayaran.status', 'proses');
        // $this->db->where('pembayaran.status', 'sukses');
        $this->db->where_in('pembayaran.status', array('proses', 'sukses'));
        return $this->db->get();
    }

    public function getDataPembayaran2()
    {
        $this->db->select('*, pembayaran.status as status_pembayaran');
        $this->db->from('pembayaran');
        $this->db->join('user', 'user.nama_lengkap = pembayaran.nama_lengkap', 'left');
        $this->db->where('username', $this->session->userdata('username'));
        return $this->db->get();
    }

    public function getBarangPeserta($id_peserta = null)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('target_barang', 'target_barang.id_user = user.id', 'left');
        $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $this->db->where('user.id', $id_peserta);
        return $this->db->get();
    }
}
