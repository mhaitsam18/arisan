<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Petugas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_DataMaster');
        $this->load->model('M_Petugas');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data['title'] = 'Dashboard - Petugas';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['jumlah_peserta'] = $this->db->get_where('user', ['nama_petugas' => $this->session->userdata('nama_lengkap')])->num_rows();
        $data['pembayaran_masuk'] = $this->M_Petugas->getDataSukses()->result();

        $this->db->select('user.*, SUM(pembayaran.nominal) AS total_bayar');
        $this->db->join('pembayaran', 'user.id = pembayaran.id_user', 'left');
        $this->db->order_by('created_at', 'desc');
        $this->db->group_by('user.id');
        $data['rows'] = $this->db->get_where('user', ['id_petugas' => $this->session->userdata('id')])->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();
        $data['setoran'] = $this->M_Petugas->getDataSetoran()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/dashboard', $data);
        $this->load->view('templates/footer');
    }

    public function data_peserta()
    {
        $data['title'] = 'Data Peserta';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->db->select('user.*, SUM(pembayaran.nominal) AS total_bayar');
        // $this->db->join('target_barang', 'user.id = target_barang.id_user', 'left');
        // $this->db->join('barang', 'barang.id = target_barang.id_barang', 'left');
        $this->db->join('pembayaran', 'user.id = pembayaran.id_user', 'left');
        $this->db->order_by('created_at', 'desc');
        $this->db->group_by('user.id');
        $data['rows'] = $this->db->get_where('user', ['id_petugas' => $this->session->userdata('id')])->result();
        // $data['rows'] = $this->M_Petugas->getDataPeserta()->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/data_peserta', $data);
        $this->load->view('templates/footer');
    }

    public function data_barang_peserta($id_peserta = null)
    {

        $data['title'] = 'Paket Barang Peserta';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Petugas->getBarangPeserta($id_peserta)->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('peserta/paket_barang', $data);
        $this->load->view('templates/footer');
    }

    public function progres_peserta($id_peserta = null)
    {
        $data['title'] = 'Progres Peserta';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        // $data['peserta'] = $this->db->get_where('user', ['username' => $id_peserta])->row_array();
        $data['rows'] = $this->M_Petugas->getDataProgres($id_peserta)->result();
        $data['harga_barang'] = $this->db->query("SELECT SUM(harga_beli) AS total, SUM(harga) AS harga_barang, tabungan FROM target_barang JOIN barang ON barang.id = target_barang.id_barang JOIN user ON target_barang.id_user = user.id WHERE id_user = $id_peserta")->row();

        $this->db->join('petugas', 'petugas.id_penyelenggara = penyelenggara.id');
        $this->db->join('user', 'user.id_petugas = petugas.id');
        $this->db->where('user.id', $id_peserta);
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('peserta/progres', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_peserta()
    {
        $data['title'] = 'Pembayaran Peserta';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        // $data['peserta'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Petugas->getData()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/pembayaran_peserta', $data);
        $this->load->view('templates/footer');
    }

    public function hapus_pembayaran($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pembayaran');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil dihapus
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
       </div>');
        redirect('petugas/pembayaran_peserta_sukses');
    }


    public function pembayaran_peserta_sukses()
    {
        $data['title'] = 'Pembayaran Peserta';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Petugas->getDataSukses()->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        // $this->db->order_by('tanggal', 'DESC');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/pembayaran_peserta_sukses', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_peserta_sukses_by_tanggal()
    {
        $data['title'] = 'Pembayaran Peserta';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Petugas->getDataSuksesByTanggal()->result();
        $data['penyelenggara'] = $this->db->get('penyelenggara')->row();

        $this->db->order_by('tanggal', 'DESC');

        $data['tgl_awal'] = $this->input->post('tgl_awal');
        $data['tgl_akhir'] = $this->input->post('tgl_akhir');

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/pembayaran_peserta_sukses_by_tanggal', $data);
        $this->load->view('templates/footer');
    }

    public function pembayaran_peserta_batal()
    {
        $data['title'] = 'Pembayaran Peserta';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        $data['rows'] = $this->M_Petugas->getDataCancel()->result();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/pembayaran_peserta_batal', $data);
        $this->load->view('templates/footer');
    }

    public function laporan_setoran()
    {
        $data['title'] = 'Laporan Setoran';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        // $data['rows'] = $this->db->get_where('pembayaran_bulanan', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->result();
        $data['rows'] = $this->M_Petugas->getDataLaporanSukses()->result();
        $data['jumlah'] = $this->M_Petugas->jumlah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/laporan_setoran');
        $this->load->view('templates/footer');
    }

    public function laporan_setoran_batal()
    {
        $data['title'] = 'Laporan Setoran';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
        // $data['rows'] = $this->db->get_where('pembayaran_bulanan', ['nama_lengkap' => $this->session->userdata('nama_lengkap')])->result();
        $data['rows'] = $this->M_Petugas->getDataLaporanCancel()->result();
        $data['jumlah'] = $this->M_Petugas->jumlah();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/laporan_setoran_cancel');
        $this->load->view('templates/footer');
    }

    public function profile()
    {
        $data['title'] = 'Profil Petugas';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/profile');
        $this->load->view('templates/footer');
    }

    public function settings()
    {
        $data['title'] = 'Pengaturan';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_petugas', $data);
        $this->load->view('petugas/settings');
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
            $this->db->update('petugas');

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Profile berhasil diubah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('petugas/settings');
        }
    }

    public function ubah_password()
    {
        $data['title'] = 'Ubah Password';
        $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

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
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('petugas/settings', $data);
            $this->load->view('templates/footer');
        } else {
            $currentPassword = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');

            if (!password_verify($currentPassword, $data['user']['password'])) {
                $this->session->set_flashdata('message_password', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Password lama salah
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                redirect('petugas/settings');
            } else {
                if ($currentPassword == $new_password) {
                    $this->session->set_flashdata('message_password', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Password baru tidak boleh sama dengan password lama
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
                    redirect('petugas/settings');
                } else {
                    // password sudah ok
                    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

                    $this->db->set('password', $password_hash);
                    $this->db->where('username', $this->session->userdata('username'));
                    $this->db->update('petugas');

                    $this->session->set_flashdata('message_password', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    Password berhasil diubah
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>');
                    redirect('petugas/settings');
                }
            }
        }
    }

    public function proses_status($id)
    {
        $this->db->set('status', 'sukses');
        $this->db->where('id', $id);
        $this->db->update('pembayaran');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Pembayaran peserta berhasil di approve
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('petugas/pembayaran_peserta_sukses');
    }

    public function cancel_status($id)
    {
        $no_hp = $this->input->post('no_hp', true);
        $feedback = $this->input->post('feedback', true);

        $dataUpdate = array(
            'status' => 'cancel'
        );

        $this->db->set($dataUpdate);
        $this->db->where('id', $id);
        $this->db->update('pembayaran');

        header("location:https://api.whatsapp.com/send?phone=$no_hp&text=Keterangan:%20$feedback");

        //     $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        //     Status pembayaran berhasil dirubah
        //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        //   </div>');
        //     redirect('petugas/pembayaran_peserta_batal');
    }

    public function pembayaran_offline()
    {
        $this->form_validation->set_rules('id_peserta', 'Nama', 'required|trim', [
            'required' => 'Nama Peserta tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Tanggal tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim', [
            'required' => 'Nominal tidak boleh kosong'
        ]);
        // $data['barang'] = $this->M_Barang->getDataBarang();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Input Pembayaran Peserta';
            $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
            $data['peserta'] = $this->db->get_where('user', ['id_petugas' => $this->session->userdata('id')])->result();
            $tanggal = htmlspecialchars($this->input->post('tanggal', true));
            $penyelenggara = $this->db->get_where('penyelenggara', ['id' => $data['user']['id_penyelenggara']])->row();

            $data['tanggal_minimal'] = $penyelenggara->tanggal_mulai;

            $data['tanggal_maksimal'] = $penyelenggara->tanggal_selesai;

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('petugas/pembayaran_offline', $data);
            $this->load->view('templates/footer');
        } else {
            // validasi sukses
            $this->_insert_pembayaran_offline();
        }
    }

    public function checkNominal()
    {

        $barang = $this->M_Petugas->getBarangPesertaAja($this->input->get('id_peserta'))->result();
        $jml_bayar = 0;
        $total = 0;

        $pembayaran = $this->db->get_where('pembayaran', ['id_user' => $this->input->get('id_peserta')])->row();

        $user = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();

        $penyelenggara = $this->db->get_where('penyelenggara', ['id' => $user['id_penyelenggara']])->row();

        if ($pembayaran) {
            $tanggal_minimal = date('Y-m-d', strtotime('+1 days', strtotime($pembayaran->tanggal)));
        } else {
            $tanggal_minimal = $penyelenggara->tanggal_mulai;
        }

        foreach ($barang as $row) {
            $total += $row->harga;
            $jml_bayar = $row->tabungan + $total;
        }

        if ($pembayaran) {
            $tanggal_awal = $pembayaran->tanggal;
        } else {
            $tanggal_awal = date('Y-m-d', strtotime('-1 days', strtotime($penyelenggara->tanggal_mulai)));
        }
        if ($this->input->get('tanggal')) {
            $jml_hari =  date_diff(date_create($tanggal_awal), date_create($this->input->get('tanggal')));
            $total = $jml_bayar * $jml_hari->days;
        } else {
            $total = $jml_bayar;
        }


        echo json_encode(['nominal' => $total, 'tanggal_minimal' => $tanggal_minimal]);
    }



    public function _insert_pembayaran_offline()
    {
        $bukti = ('Diinput oleh petugas');
        $id_peserta = htmlspecialchars($this->input->post('id_peserta', true));
        $tanggal = htmlspecialchars($this->input->post('tanggal', true));
        $nominal = htmlspecialchars($this->input->post('nominal', true));
        $status = ('sukses');

        $nama_lengkap = $this->db->get_where('user', ['id' => $id_peserta])->row()->nama_lengkap;

        $data = array(
            'bukti' => $bukti,
            'id_user' => $id_peserta,
            'nama_lengkap' => $nama_lengkap,
            'tanggal' => $tanggal,
            'nominal' => $nominal,
            'status' => $status
        );

        $this->db->insert('pembayaran', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
       Input pembayaran berhasil
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        // redirect('petugas/pembayaran_peserta_sukses');
        redirect('petugas/progres_peserta/' . $id_peserta);
    }

    public function pembayaran_bulanan()
    {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim', [
            'required' => 'Tanggal tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('nominal', 'Nominal', 'required|trim', [
            'required' => 'Nominal tidak boleh kosong'

        ]);
        // $this->form_validation->set_rules('bukti', 'Bukti', 'required|trim', [
        //     'required' => 'Bukti tidak boleh kosong'

        // ]);
        // $data['barang'] = $this->M_Barang->getDataBarang();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Upload Setoran';
            $data['user'] = $this->db->get_where('petugas', ['username' => $this->session->userdata('username')])->row_array();
            // $data['rows'] = $this->M_Peserta->getJumlahBayar()->result();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_petugas', $data);
            $this->load->view('petugas/pembayaran_petugas');
            $this->load->view('templates/footer');
        } else {
            // validasi sukses
            $this->proses_pembayaran_bulanan();
        }
    }

    public function proses_pembayaran_bulanan()
    {
        $bukti = $_FILES['bukti'];
        $id_petugas = htmlspecialchars($this->input->post('id_petugas', true));
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
            Pembayaran gagal, pastikan format bukti bayar telah sesuai
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>');
            redirect('petugas/pembayaran_peserta_sukses');
        } else {
            $bukti = $this->upload->data('file_name');
        }

        $data = array(
            'bukti' => $bukti,
            'id_petugas' => $id_petugas,
            'nama_lengkap' => $nama_lengkap,
            'tanggal' => $tanggal,
            'nominal' => $nominal2,
            'status' => $status
        );

        $this->db->insert('pembayaran_bulanan', $data);

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
       Pembayaran berhasil
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('petugas/laporan_setoran');
    }

    public function nonaktif_user($id)
    {
        $this->db->set('status', 'nonaktif');
        $this->db->where('id', $id);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Status peserta berhasil dirubah
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('petugas/data_peserta');
    }

    public function aktif_user($id)
    {
        $this->db->set('status', 'aktif');
        $this->db->where('id', $id);
        $this->db->update('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Status peserta berhasil dirubah
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('petugas/data_peserta');
    }

    public function hapus_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user');

        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Data berhasil dihapus
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>');
        redirect('petugas/data_peserta');
    }

    public function input_peserta()
    {
        date_default_timezone_set('Asia/Jakarta');
        $waktu = date('Y-m-d H:i:s');

        $username = $this->input->post('username', true) == '' ? NULL : $this->input->post('username', true);
        $data = [
            'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
            'alamat' => htmlspecialchars($this->input->post('alamat', false)),
            'no_hp' => htmlspecialchars($this->input->post('no_hp', false)),
            'username' => htmlspecialchars($username),
            'image' => 'default.png',
            // 'password' => $this->input->post('password', true) == '' ? NULL : $this->input->post('password', true),
            'status' => 'nonaktif',
            'tabungan' => $this->input->post('tabungan', true) == '' ? NULL : $this->input->post('tabungan', true),
            'nama_petugas' => htmlspecialchars($this->input->post('nama_petugas', true)),
            'id_petugas' => htmlspecialchars($this->input->post('id_petugas', true)),
            'created_at' => $waktu
        ];

        $this->db->insert('user', $data);
        $id_user = $this->db->insert_id();
        foreach ($this->input->post('id_barang') as $row => $value) {
            $this->db->insert('target_barang', [
                'id_user' => $id_user,
                'id_barang' => $value
            ]);
        }

        $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Data Peserta Berhasil Ditambah
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
        redirect('petugas/data_peserta');
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
        $this->db->update('user');

        header("location:https://api.whatsapp.com/send?phone=$no_hp&text=Username:%20$username%20%0DPassword:%20$password2");
    }
}
