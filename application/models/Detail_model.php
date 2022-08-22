<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Detail_model extends CI_Model
{
    private $table = 'tb_transaksi_detail';

    // public function rules()
    // {
    //     return [
    //         [
    //             'field' => 'namaBarang',
    //             'label' => 'Nama',
    //             'rules' => 'trim|required'
    //         ],
    //         [
    //             'field' => 'jumlah',
    //             'label' => '',
    //             'rules' => 'trim|required'
    //         ],
    //     ];
    // }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("transaksi_detail_id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function save($dataIns = null)
    {
        return $this->db->insert($this->table, $dataIns);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["transaksi_id" => $id])->row();
    }

    public function update($where = null, $data = null)
    {
        return $this->db->update($this->table, $data, $where);
    }
    
    public function delete($id)
    {
        $this->db->delete($this->table, array('transaksi_id' => $id));
    }
}