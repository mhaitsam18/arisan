<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peserta extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_DataMaster');
        $this->load->model('M_Peserta');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Dashboard - Peserta';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Peserta->getData()->result();

        $data['pembayaran'] = $this->M_Peserta->getDataPembayaran()->result();
        $id_user = $this->session->userdata('id');
        $data['harga_barang'] = $this->db->query("SELECT SUM(harga_beli) AS total, SUM(harga) AS harga_barang, tabungan FROM target_barang JOIN barang ON barang.id = target_barang.id_barang JOIN user ON target_barang.id_user = user.id WHERE id_user = $id_user")->row();
        $this->db->join('petugas', 'petugas.id_penyelenggara = penyelenggara.id');
        $this->db->join('user', 'user.id_petugas = petugas.id');
        $this->db->where('user.id', $id_user);
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_peserta', $data);
        $this->load->view('peserta/dashboard');
        $this->load->view('templates/footer');
    }

    public function pilih_barang()
    {
        $data['title'] = '';
        $data['barang'] = $this->db->get('barang')->result();

        $this->load->view('templates/auth_header', $data);
        $this->load->view('peserta/pilih_barang', $data);
        $this->load->view('templates/auth_footer');
    }

    public function profile()
    {
        $data['title'] = 'Profil Peserta';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_peserta', $data);
        $this->load->view('peserta/profile');
        $this->load->view('templates/footer');
    }

    public function settings()
    {
        $data['title'] = 'Pengaturan';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_peserta', $data);
        $this->load->view('peserta/settings');
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('petugas/settings', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_lengkap = $this->input->post('nama_lengkap');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');
            $username = $this->input->post('username');

            // cek jiga ada gambar yang akan di upload
            $upload_image = $_FILES['image']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/profile/';

                $this->load->library('upload', $config);

                if ($this->upload->do_upload('image')) {
                    $old_image = $data['user']['image'];
                    if ($old_image != 'default.png') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }

                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    echo $this->upload->display_errors();
                }
            }
            $dataUpdate = array(
                'nama_lengkap' => $nama_lengkap,
                'alamat' => $alamat,
                'no_hp' => $no_hp
            );

            $this->db->set($dataUpdate);
            $this->db->where('username', $username);
            $this->db->update('user');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Profile berhasil diubah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('peserta/profile');
        }
    }

    public function ubah_password()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('current_password', 'Password', 'required|trim', [
            'required' => 'Password lama wajib diisi!'
        ]);
        $this->form_validation->set_rules('new_password1', 'Password Baru', 'required|trim|min_length[6]', [
            'required' => 'Password baru wajib diisi!',
            'min_length' => 'Password terlalu pendek, minimal 6 karakter!'
        ]);
        $this->form_validation->set_rules('new_password2', 'Konfirmasi Password', 'required|trim|matches[new_password1]', [
            'required' => 'Konfirmasi password wajib diisi!',
            'matches' => 'Konfirmasi password salah'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_peserta', $data);
            $this->load->view('peserta/settings', $data);
            $this->load->view('templates/footer');
        } else {
            $currentPassword = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata('message_password', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Password lama salah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                redirect('peserta/settings');
            } else {
                if ($currentPassword == $new_password) {
                    $this->session->set_flashdata('message_password', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Password baru tidak boleh sama dengan password lama
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
                    redirect('peserta/settings');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('user');

                    $this->session->set_flashdata('message_password', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password berhasil dirubah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
                    redirect('peserta/settings');
                }
            }
        }
    }

    public function paket_barang()
    {
        $data['title'] = 'Paket Lebaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Peserta->getData()->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_peserta', $data);
        $this->load->view('peserta/paket_barang');
        $this->load->view('templates/footer');
    }

    public function checkNominal()
    {

        $barang = $this->M_Peserta->getBarangPeserta($this->input->get('id_peserta'))->result();
        $jml_bayar = 0;
        $total = 0;
        foreach ($barang as $row) {
            $tabungan = $row->tabungan;
            $total += $row->harga;
            $jml_bayar = $tabungan + $total;
        }

        $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
        $petugas = $this->db->get_where('petugas', ['id' => $user->id_petugas])->row();
        $penyelenggara = $this->db->get_where('penyelenggara', ['id' => $petugas->id_penyelenggara])->row();

        $this->db->order_by('tanggal', 'DESC');
        // $pembayaran = $this->db->get_where('pembayaran', ['id_user' => $this->session->userdata('id')])->row();
        $pembayaran = $this->M_Peserta->getDataPembayaran()->row();

        if ($pembayaran) {
            $tanggal_awal = $pembayaran->tanggal;
        } else {
            $tanggal_awal = date('Y-m-d', strtotime('-1 days', strtotime($penyelenggara->tanggal_mulai)));
        }
        $jml_hari =  date_diff(date_create($tanggal_awal), date_create($this->input->get('tanggal')));

        $hasil = $jml_bayar * $jml_hari->days;
        echo json_encode(['nominal' => 'Rp.' . number_format($hasil, 0, ',', '.')]);
    }

    public function pembayaran_peserta()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Tanggal tidak boleh kosong'
        ]);

        // $this->form_validation->set_rules('bukti', 'Bukti', 'required', [
        //     'required' => 'Bukti tidak boleh kosong dan pastikan file bukti pembayaran anda jpg,png atau jpeg'

        // ]);

        // $data['barang'] = $this->M_Barang->getDataBarang();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Upload Pembayaran Iuran';


            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['rows'] = $this->M_Peserta->getJumlahBayar()->result();


            $this->db->order_by('tanggal', 'DESC');
            $this->db->limit(1);
            // $pembayaran = $this->db->get_where('pembayaran', ['id_user' => $this->session->userdata('id')])->row();
            $pembayaran = $this->M_Peserta->getDataPembayaran()->row();

            $user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row();
            $petugas = $this->db->get_where('petugas', ['id' => $user->id_petugas])->row();
            $penyelenggara = $this->db->get_where('penyelenggara', ['id' => $petugas->id_penyelenggara])->row();
            if ($pembayaran) {
                $data['tanggal_minimal'] = date('Y-m-d', strtotime('+1 days', strtotime($pembayaran->tanggal)));
            } else {
                $data['tanggal_minimal'] = $penyelenggara->tanggal_mulai;
            }
            $data['tanggal_maksimal'] = $penyelenggara->tanggal_selesai;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_peserta', $data);
            $this->load->view('peserta/pembayaran_peserta');
            $this->load->view('templates/footer');
        } else {
            // validasi sukses
            $this->proses_pembayaran_peserta();
        }
    }

    public function proses_pembayaran_peserta()
    {
        $bukti = $_FILES['bukti'];
        $nama_lengkap = htmlspecialchars($this->input->post('nama_lengkap', true));
        $tanggal = htmlspecialchars($this->input->post('tanggal', true));
        $nominal1 = str_replace('Rp.', '', $this->input->post('nominal', true));
        $nominal2 = str_replace('.', '', $nominal1);
        $status = ('proses');

        $config['upload_path'] = './assets/img/bukti_bayar/';
        $config['allowed_types'] = 'jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('bukti')) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            Pembayaran gagal, pastikan format bukti pembayaran sudah sesuai
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('peserta/pembayaran_peserta');
        } else {
            $bukti = $this->upload->data('file_name');
        }

        $data = array(
            'bukti' => $bukti,
            'id_user' => $this->session->userdata('id'),
            'nama_lengkap' => $nama_lengkap,
            'tanggal' => $tanggal,
            'nominal' => $nominal2,
            'status' => $status
        );

        $this->db->insert('pembayaran', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
       Pembayaran berhasil, menunggu konfirmasi petugas
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('peserta/progres');
    }

    public function progres()
    {
        $data['title'] = 'Progres Pembayaran';
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Peserta->getDataPembayaran()->result();
        $id_user = $this->session->userdata('id');
        $data['harga_barang'] = $this->db->query("SELECT SUM(harga_beli) AS total, SUM(harga) AS harga_barang, tabungan FROM target_barang JOIN barang ON barang.id = target_barang.id_barang JOIN user ON target_barang.id_user = user.id WHERE id_user = $id_user")->row();


        $this->db->join('petugas', 'petugas.id_penyelenggara = penyelenggara.id');
        $this->db->join('user', 'user.id_petugas = petugas.id');
        $this->db->where('user.id', $id_user);
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_peserta', $data);
        $this->load->view('peserta/progres');
        $this->load->view('templates/footer');
    }
}
