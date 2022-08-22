<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kategori_model extends CI_Model
{
    private $table = 'ms_kategori_barang';

    public function rules()
    {
        return [
            [
                'field' => 'Nama',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'kode',
                'label' => 'kode',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'status',
                'label' => 'status',
                'rules' => 'trim'
            ],
        ];
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("kategori_id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function save($dataIns = null)
    {
        return $this->db->insert($this->table, $dataIns);
    }

    public function getWhere($where = null)
    {
        return $this->db->get_where($this->table, $where)->result();
    }
    public function getById($id)
    {
        return $this->db->get_where($this->table, ["kategori_id" => $id])->row();
    }

    public function update($where = null, $data = null)
    {
        return $this->db->update($this->table, $data, $where);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, array('kategori_id' => $id));
    }

    public function getName($nama)
    {
        return $this->db->get_where($this->table, ["kategori_nama" => $nama])->row();
    }
}