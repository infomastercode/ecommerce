<?php

function table_checkbox($identifier, $check = false) {
  $checked = ($check) ? 'checked' : '';
  return "<input type='checkbox' name='selected[]' class='selected' value='$identifier' $checked >";
}

function table_date($date) {
  return date("d-m-Y", strtotime($date));
}

function table_option($redirect, $identifier, $options = array()) {
  $html = '';
  foreach ($options as $option) {

    if ($option == 'edit') {
      $btn_class = "btn btn-primary btn-sm";
      $icon = "<i class='fa fa-pencil'></i>";
    } else if ($option == 'delete') {
      
    } else if ($option == 'view') {
      
    } else {
      
    }

    $url = $redirect."/".$option."/".$identifier;

    $html.= "<a href='$url' data-toggle='tooltip' title='$option' class='$btn_class'>$icon</a> ";
  }

  return $html;
}

function table_active($active) {
  if ($active == Agent::ACTIVE) {
    return Agent::ACTIVE_MSG;
  } else if ($active == Agent::INACTIVE) {
    return Agent::INACTIVE_MSG;
  }
}

function table_image($image) {
  if (empty($image)) {
    $image = DEFAULT_IMAGE;
  }
  return "<img src=".$image." width='32' class='img-thumbnail'>";
}

function table_view_purchase($purchase_id) {
  return "<button onclick='view_detail_purchase($purchase_id)' class='btn btn-primary btn-sm' type='button'><i class='fa fa-file-text-o'></i></button>";
}

function tableRadioOnclick($param_id, $check = false, $event = '') {
  $checked = $check ? 'checked' : '';
  $event = !empty($event) ? 'onclick='.$event.'($(this))' : '';
  return "<input type='radio' name='checked' class='selected' value=".$param_id." $checked $event >";
}

function organizationButtonSelect($function, $org_id, $org_no, $company) {
  return "<button onclick=$function('$org_id','$org_no','$company') type='button' data-toggle='tooltip' title='select' data-dismiss='modal' class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i></td>";
}

function partButtonSelect($function, $product_id, $param1 = '', $param2 = '') {

  if (!empty($param2) && !empty($param1)) {
    $event = $function.'(\''.$product_id.'\',\''.$param1.'\',\''.$param2.'\')';
  } else if (!empty($param1)) {
    $event = $function.'(\''.$product_id.'\',\''.$param1.'\')';
  } else {
    $event = $function.'(\''.$product_id.'\')';
  }

  return "<button onclick=$event type='button' data-dismiss='modal' data-toggle='tooltip' title='Select' class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i>";
}

function locationButtonSelect($function, $location_id, $location) {
  return "<button onclick=$function('$location_id','$location') type='button' data-toggle='tooltip' title='Select' data-dismiss='modal' class='btn btn-primary btn-sm'><i class='fa fa-pencil'></i></td>";
}

//function langs($language_key, $str1 = '', $str2 = '', $str3 = '') {
//
//  if (empty(lang($language_key))) {
//    log_message('error', 'Could not file the language line '.$language_key);
//    return $language_key;
//  }
//
//  if (empty($str1) && empty($str2) && empty($str3)) {
//    return lang($language_key);
//  }
//
//  if (!empty($str1) && !empty($str2) && !empty($str3)) {
//    return sprintf(lang($language_key), $str1, $str2, $str3);
//  }
//
//  if (!empty($str1) && !empty($str2)) {
//    return sprintf(lang($language_key), $str1, $str2);
//  }
//
//  return sprintf(lang($language_key), $str1);
//}

function in_set($status, $output, $optional = null) {
  if (isset($optional) && !empty($optional)) {
    return array('status' => $status, 'output' => $output, 'optional' => $optional);
  }
  return array('status' => $status, 'output' => $output);
}

function status($status) {
  if ($status == 'E') {
    return Agent::ERROR;
  }
  return Agent::SUCCESS;
}

//function message($language_key, $str1 = '', $str2 = '') {
//
//  if (empty(lang($language_key))) {
//    log_message('error', 'Could not file the language line '.$language_key);
//    return $language_key;
//  }
//
//  if (!empty($str1) && !empty($str2)) {
//    return sprintf(lang($language_key), $str1, $str2);
//  } else if (!empty($str1)) {
//    return sprintf(lang($language_key), $str1);
//  } else {
//    return lang($language_key);
//  }
//}

function set_out($flag, $output, $str1 = '') {

  if ($flag == 'S') {
    $status = Agent::SUCCESS;
  } else {
    $status = Agent::ERROR;
  }

  if (!empty($str1)) {
    $output = sprintf(lang($output), $str1);
  } else {
    $output = lang($output);
  }

  return array('status' => $status, 'output' => $output);
}

function date_str_replace($date) {
  if (empty($date)) {
    return null;
  }
  $str_date = str_replace('/', '-', $date);
  return date('Y-m-d', strtotime($str_date));
}

function date_str($date) {
  return !empty($date) ? date('Y-m-d', strtotime($date)) : null;
}

function datetime_str_replace($date) {
  if (empty($date)) {
    return null;
  }
  $str_date = str_replace('/', '-', $date);
  return date('Y-m-d H:i:s', strtotime($str_date));
}

function datetime_str($date, $replace = null) {
  return !empty($date) ? date("d-m-Y H:i:s", strtotime($date)) : $replace;
}

function datetime_today() {
  return date("Y-m-d H:i:s");
}

function image_default($image) {
  return !empty($image) ? $image : DEFAULT_IMAGE;
}

function set_grade($grade) {

  if ($grade == Agent::GRADE_NORMAL) {
    $grade_msg = Agent::GRADE_MSG_NORMAL;
  } else if ($grade == Agent::GRADE_MSG_DAMAGE) {
    $grade_msg = Agent::GRADE_MSG_DAMAGE;
  } else {
    $grade_msg = '';
  }

  return $grade_msg;
}

function order_by_limit($count, $sorts, $start, $limit) {

  $sql = '';

  if ($count) {
    return $sql;
  }

  $sql = '';
  if (!empty($sorts)) {

    $order_by = key($sorts);
    $key = reset($sorts);

    if ($key == 1) {
      $sort = "DESC";
    } else {
      $sort = "ASC";
    }


    $sql.= "ORDER BY $order_by $sort ";
  }

  if (!empty($limit)) {
    $sql.= "LIMIT ".$start.", ".$limit;
  }

  return $sql;
}

function column_search($search = '', $columns = array(), $columns_unset = array()) {
  $sql = '';

  if (empty($search)) {
    return $sql;
  }

  foreach ($columns as $key => $column) {
    $value = array_search($column, $columns_unset); // return key array > 0
    if ($value === 0 || !empty($value)) {
      // not do anything.
    } else {
      $index_like[$key] = $column." LIKE '%".$search."%'";
    }
  }

  $sqlsearch = implode(' OR ', $index_like);
  $sql .= "AND (".$sqlsearch.")";

  return $sql;
}

function column_all() {
  return '*';
}

function column_count() {
  return "count(1) as 'total'";
}

function column_implode($columns) {
  return implode(',', $columns);
}

function implode_comma($data) {
  return implode(',', $data);
}

function implode_comma_quote($data) {
  return "'".implode("','", $data)."'";
}

function offset_dyna($value) {

  $data = array(
      isset($value['queries']['search']) ? $value['queries']['search'] : '',
      isset($value['sorts']) ? $value['sorts'] : '',
      $value['perPage'],
      $value['offset']
  );

//  $search = isset($value['queries']['search']) ? $value['queries']['search'] : '';
//  $sorts = isset($value['sorts']) ? $value['sorts'] : '';
//  //$page = $value['page'];
//  $limit = $value['perPage'];
//  $start = $value['offset'];

  return $data;
}

function in_empty($data, $replace = '') {
  return !empty($data) ? $data : $replace;
}

function set_image($result_id, $img_dir_name) {
  $setimage = array('path' => $img_dir_name, 'img_default' => $img_dir_name.'_default_', 'img_medium' => $img_dir_name.'_medium_', 'img_small' => $img_dir_name.'_small_');
  $url_small = Container::uploadImage($result_id, $setimage);
  return $url_small;
}

function string_html($html){
    return htmlspecialchars($html);
}