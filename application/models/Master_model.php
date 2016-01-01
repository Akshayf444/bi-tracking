<?php

class Master_model extends MY_model {

    public function __construct() {
        parent::__construct();
    }

    /*  param $result = rows to be converted to dropdown
     *  param $fiedid = primary key of row
     * param $fieldname = name to shown in dropdown
     * */

    function generateDropdown($result, $fieldid, $fieldname, $id = 0) {
        $dropdown = '';
        if (!empty($result)) {
            foreach ($result as $item) {
                if ($id == $item->{$fieldid}) {
                    $dropdown .= '<option value="' . $item->{$fieldid} . '" selected>' . $item->{$fieldname} . '</option>';
                } else {
                    $dropdown .= '<option value="' . $item->{$fieldid} . '" >' . $item->{$fieldname} . '</option>';
                }
            }
        }

        $dropdown .= '';
        return $dropdown;
    }

    function BrandList($Division) {
        $this->db->select('*');
        $this->db->from('Brand_Master');
        $this->db->where('Division', $Division);
        $query = $this->db->get();
        return $query->result();
    }

    function getQuestions($Product_Id = 0) {
        $this->db->select('*');
        $this->db->from('Question_Master');
        $this->db->where('Product_Id', $Product_Id);
        $query = $this->db->get();
        return $query->result();
    }

}
