<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Barang_model extends CI_Model
{
    private $table = 'ms_barang';

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
                'field' => 'kategori',
                'label' => 'kategori',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'harga',
                'label' => 'harga',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'status',
                'label' => 'status',
                'rules' => 'trim|required'
            ],
        ];
    }

    public function getAll()
    {
        return $this->db
            ->join("ms_kategori_barang",'barang_kategori_id=kategori_id')
            ->order_by("barang_id", "desc")
            ->get($this->table)
            ->result();
    }

    public function save($dataIns = null)
    {
        return $this->db->insert($this->table, $dataIns);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["barang_id" => $id])->row();
    }

    public function update($where = null, $data = null)
    {
        return $this->db->update($this->table, $data, $where);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, array('barang_id' => $id));
    }

    public function getWhere($where = null)
    {
        return $this->db->get_where($this->table, $where)->result();
    }
}