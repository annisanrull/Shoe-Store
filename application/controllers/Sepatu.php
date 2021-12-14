<?php
class Sepatu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //cek_login();
    }
    //manajemen Sepatu
    public function index()
    {
        $data['judul'] = 'Data Sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['sepatu'] = $this->ModelSepatu->getSepatu()->result_array();
        $data['kategori'] = $this->ModelSepatu->getKategori()->result_array();
        $this->form_validation->set_rules('nama_sepatu', 'NamaSepatu', 'required|min_length[3]', [
            'required' => 'Nama Sepatu harus diisi',
            'min_length' => 'Nama Sepatu terlalu pendek'
        ]);
        $this->form_validation->set_rules(
            'id_kategori',
            'Kategori',
            'required',
            ['required' => 'kategori harus diisi',]
        );
        $this->form_validation->set_rules(
            'harga',
            'Harga',
            'required|numeric',
            [
                'required' => 'Harga harus diisi',
                'numeric' => 'Yang anda masukan bukan angka'
            ]
        );
        $this->form_validation->set_rules(
            'ukuran',
            'Ukuran',
            'required',
            [
                'required' => 'Ukuran harus diisi',
            ]
        );
        $this->form_validation->set_rules(
            'stok',
            'Stok',
            'required|numeric',
            [
                'required' => 'Stok harus diisi',
                'numeric' => 'Yang anda masukan bukan angka'
            ]
        );
        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();
        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sepatu/index', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                $gambar = $image['file_name'];
            } else {
                $gambar = '';
            }
            $data = [
                'nama_sepatu' => $this->input->post(
                    'nama_sepatu',
                    true
                ),
                'id_kategori' => $this->input->post(
                    'id_kategori',
                    true
                ),
                'harga' => $this->input->post('harga', true),
                'ukuran' => $this->input->post('ukuran', true),
                'stok' => $this->input->post('stok', true),
                'dibeli' => 0,
                'image' => $gambar
            ];
            $this->ModelSepatu->simpanSepatu($data);
            redirect('sepatu');
        }
    }

    public function hapusSepatu()
    {
        $where = ['id' => $this->uri->segment(3)];
        $this->ModelSepatu->hapusSepatu($where);
        redirect('sepatu');
    }


    //manajemen kategori
    public function kategori()
    {
        $data['judul'] = 'Kategori Sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelSepatu->getKategori()->result_array();
        $this->form_validation->set_rules('kategori', 'Kategori', 'required', ['required' => 'Nama Sepatu harus diisi']);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sepatu/kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $data = [
                'kategori' => $this->input->post('kategori')
            ];

            $this->ModelSepatu->simpanKategori($data);
            redirect('sepatu/kategori');
        }
    }

    public function hapusKategori()
    {
        $where = ['id_kategori' => $this->uri->segment(3)];
        $this->ModelSepatu->hapusKategori($where);
        redirect('sepatu/kategori');
    }

    public function ubahSepatu()
    {
        $data['judul'] = 'Ubah Data Sepatu';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['sepatu'] = $this->ModelSepatu->sepatuWhere(['id' => $this->uri->segment(3)])->result_array();
        $kategori = $this->ModelSepatu->joinKategoriSepatu(['sepatu.id' => $this->uri->segment(3)])->result_array();
        foreach ($kategori as $k) {
            $data['id'] = $k['id_kategori'];
            $data['k'] = $k['kategori'];
        }
        $data['kategori'] = $this->ModelSepatu->getKategori()->result_array();
        $this->form_validation->set_rules('nama_sepatu', 'Nama Sepatu', 'required|min_length[3]', [
            'required' => 'Nama Sepatu harus diisi',  'min_length' => 'Nama Sepatu terlalu pendek'
        ]);
        $this->form_validation->set_rules('id_kategori', 'Kategori', 'required', [
            'required' => 'Kategori harus diisi',
        ]);
        $this->form_validation->set_rules(
            'harga',
            'Nomor Harga',
            'required|min_length[3]|numeric',
            [
                'required' => 'Harga harus diisi',
                'numeric' => 'Yang anda masukan bukan angka'
            ]
        );
        $this->form_validation->set_rules(
            'ukuran',
            'Ukuran',
            'required',
            [
                'required' => 'Harga harus diisi',
            ]
        );
        $this->form_validation->set_rules(
            'stok',
            'Stok',
            'required|numeric',
            [
                'required' => 'Stok harus diisi',
                'numeric' => 'Yang anda masukan bukan angka'
            ]
        );
        //konfigurasi sebelum gambar diupload
        $config['upload_path'] = './assets/img/upload/';
        $config['allowed_types'] = 'jpg|png|jpeg';
        $config['max_size'] = '3000';
        $config['max_width'] = '1024';
        $config['max_height'] = '1000';
        $config['file_name'] = 'img' . time();
        //memuat atau memanggil library upload
        $this->load->library('upload', $config);
        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sepatu/ubah_sepatu', $data);
            $this->load->view('templates/footer');
        } else {
            if ($this->upload->do_upload('image')) {
                $image = $this->upload->data();
                unlink('assets/img/upload/' . $this->input->post('old_pict', TRUE));
                $gambar = $image['file_name'];
            } else {
                $gambar = $this->input->post('old_pict', TRUE);
            }
            $data = [
                'nama_sepatu' => $this->input->post('nama_sepatu', true),
                'id_kategori' => $this->input->post('id_kategori', true),
                'harga' => $this->input->post('harga', true),
                'ukuran' => $this->input->post('ukuran', true),
                'stok' => $this->input->post('stok', true),
                'image' => $gambar
            ];
            $this->ModelSepatu->updateSepatu($data, ['id' => $this->input->post('id')]);
            redirect('sepatu');
        }
    }
    public function ubahKategori()
    {
        $data['judul'] = 'Ubah Data Kategori';
        $data['user'] = $this->ModelUser->cekData(['email' => $this->session->userdata('email')])->row_array();
        $data['kategori'] = $this->ModelSepatu->kategoriWhere(['id' => $this->uri->segment(3)])->result_array();


        $this->form_validation->set_rules('kategori', 'Kategori', 'required|min_length[3]', [
            'required' => 'Kategori harus diisi',
            'min_length' => 'Kategori terlalu pendek'
        ]);

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sepatu/ubah_kaegori', $data);
            $this->load->view('templates/footer');
        } else {

            $data = [
                'kategori' => $this->input->post('kategori', true)
            ];

            $this->ModelSepatu->updateKategori(['id' => $this->input->post('id')], $data);
            redirect('sepatu/kategori');
        }
    }
}
