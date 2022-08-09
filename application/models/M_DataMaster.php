<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * 
 */
class M_DataMaster extends CI_Model
{

    public function getDataBarang()
    {
        $this->db->select('barang.*, COUNT(id_target_barang) AS jumlah_kebutuhan');
        $this->db->join('target_barang', 'target_barang.id_barang = barang.id', 'left');
        $this->db->from('barang');
        $this->db->group_by('barang.id');
        $this->db->where('barang.deleted_at', NULL, FALSE);
        return $this->db->get();
    }

    public function getDataDetailBarang($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('barang');
        return $query->row();
    }
}
