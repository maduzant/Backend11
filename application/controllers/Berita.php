<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Berita_model','berita');
        
    }

    public function index()
    {

          $data['title'] = 'Produk';
          $data['berita'] = $this->berita->getAllBerita();
    
          $this->load->view('templates/header', $data);
          $this->load->view('templates/sidebar', $data);
          $this->load->view('templates/topbar', $data);
          $this->load->view('berita/index', $data);
          $this->load->view('templates/footer', $data);
      }

      public function tambah()
      {
          $data['title'] = 'Tambah Peminjam';
          $data['berita'] = $this->berita->getAllBerita();

          $this->form_validation->set_rules('judul','Judul Berita', 'required');
          $this->form_validation->set_rules('isi','Isi Berita', 'required');
          $this->form_validation->set_rules('status','Status', 'required');
          $this->form_validation->set_rules('kategori','Kategori', 'required');
         
         

          if($this->form_validation->run() == false) {
              $this->load->view('templates/header', $data);
              $this->load->view('templates/sidebar', $data);
              $this->load->view('templates/topbar', $data);
              $this->load->view('berita/tambah', $data);
              $this->load->view('templates/footer');

          } else {
            $gambar = $_FILES['gambar']['name'];

            if ($gambar = '') {
            } else {
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['max_size']     = '1048';
                $config['upload_path'] = './assets/img/berita/';
                $config['encrypt_name'] = TRUE;

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('gambar')) {
                    $this->session->set_flashdata('message', '
                        <div class="alert alert-danger" role="alert">
                        <i class="fas fa-exclamation-triangle "></i>
                        Berita gagal ditambahkan, cek kembali ukuran gambar dan tipe file gambar!..
                        </div>
                        ');
                    redirect('berita');
                } else {
                    $gambar = $this->upload->data('file_name', true);

                    $data = [
                        "judul" => $this->input->post('judul', true),
                        "isi" => $this->input->post('isi', true),
                        "password" => $this->input->post('password', true),
                        "option" => $this->input->post('option', true),
                        "status" => $this->input->post('status', true),
                        "tanggal" => $this->input->post('tanggal', true),                        
                        "user" => $this->input->post('user', true),
                        "kategori" => $this->input->post('kategori', true),
                        "gambar" => $gambar
                    ];
                }
                $this->berita->tambahBerita($data, 'berita');
                $this->session->set_flashdata('message', '
                <div class="alert alert-success" role="alert">
                <i class="fas fa-check-circle"></i>
                Berita Sukses Ditambahkan!..
                </div>
                ');
                redirect('berita');

          }
      }
    }

    public function view($id)
    {
        $data['title'] = 'View';
        $data['berita'] = $this->berita->getBeritaById($id);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('berita/view', $data);
        $this->load->view('templates/footer');
    }

    public function edit($id)
    {
        $data['title'] = 'Edit ';
        $data['berita'] = $this->berita->getBeritaById($id);
        $data['status'] =  ['draff','publish'];
        $data['kategori'] = ['Kesehatan','Teknologi'];

        $this->form_validation->set_rules('judul','Judul','required');
        $this->form_validation->set_rules('isi','Isi','required');
        $this->form_validation->set_rules('status','Status','required');
        $this->form_validation->set_rules('kategori','Kategori','required');
        $this->form_validation->set_rules('password','password','required');
        
        if($this->form_validation->run()== false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('berita/edit', $data);
            $this->load->view('templates/footer');
        } else {
            $this->berita->editBerita($id);
            $this->session->set_flashdata('message', '
            <div class="alert alert-success mb-1" role="alert">
            <i class="fas fa-check-circle"></i>
            Berita Sukses di Update!
            </div>
            ');
            redirect('berita');


        }

    }

    public function delete($id, $foto)
    {
        $path = './assets/img/berita/';
        if($foto != 'default.jpeg') {
            unlink(FCPATH.$path.$foto);
        }
        $id = [
            'id' => $id
        ];
        $this->berita->deleteData($id);
        $this->session->set_flashdata('message', '
        <div class="alert alert-success mb-1" role="alert">
        <i class="fas fa-check-circle"></i>
        Berita Sukses di Hapus!
        </div>
        ');
    redirect('berita');
    }
}
