<?php

class BaseContext {

    private $ci;

    public function __construct() {
        $this->ci = & get_instance();
    }

    public function getBaseContextCategory($id_category = '') {
        $sql = "SELECT C.id_category, C.id_parent, C.level_depth, C.is_root_category, "
                ."CL.name, CL.link_rewrite "
                ."FROM category C "
                ."INNER JOIN category_lang CL ON C.id_category = CL.id_category "
                ."LEFT JOIN lang L ON CL.id_lang = L.id_lang "
                ."WHERE C.active = 1 ";
        
        if(!empty($id_category)){
            $sql.= "AND C.id_parent =  $id_category ";
        }

        $sql.= "ORDER BY C.level_depth, C.id_category";

        $query = $this->ci->db->query($sql);
        return $query->result_array();
    }

}

// end definition