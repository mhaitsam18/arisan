<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_Laporan');
    }

    public function penjualan()
    {
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('laporan/penjualan', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $data['kategori'] = $this->input->post('kategori');
            $this->load->view('laporan/cetak_penjualan', $data);
        }
    }

    public function cetak()
    {
        $this->load->library('dompdf_gen');
        $data['title'] = 'Laporan Penjualan';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $this->form_validation->set_rules('tgl_awal', 'Tanggal Awal', 'trim|required', [
            'required' => 'Tanggal awal harus diisi'
        ]);
        $this->form_validation->set_rules('tgl_akhir', 'Tanggal akhir', 'trim|required', [
            'required' => 'Tanggal akhir harus diisi'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('laporan/penjualan', $data);
            $this->load->view('templates/footer');
        } else {
            $data['rows'] = $this->M_Laporan->getBerdasarkanTanggal()->result();
            $data['tgl_awal'] = $this->input->post('tgl_awal');
            $data['tgl_akhir'] = $this->input->post('tgl_akhir');
            $this->load->view('laporan/cetak_penjualan', $data);

            // $paper_size = 'A4';
            // $orientation = 'landscape';
            // $html = $this->output->get_output();
            // $this->dompdf->set_paper($paper_size, $orientation);

            // $this->dompdf->load_html($html);
            // $this->dompdf->render();
            // $this->dompdf->stream("laporan_penjualan.pdf", array('Attachment' => 0));
        }
    }

    public function struk()
    {
        $data['kode_penjualan'] = $this->uri->segment(3);
        $data['penjualan'] = $this->M_Penjualan->getPenjualan()->result();
        $data['tanggal_beli'] = $this->db->get_where('penjualan', ['kode_penjualan' => $this->uri->segment(3)])->row();
        $data['detail_penjualan'] = $this->db->get_where('detail_penjualan', ['kode_penjualan' => $this->uri->segment(3)])->row();
        $this->load->view('penjualan/struk', $data);
    }

    public function laba_rugi()
    {
        $data['title'] = 'Laporan Laba Rugi';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

        $data['rows'] = $this->M_Laporan->getData()->result();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('laporan/laba_rugi', $data);
        $this->load->view('templates/footer');
    }
}
