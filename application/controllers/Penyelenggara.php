<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penyelenggara extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_DataMaster');
        $this->load->model('M_Penyelenggara');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Dashboard - Penyelenggara';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['sukses'] = $this->M_Penyelenggara->getDataSukses()->result();
        $data['jumlah_petugas'] = $this->db->get('petugas')->num_rows();
        $data['jumlah_peserta'] = $this->db->get('user')->num_rows();
        $data['jumlah_barang'] = $this->db->get('barang')->num_rows();
        $data['rows'] = $this->M_Penyelenggara->getTotalBayarPeserta()->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/dashboard');
        $this->load->view('templates/footer');
    }

    public function data_petugas()
    {
        $data['title'] = 'Data Petugas';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->db->query('SELECT petugas.*, COUNT(user.id_petugas) AS jumlah_perserta FROM petugas LEFT JOIN user ON petugas.id = user.id_petugas GROUP BY petugas.id ORDER BY created_at DESC')->result();
        // $data['rows'] = $this->db->query('SELECT * FROM petugas order by id desc')->result();


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/data_petugas', $data);
        $this->load->view('templates/footer');
    }

    public function input_petugas()
    {
        // $username = $this->input->post('username', true);
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $data = [
            'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
            // 'username' => htmlspecialchars($username),
            'alamat' => htmlspecialchars($this->input->post('alamat', false)),
            'no_hp' => htmlspecialchars($this->input->post('no_hp', false)),
            'image' => 'default.png',
            // 'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'status' => 'nonaktif',
            'created_at' => $waktu
        ];

        $this->db->insert('petugas', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Petugas Berhasil Ditambah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
        redirect('penyelenggara/data_petugas');
    }

    public function kirim_wa()
    {
        $id = $this->input->post('id', true);
        $username = $this->input->post('username', true);
        $password = password_hash($this->input->post('password'), PASSWORD_DEFAULT);
        $password2 = $this->input->post('password', true);
        $no_hp = $this->input->post('no_hp', true);

        $dataUpdate = array(
            'username' => $username,
            'password' => $password,
            'status' => 'aktif'
        );

        $this->db->set($dataUpdate);
        $this->db->where('id', $id);
        $this->db->update('petugas');

        header("location:https://api.whatsapp.com/send?phone=$no_hp&text=Username:%20$username%20%0DPassword:%20$password2");
    }

    public function nonaktif_petugas($id)
    {
        $this->db->set('status', 'nonaktif');
        $this->db->where('id', $id);
        $this->db->update('petugas');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Status peserta berhasil dirubah
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('penyelenggara/data_petugas');
    }

    public function aktif_petugas($id)
    {
        $this->db->set('status', 'aktif');
        $this->db->where('id', $id);
        $this->db->update('petugas');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Status peserta berhasil dirubah
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('penyelenggara/data_petugas');
    }

    public function hapus_petugas($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('petugas');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil dihapus
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('penyelenggara/data_petugas');
    }

    public function data_peserta()
    {
        $data['title'] = 'Data Peserta';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        // $data['rows'] = $this->M_Penyelenggara->dataPeserta()->result();

        $this->db->select('user.*, SUM(pembayaran.nominal) AS total_bayar');
        // $this->db->join('target_barang', 'user.id = target_barang.id_user', 'left');
        // $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $this->db->join('pembayaran', 'user.id = pembayaran.id_user', 'left');
        $this->db->order_by('created_at', 'desc');
        $this->db->group_by('user.id');
        $data['rows'] = $this->db->get_where('user', [
            'pembayaran.status !=' => 'cancel'
        ])->result();

        // $data['rows'] = $this->M_Penyelenggara->getTotalBayarPeserta()->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/data_peserta');
        $this->load->view('templates/footer');
    }

    public function data_barang_peserta($id_peserta = null)
    {

        $data['title'] = 'Paket Barang Peserta';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Penyelenggara->getBarangPeserta($id_peserta)->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('peserta/paket_barang', $data);
        $this->load->view('templates/footer');
    }

    public function progres_peserta($id_peserta = null)
    {
        $data['title'] = 'Progres Peserta';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Penyelenggara->getDataProgres($id_peserta)->result();
        $id_user = $id_peserta;
        $data['harga_barang'] = $this->db->query("SELECT SUM(harga_beli) AS total, SUM(harga) AS harga_barang, tabungan FROM target_barang JOIN barang ON barang.id = target_barang.id_barang JOIN user ON target_barang.id_user = user.id WHERE id_user = $id_user")->row();

        $this->db->join('petugas', 'petugas.id_penyelenggara = penyelenggara.id');
        $this->db->join('user', 'user.id_petugas = petugas.id');
        $this->db->where('user.id', $id_user);
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('peserta/progres', $data);
        $this->load->view('templates/footer');
    }



    public function paket_tabungan()
    {
        $data['title'] = 'Paket Tabungan';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Penyelenggara->getData()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/paket_tabungan');
        $this->load->view('templates/footer');
    }

    public function detail_tabungan($id)
    {
        $data['title'] = 'Paket Tabungan';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Penyelenggara->getDataDetail($id);
        $data['data_barang'] = $this->M_Penyelenggara->getDataDetailByIdUser($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/detail_tabungan', $data);
        $this->load->view('templates/footer');
    }

    public function detail_progres($id)
    {
        $data['title'] = 'Progres';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        // $data['rows'] = $this->M_Penyelenggara->getDataDetail($id);
        $data['data_barang'] = $this->M_Penyelenggara->getDataDetailProgres($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/detail_progres', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_pembayaran()
    {
        $data['title'] = 'Laporan Pembayaran';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['proses'] = $this->M_Penyelenggara->getDataProses()->result();
        $data['sukses'] = $this->db->query("SELECT * FROM pembayaran_bulanan WHERE status = 'sukses'")->result();
        // $data['rows'] = $this->db->get('pembayaran_bulanan')->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/data_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function proses_status($id)
    {
        $this->db->set('status', 'sukses');
        $this->db->where('id', $id);
        $this->db->update('pembayaran_bulanan');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pembayaran berhasil di approve
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('penyelenggara/pembayaran_petugas_sukses');
    }

    public function cancel_status($id)
    {
        $no_hp = $this->input->post('no_hp', true);
        $keterangan = $this->input->post('keterangan', true);

        $this->db->set('status', 'cancel');
        $this->db->where('id', $id);
        $this->db->update('pembayaran_bulanan');
        header("location:https://api.whatsapp.com/send?phone=$no_hp&text=Keterangan:%20$keterangan");

        // header("location:https://api.whatsapp.com/send?phone=$no_hp&text=Keterangan:%20$keterangan");

        //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //     Status pembayaran berhasil dirubah
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //   </div>');
        //     redirect('penyelenggara/pembayaran_petugas_cancel');
    }

    public function cetak_pembayaran()
    {
        $data['title'] = 'Laporan Pembayaran';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->db->query("SELECT * FROM pembayaran_bulanan WHERE status = 'sukses'")->result();

        $this->load->view('penyelenggara/cetak_laporan_pembayaran', $data);
    }

    public function profile()
    {
        $data['title'] = 'Profil Penyelenggara';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/profile');
        $this->load->view('templates/footer');
    }

    public function settings()
    {
        $data['title'] = 'Pengaturan';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/settings');
        $this->load->view('templates/footer');
    }

    public function edit_profile()
    {
        $data['title'] = 'Edit Profile';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();

        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong!'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_penyelenggara', $data);
            $this->load->view('penyelenggara/settings', $data);
            $this->load->view('templates/footer');
        } else {
            $nama_lengkap = $this->input->post('nama_lengkap');
            $alamat = $this->input->post('alamat');
            $no_hp = $this->input->post('no_hp');
            $username = $this->input->post('username');
            $tanggal_mulai = $this->input->post('tanggal_mulai');
            $tanggal_selesai = $this->input->post('tanggal_selesai');

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
                'no_hp' => $no_hp,
                'tanggal_mulai' => $tanggal_mulai,
                'tanggal_selesai' => $tanggal_selesai
            );

            $this->db->set($dataUpdate);
            $this->db->where('username', $username);
            $this->db->update('penyelenggara');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Profile berhasil diubah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('penyelenggara/settings');
        }
    }

    public function edit_tanggal()
    {
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();

        $username = $this->input->post('username');
        $tanggal_mulai = $this->input->post('tanggal_mulai');
        $tanggal_selesai = $this->input->post('tanggal_selesai');

        $dataUpdate = array(
            'tanggal_mulai' => $tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai
        );

        $this->db->set($dataUpdate);
        $this->db->where('username', $username);
        $this->db->update('penyelenggara');

        redirect('penyelenggara');
    }

    public function ubah_password()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();

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
            $this->load->view('templates/sidebar_penyelenggara', $data);
            $this->load->view('penyelenggara/settings', $data);
            $this->load->view('templates/footer');
        } else {
            $currentPassword = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata('message_password', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Password lama salah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                redirect('penyelenggara/settings');
            } else {
                if ($currentPassword == $new_password) {
                    $this->session->set_flashdata('message_password', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Password baru tidak boleh sama dengan password lama
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
                    redirect('penyelenggara/settings');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('penyelenggara');

                    $this->session->set_flashdata('message_password', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password berhasil dirubah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
                    redirect('penyelenggara/settings');
                }
            }
        }
    }

    public function data_barang()
    {
        $data['title'] = 'Data Barang';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_DataMaster->getDataBarang()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('data-master/data_barang');
        $this->load->view('templates/footer');
    }

    public function info_barang()
    {
        $data['title'] = 'Info Barang';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_DataMaster->getDataBarang()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('data-master/info_barang');
        $this->load->view('templates/footer');
    }

    public function getUpdateTerpenuhi()
    {
        echo json_encode(
            $this->db->select('barang.*, COUNT(id_target_barang) AS jumlah_kebutuhan')
                ->join('target_barang', 'target_barang.id_barang = barang.id', 'left')
                ->get_where('barang', ['id' => $this->input->post('id')])
                ->row_array()
        );
    }

    public function update_terpenuhi()
    {
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('barang', ['terpenuhi' => $this->input->post('terpenuhi')]);
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Stok terpenuhi terupdate
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function tambah_barang()
    {
        $gambar = $_FILES['gambar'];
        $nama_barang = htmlspecialchars($this->input->post('nama_barang', true));
        $volume = htmlspecialchars($this->input->post('volume', true));
        $harga = htmlspecialchars($this->input->post('harga', true));
        $harga_beli = htmlspecialchars($this->input->post('harga_beli', true));

        $config['upload_path'] = './assets/img/barang/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';

        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('gambar')) {
            echo 'gagal';
            die;
        } else {
            $gambar = $this->upload->data('file_name');
        }

        $data = array(
            'gambar' => $gambar,
            'nama_barang' => $nama_barang,
            'volume' => $volume,
            'harga' => $harga,
            'harga_beli' => $harga_beli
        );

        $this->db->insert('barang', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
       Barang berhasil ditambahkan
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('penyelenggara/data_barang');
    }

    public function hapus_barang($id)
    {
        $this->db->where('id', $id);
        $this->db->update('barang', ['deleted_at' => date('Y-m-d H:i:s')]);
        // $this->db->delete('barang');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Barang berhasil dihapus
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>');
        redirect('penyelenggara/data_barang');
    }

    public function pembayaran_petugas_sukses()
    {
        $data['title'] = 'Pembayaran Petugas';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Penyelenggara->getDataSukses()->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/pembayaran_petugas_sukses', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_petugas_sukses_by_tanggal()
    {
        $data['title'] = 'Pembayaran Petugas';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Penyelenggara->getDataSuksesByTanggal()->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $data['tgl_awal'] = $this->input->post('tgl_awal');
        $data['tgl_akhir'] = $this->input->post('tgl_akhir');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/pembayaran_petugas_sukses_by_tanggal', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_petugas_cancel()
    {
        $data['title'] = 'Pembayaran Petugas';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Penyelenggara->getDataCancel()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_penyelenggara', $data);
        $this->load->view('penyelenggara/pembayaran_petugas_cancel', $data);
        $this->load->view('templates/footer');
    }

    public function edit_barang($id)
    {
        $data['title'] = 'Edit Barang';
        $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
        $data['data_barang'] = $this->M_DataMaster->getDataDetailBarang($id);

        $this->form_validation->set_rules('nama_barang', 'Nama Barang', 'required|trim', [
            'required' => 'Nama Barang tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('volume', 'Volume', 'required|trim', [
            'required' => 'Volume tidak boleh kosong!'
        ]);
        $this->form_validation->set_rules('harga', 'Harga Barang', 'required|trim', [
            'required' => 'Harga Barang tidak boleh kosong!'
        ]);


        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_penyelenggara', $data);
            $this->load->view('data-master/edit_barang', $data);
            $this->load->view('templates/footer');
        } else {
            $id = $this->input->post('id');
            $nama_barang = $this->input->post('nama_barang');
            $volume = $this->input->post('volume');
            $harga = $this->input->post('harga');

            // cek jiga ada gambar yang akan di upload
            $upload_image = $_FILES['gambar']['name'];

            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '2048';
                $config['upload_path'] = './assets/img/barang/';

                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('gambar')) {
                    echo 'gagal';
                    die;
                } else {
                    $gambar = $this->upload->data('file_name');
                    $this->db->set('gambar', $gambar);
                }
            }
            $dataUpdate = array(
                'nama_barang' => $nama_barang,
                'volume' => $volume,
                'harga' => $harga
            );

            $this->db->set($dataUpdate);
            $this->db->where('id', $id);
            $this->db->update('barang');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Barang berhasil diubah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('penyelenggara/data_barang');
        }
    }

    public function pembayaran_offline()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Tanggal tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim', [
            'required' => 'Nominal tidak boleh kosong'
        ]);
        // $data['barang'] = $this->M_Barang->getDataBarang();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Input Setoran Petugas';
            $data['user'] = $this->db->get_where('penyelenggara', ['username' => $this->session->userdata('username')])->row_array();
            $data['petugas'] = $this->db->get('petugas')->result();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_penyelenggara', $data);
            $this->load->view('penyelenggara/pembayaran_offline', $data);
            $this->load->view('templates/footer');
        } else {
            // validasi sukses
            $this->_insert_pembayaran_offline();
        }
    }

    public function _insert_pembayaran_offline()
    {
        $bukti = ('Diinput oleh penyelenggara');
        $status = ('sukses');
        $nama_lengkap = htmlspecialchars($this->input->post('nama_lengkap', true));
        $tanggal = htmlspecialchars($this->input->post('tanggal', true));
        $nominal = htmlspecialchars($this->input->post('nominal', true));

        $data = array(
            'bukti' => $bukti,
            'nama_lengkap' => $nama_lengkap,
            'tanggal' => $tanggal,
            'nominal' => $nominal,
            'status' => $status
        );

        $this->db->insert('pembayaran_bulanan', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
       Input pembayaran berhasil
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('penyelenggara/pembayaran_petugas_sukses');
    }
}
