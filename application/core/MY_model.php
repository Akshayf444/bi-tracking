<?php

class MY_model extends CI_Model {

    const TABLE_PK = 'abstract';
    const TABLE_NAME = 'abstract';

    public function __construct() {
        parent::__construct();
    }

    private function insert() {
        $this->db->insert($this::TABLE_NAME, $this);
        return $this->db->insert_id();
    }

    public function update() {
        $this->db->where('');
        $this->db->update();
    }

}
