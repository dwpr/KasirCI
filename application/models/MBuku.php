<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MBuku extends CI_Model
{

    public $table = 'buku';

    function __construct()
    {
        parent::__construct();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('kdbuku',$id);
        $query = $this->db->get();
        return $query;
    }

    public function insertData($data){
        $this->db->insert($this->table, $data);
    }

    public function getAll($tab){
        //$data = $this->db->from($this->table);
        $data = $this->db->get($tab);
        return $data;
    }

    public function getWhere($tab,$data){
        $this->db->where($data);
        $data = $this->db->get($tab);
        return $data;
    }

    public function bukuupdate($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function deleteData($code,$param,$tab){
        $this->db->where($param, $code);
        $this->db->delete($tab);
    }

}
