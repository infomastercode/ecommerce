<?php

class ListAttribute {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
    }

    public function getAttributeListTotal($search, $columns, $conditions = array()) {
        return $this->getAttributeList(0, 0, '', $search, $columns, $conditions, true);
    }

    public function getAttributeList($start, $limit, $sorts, $search, $columns = array(), $conditions = array(), $count = false) {

        if ($count) {
            $column_name = column_count();
        } else {

            $column_name = '';

            if (in_array("total", $columns)) {
                $key = array_search('total', $columns);
                unset($columns[$key]);
                $column_name.= "(SELECT count(1) FROM attribute A WHERE A.id_attribute_group = AG.id_attribute_group) AS 'total', ";
            }

            $column_name.= column_implode($columns);
        }

        $sql = "SELECT $column_name FROM attribute_group AG "
                ."INNER JOIN attribute_group_lang AGL ON AG.id_attribute_group = AGL.id_attribute_group "
                ."LEFT JOIN lang L ON AGL.id_lang = L.id_lang "
                ."WHERE 1 ";

        // search
        $columns_unset = array('id_attribute_group');
        $sql.= column_search($search, $columns, $columns_unset);
        unset($columns_unset);

        // order by
        $sql.= order_by_limit($count, $sorts, $start, $limit);
        $query = $this->ci->db->query($sql);
        return ($count) ? $query->row()->total : $query->result_array();
    }

}

// end definition
