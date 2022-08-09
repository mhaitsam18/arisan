<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kirim extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_Kirim');
    }

    public function index()
    {
        $data['title'] = 'Data Laporan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['rows'] = $this->db->get('data_laporan')->result();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('data_laporan/laporan', $data);
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $bulan = $this->input->post('bulan', true);
        $laporan_penjualan = $_FILES['laporan_penjualan'];
        $laporan_labarugi = $_FILES['laporan_labarugi'];
        $laporan_neraca = $_FILES['laporan_neraca'];
        $status = 'proses';
        $feedback = $this->input->post('feedback', true) == '' ? NULL : $this->input->post('feedback', true);

        $config['upload_path'] = './assets/laporan';
        $config['allowed_types'] = 'pdf|doc';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('laporan_penjualan', 'laporan_labarugi', 'laporan_neraca')) {
            echo 'gagal';
            die;
        } else {
            $laporan_penjualan = $this->upload->data('file_name');
            $laporan_labarugi = $this->upload->data('file_name');
            $laporan_neraca = $this->upload->data('file_name');
        }

        $data = array(
            'bulan' => $bulan,
            'laporan_penjualan' => $laporan_penjualan,
            'laporan_labarugi' => $laporan_labarugi,
            'laporan_neraca' => $laporan_neraca,
            'status' => $status,
            'feedback' => $feedback
        );

        $this->db->insert('data_laporan', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil <strong>ditambahkan!</strong>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim');
    }

    public function hapus($id)
    {
        $this->db->where('id_laporan', $id);
        $this->db->delete('data_laporan');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data berhasil <strong>dihapus!</strong>.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('kirim');
    }
}
