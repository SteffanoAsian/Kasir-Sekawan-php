<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Keranjang_model extends CI_Model
{
    private $table = 'tb_keranjang';

    // public function rules()
    // {
    //     return [
    //         [
    //             'field' => 'Nama',
    //             'label' => 'Nama',
    //             'rules' => 'trim|required'
    //         ],
    //         [
    //             'field' => 'jumlah',
    //             'label' => 'jumlah',
    //             'rules' => 'trim|required'
    //         ],
    //     ];
    // }

    public function getAll($where=null)
    {
        return $this->db
            ->join("ms_barang",'barang_id=keranjang_barang_id')
            ->join("ms_kategori_barang",'barang_kategori_id=kategori_id')
            ->order_by("barang_id", "desc")
            ->get_where($this->table, $where)
            ->result();
    }

    public function save($dataIns = null)
    {
        return $this->db->insert($this->table, $dataIns);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["keranjang_id" => $id])->row();
    }

    public function update($where = null, $data = null)
    {
        return $this->db->update($this->table, $data, $where);
    }
    
    public function delete($id)
    {
        $this->db->delete($this->table, array('keranjang_id' => $id));
    }
    
    public function getWhere($where = null)
    {
        return $this->db->get_where($this->table, $where)->result();
    }

    public function deleteAll(){
        return $this->db->empty_table($this->table);
    }
}