<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // if($this->session->userdata('email')){
        //     redirect('')
        // }
    }
    public function index()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);
        // $data['barang'] = $this->M_Barang->getDataBarang();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login Penyelenggara';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login_penyelenggara', $data);
            $this->load->view('templates/auth_footer');
        } else {
            // validasi sukses
            $this->proses_login_penyelenggara();
        }
    }

    private function proses_login_penyelenggara()
    {
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('penyelenggara', ['username' => $username])->row_array();

        if ($user) {
            // cek password
            if (password_verify($password, $user['password'])) {
                $data = [
                    'username' => $user['username'],
                    'id' => $user['id']
                ];
                $this->session->set_userdata($data);
                redirect('penyelenggara');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Password salah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Username tidak terdaftar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('auth');
        }
    }

    public function registrasi_penyelenggara()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username sudah terdaftar',
            'required' => 'Username tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[6]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Minimal password 6 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password1]', [
            'required' => 'Konfirmasi Password tidak boleh kosong',
            'matches' => 'Konfirmasi Password salah!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi Penyelenggara';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi_penyelenggara');
            $this->load->view('templates/auth_footer');
        } else {
            $username = $this->input->post('username', true);
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'username' => htmlspecialchars($username),
                'alamat' => htmlspecialchars($this->input->post('alamat', false)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', false)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT)
            ];

            $this->db->insert('penyelenggara', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Registrasi akun berhasil, Silahkan login!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>');
            redirect('auth');
        }
    }

    public function utama()
    {
        $data['title'] = 'Aplikasi SuMas';

        // $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/halaman_utama', $data);
        // $this->load->view('templates/auth_footer');
    }

    public function tentang()
    {
        $data['title'] = 'Tentang';

        // $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/tentang', $data);
        // $this->load->view('templates/auth_footer');
    }

    public function kontak()
    {
        $data['title'] = 'kontak';

        // $this->load->view('templates/auth_header', $data);
        $this->load->view('auth/kontak', $data);
        // $this->load->view('templates/auth_footer');
    }

    // peserta
    public function login_peserta()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);
        // $data['barang'] = $this->M_Barang->getDataBarang();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login peserta';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login_peserta', $data);
            $this->load->view('templates/auth_footer');
        } else {
            // validasi sukses
            $this->proses_login_peserta();
        }
    }

    private function proses_login_peserta()
    {
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();

        if ($user) {
            // cek status
            if ($user['status'] == 'aktif') {

                // cek password
                if (password_verify($password, $user['password'])) {

                    $jml_barang = $this->db->get_where('target_barang', ['id_user' => $user['id']])->num_rows();
                    if ($jml_barang > 0) {
                        $data = [
                            'id' => $user['id'],
                            'username' => $user['username']
                        ];
                        $this->session->set_userdata($data);

                        $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Berhasil login pada tanggal <b>' . date("d M Y") . '</b> jam <b>' . date("H:i:s") . '</b>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>');
                        redirect('peserta');
                    } else {
                        redirect('auth/pilih_barang/' . $user['id']);
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Password salah.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');
                    redirect('auth/login_peserta');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Akun anda belum diaktivasi oleh petugas
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                redirect('auth/login_peserta');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Username tidak terdaftar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('auth/login_peserta');
        }
    }

    public function pilih_barang($id_user = null)
    {
        $this->form_validation->set_rules('id_barang[]', 'Barang', 'required', [
            'required' => 'Barang tidak boleh kosong'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Pilih Paket Lebaran';
            $data['barang'] = $this->db->get('barang')->result();
            $data['user'] = $this->db->get_where('user', ['id' => $id_user])->row();

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/pilih_barang', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $jumlah = $this->input->post('jumlah');
            foreach ($this->input->post('id_barang') as $key => $value) {
                for ($x = 1; $x <= $jumlah[$value - 1]; $x++) {

                    $this->db->insert('target_barang', [
                        'id_user' => $this->input->post('id_user'),
                        'id_barang' => $value
                    ]);
                }
            }
            if (!empty($this->input->post('tabungan'))) {
                $this->db->where('id', $this->input->post('id_user'));
                $this->db->update('user', [
                    'tabungan' => $this->input->post('tabungan')
                ]);
            }
            $user = $this->db->get_where('user', ['id' => $id_user])->row_array();
            $data = [
                'id' => $user['id'],
                'username' => $user['username']
            ];

            $this->session->set_userdata($data);
            $this->session->set_flashdata('message', '
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                Pilih Barang Berhasil
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>');

            redirect('peserta');
        }
    }

    public function registrasi_peserta()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username sudah terdaftar',
            'required' => 'Username tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[6]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Minimal password 6 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password1]', [
            'required' => 'Konfirmasi Password tidak boleh kosong',
            'matches' => 'Konfirmasi Password salah!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi peserta';
            $data['barang'] = $this->db->get('barang')->result();

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi_peserta', $data);
            $this->load->view('templates/auth_footer');
        } else {
            $username = $this->input->post('username', true);
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'username' => htmlspecialchars($username),
                'alamat' => htmlspecialchars($this->input->post('alamat', false)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', false)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'status' => 'nonaktif',
                // 'id_barang' => htmlspecialchars(),
                'tabungan' => $this->input->post('tabungan', true) == '' ? NULL : $this->input->post('tabungan', true)
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
            Registrasi Akun Berhasil
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('auth/login_peserta');
        }
    }

    // petugas
    public function login_petugas()
    {
        $this->form_validation->set_rules('username', 'Username', 'required|trim', [
            'required' => 'Username tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|trim', [
            'required' => 'Password tidak boleh kosong'
        ]);
        // $data['barang'] = $this->M_Barang->getDataBarang();
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login petugas';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login_petugas', $data);
            $this->load->view('templates/auth_footer');
        } else {
            // validasi sukses
            $this->proses_login_petugas();
        }
    }

    private function proses_login_petugas()
    {
        date_default_timezone_set('Asia/Jakarta');
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('petugas', ['username' => $username])->row_array();

        if ($user) {
            if ($user['status'] == 'aktif') {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'id' => $user['id'],
                        'username' => $user['username'],
                        'nama_lengkap' => $user['nama_lengkap']
                    ];
                    $this->session->set_userdata($data);
                    redirect('petugas');
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                Password salah.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                    redirect('auth/login_petugas');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                Akun belum diaktivasi oleh penyelenggara
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>');
                redirect('auth/login_petugas');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-warning alert-dismissible fade show" role="alert">
            Username tidak terdaftar.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('auth/login_petugas');
        }
    }

    public function registrasi_petugas()
    {
        $this->form_validation->set_rules('nama_lengkap', 'Nama Lengkap', 'required|trim', [
            'required' => 'Nama tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username sudah terdaftar',
            'required' => 'Username tidak boleh kosong'
        ]);
        $this->form_validation->set_rules('password1', 'Password1', 'required|trim|min_length[6]', [
            'required' => 'Password tidak boleh kosong',
            'min_length' => 'Minimal password 6 karakter!'
        ]);
        $this->form_validation->set_rules('password2', 'Password2', 'required|trim|matches[password1]', [
            'required' => 'Konfirmasi Password tidak boleh kosong',
            'matches' => 'Konfirmasi Password salah!'
        ]);

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Registrasi petugas';

            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registrasi_petugas');
            $this->load->view('templates/auth_footer');
        } else {
            $username = $this->input->post('username', true);
            $data = [
                'nama_lengkap' => htmlspecialchars($this->input->post('nama_lengkap', true)),
                'username' => htmlspecialchars($username),
                'alamat' => htmlspecialchars($this->input->post('alamat', false)),
                'no_hp' => htmlspecialchars($this->input->post('no_hp', false)),
                'image' => 'default.png',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'status' => 'nonaktif'
            ];

            $this->db->insert('petugas', $data);

            $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Registrasi berhasil, silahkan login!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>');
            redirect('auth/login_petugas');
        }
    }

    public function logout()
    {
        // $this->session->unset_userdata('email');
        // $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success alert-dismissible fade show" role="alert">
        Anda berhasil logout!
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        redirect('auth/utama');
    }
}
