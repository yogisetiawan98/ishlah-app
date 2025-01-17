<?php

class Artikel_admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Artikel_model');
        $this->load->library('session');
        $this->load->model('User_model');
        $this->load->library('upload');
        $this->User_model->keamanan();
    }

    public function index()
    {
        $get = $this->Artikel_model->get();

        $data = array(
            'row' => $get,
            'is_artikel' => true,
            'title' => 'Data Artikel',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        );

        // var_dump($get);
        // die();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('admin/artikel/index', $data);
        $this->load->view('admin/templates/footer');
    }
    public function tambah_artikel()
    {
        $data = array(
            'is_artikel' => true,
            'title' => 'Tambah Artikel',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        );

        // var_dump($get);
        // die();

        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('admin/artikel/tambah_artikel');
        $this->load->view('admin/templates/footer');
    }

    public function detail($id)
    {
        $data = array(
            'is_artikel' => true,
            'title' => 'Detail Artikel',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        );
        // $this->load->model('m_mahasiswa');
        $detail = $this->Artikel_model->detail_data($id);

        $data1['detail'] = $detail;
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('admin/artikel/detail_artikel', $data1);
        $this->load->view('admin/templates/footer');
    }

    // untuk memasukan data ke database
    public function insertdata()
    {
        $judul_artikel            = $this->input->post('judul_artikel');
        $isi_artikel            = $this->input->post('isi_artikel');
        $post_by            = $this->input->post('post_by');

        // get foto
        $config['upload_path'] = './assets/cover_artikel';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $_FILES['fotopost']['name'];

        $this->upload->initialize($config);

        if (!empty($_FILES['fotopost']['name'])) {
            if ($this->upload->do_upload('fotopost')) {
                $foto = $this->upload->data();
                $data = array(
                    'judul_artikel'       => $judul_artikel,
                    'isi_artikel'       => $isi_artikel,
                    'post_by'       => $post_by,
                    'date_created'      => time(),
                    'cover_artikel'       => $foto['file_name']
                );
                $this->Artikel_model->insert($data);
                $this->session->set_flashdata('flash', 'Ditambahkan');
                redirect('artikel_admin/index');
            } else {
                die("gagal upload");
            }
        } else {
            echo "tidak masuk";
        }
    }

    // delete
    public function deletedata($id, $cover_artikel)
    {
        $path = './assets/cover_artikel';
        @unlink($path . $cover_artikel);

        $where = array('id' => $id);
        $this->Artikel_model->delete($where);
        $this->session->set_flashdata('flash_hapus', 'Dihapus');
        return redirect('artikel_admin/index');
    }

    // edit
    public function edit($id)
    {
        // $this->User_model->keamanan();
        $kondisi = array('id' => $id);

        $data = array(
            'is_artikel' => true,
            'title' => 'Data Artikel',
            'user' => $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array()
        );

        $data['data'] = $this->Artikel_model->get_by_id($kondisi);
        $this->load->view('admin/templates/header', $data);
        $this->load->view('admin/templates/topbar', $data);
        $this->load->view('admin/artikel/edit_artikel', $data);
        $this->load->view('admin/templates/footer');
    }

    // update
    public function updatedata()
    {
        $id   = $this->input->post('id');
        $judul_artikel            = $this->input->post('judul_artikel');
        $isi_artikel            = $this->input->post('isi_artikel');
        $post_by            = $this->input->post('post_by');

        $path = './assets/cover_artikel';

        $kondisi = array('id' => $id);

        // get foto
        $config['upload_path'] = './assets/cover_artikel';
        $config['allowed_types'] = 'jpg|png|jpeg|gif';
        $config['max_size'] = '2048';  //2MB max
        // $config['max_width'] = '4480'; // pixel
        // $config['max_height'] = '4480'; // pixel
        $config['file_name'] = $_FILES['fotopost']['name'];

        $this->upload->initialize($config);

        if (!empty($_FILES['fotopost']['name'])) {
            if ($this->upload->do_upload('fotopost')) {
                $foto = $this->upload->data();
                $data = array(
                    'judul_artikel'       => $judul_artikel,
                    'isi_artikel'       => $isi_artikel,
                    'post_by'       => $post_by,
                    'cover_artikel'       => $foto['file_name']
                );
                // hapus foto pada direktori
                @unlink($path . $this->input->post('filelama'));

                $this->Artikel_model->update($data, $kondisi);
                $this->session->set_flashdata('flash', 'Diedit');
                redirect('artikel_admin/index');
            } else {
                die("gagal update");
            }
        } else {
            echo "tidak masuk";
        }
    }
}
