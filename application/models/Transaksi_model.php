<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Transaksi_model extends CI_Model
{
    private $table = 'tb_transaksi';

    public function rules()
    {
        return [
            [
                'field' => 'namaBarang',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'jumlah',
                'label' => '',
                'rules' => 'trim|required'
            ],
        ];
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("transaksi_id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function save($dataIns = null)
    {
        $this->db->insert($this->table, $dataIns);
        return $this->db->insert_id();
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