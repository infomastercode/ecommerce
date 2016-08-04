<?php

class ListCatalog {

  private $ci;

  public function __construct() {
    $this->ci = & get_instance();
  }

  public function getCategoryListTotal($search, $columns, $conditions = array()) {
    return $this->getCategoryList(0, 0, '', $search, $columns, $conditions, true);
  }

  public function getCategoryList($start, $limit, $sorts, $search, $columns = array(), $conditions = array(), $count = false) {

    if ($count) {
      $column_name = column_count();
    } else {
      $column_name = column_implode($columns);
    }

    $sql = "SELECT $column_name FROM category C "
            . "INNER JOIN category_lang CL ON C.id_category = CL.id_category "
            . "LEFT JOIN lang L ON CL.id_lang = L.id_lang "
            . "WHERE 1 ";

    // condition
    if (isset($conditions['active'])) {
      $active = implode_comma($conditions['active']);
      $sql.= "AND C.active IN ('$active') ";
    } else {
      $sql.= "AND C.active = 1 ";
    }

    // search
    $columns_unset = array('category_id');
    $sql.= column_search($search, $columns, $columns_unset);
    unset($columns_unset);

    // order by
    $sql.= order_by_limit($count, $sorts, $start, $limit);

    $query = $this->ci->db->query($sql);
    return ($count) ? $query->row()->total : $query->result_array();
  }


}

// end definition
