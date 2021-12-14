<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ModelSepatu extends CI_Model
{
    //manajemen sepatu
    public function getSepatu()
    {
        return $this->db->get('sepatu');
    }

    public function sepatuWhere($where)
    {
        return $this->db->get_where('sepatu', $where);
    }

    public function simpanSepatu($data = null)
    {
        $this->db->insert('sepatu', $data);
    }

    public function updateSepatu($data = null, $where = null)
    {
        $this->db->update('sepatu', $data, $where);
    }

    public function hapusSepatu($where = null)
    {
        $this->db->delete('sepatu', $where);
    }

    public function total($field, $where)
    {
        $this->db->select_sum($field);
        if (!empty($where) && count($where) > 0) {
            $this->db->where($where);
        }
        $this->db->from('sepatu');
        return $this->db->get()->row($field);
    }

    //manajemen kategori
    public function getKategori()
    {
        return $this->db->get('kategori');
    }

    public function kategoriWhere($where)
    {
        return $this->db->get_where('kategori', $where);
    }

    public function simpanKategori($data = null)
    {
        $this->db->insert('kategori', $data);
    }

    public function hapusKategori($where = null)
    {
        $this->db->delete('kategori', $where);
    }

    public function updateKategori($where = null, $data = null)
    {
        $this->db->update('kategori', $data, $where);
    }

    //join
    public function joinKategoriSepatu($where)
    {
        // $this->db->select('sepatu.id_kategori, kategori.kategori');
        $this->db->from('sepatu');
        $this->db->join('kategori', 'kategori.id_kategori =sepatu.id_kategori');
        $this->db->where($where);
        return $this->db->get();
    }
    public function getLimitSepatu()
    {
        $this->db->limit(5);
        return $this->db->get('sepatu');
    }  
}