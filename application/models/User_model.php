<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_Model
{
    private $table = 'ms_user';

    public function rules()
    {
        return [
            [
                'field' => 'Nama',
                'label' => 'Nama',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'Username',
                'label' => 'Username',
                'rules' => 'trim|required'
            ],
            [
                'field' => 'Role',
                'label' => 'Role',
                'rules' => 'trim|required'
            ],
        ];
    }

    public function getAll()
    {
        $this->db->from($this->table);
        $this->db->order_by("user_id", "desc");
        $query = $this->db->get();
        return $query->result();
    }

    public function save($dataIns = null)
    {
        return $this->db->insert($this->table, $dataIns);
    }

    public function getById($id)
    {
        return $this->db->get_where($this->table, ["user_id" => $id])->row();
    }

    public function update($where = null, $data = null)
    {
        return $this->db->update($this->table, $data, $where);
    }

    public function delete($id)
    {
        $this->db->delete($this->table, array('user_id' => $id));
    }
    
    public function getWhere($where = null)
    {
        return $this->db->get_where($this->table, $where)->result();
    }
}