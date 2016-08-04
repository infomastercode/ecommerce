<?php

class Attribute_model extends CI_Model {

    public function addAttribute($data) {
        //echo '<pre>'; print_r($data); exit;
        $today = datetime_today();

        $attr_group = array();
        $attr_group['is_color_group'] = '';
        $attr_group['group_type'] = '';
        $attr_group['position'] = 0;
        $this->db->insert('attribute_group', $attr_group);
        $id_attribute_group = $this->db->insert_id();

        $attr_group_lang = array();
        $attr_group_lang['id_attribute_group'] = 1;
        $attr_group_lang['id_lang'] = 1;
        $attr_group_lang['name'] = $data['name'];
        $attr_group_lang['public_name'] = $data['name'];
        $this->db->insert('attribute_group_lang', $attr_group_lang);

        ////////////////////////////////////////////////////////////////////

        foreach ($data['detail'] as $attribute) {
            $attr = array();
            $attr['id_attribute_group'] = $id_attribute_group;
            $attr['color'] = '';
            $attr['position'] = '';
            $id_attribute = $this->db->insert('attribute', $attr);

            $attr_lang = array();
            $attr_lang['id_attribute'] = $id_attribute;
            $attr_lang['id_lang'] = 1;
            $attr_lang['name'] = $attribute['name'];
            $this->db->insert('attribute_lang', $attr_lang);
        }
        
        return $id_attribute_group;
    }

    public function editAttribute($data) {
//    //echo '<pre>'; print_r($data); exit;
//    $purchase_id = $data['purchase_id'];
//    $today = date("Y-m-d H:i:s");
//
//    $data_upd = array();
//    $data_upd['purchase_date'] = date_str_replace($data['purchase_date']);
//    $data_upd['delivery_date'] = !empty($data['delivery_date']) ? date_str_replace($data['delivery_date']) : null;
//    $data_upd['currency'] = $data['currency'];
//    $data_upd['shipping'] = $data['shipping'];
//    $data_upd['payment'] = $data['payment'];
//    $data_upd['carrier'] = $data['carrier'];
//    $data_upd['comment'] = $data['comment'];
//    $data_upd['vendor_id'] = $data['vendor_id'];
//    $data_upd['vendor_delivery_id'] = $data['vendor_delivery_id'];
//    $data_upd['store_id'] = $data['store_id'];
//    $data_upd['store_delivery_id'] = $data['store_delivery_id'];
//    $data_upd['type'] = $data['type'];
//    $data_upd['status'] = Agent::STATUS_MASTER_OPEN;
//    $data_upd['active'] = 1;
//    $data_upd['date_upd'] = $today;
//    $this->db->where('purchase_id', $purchase_id);
//    $this->db->update(DB_PREFIX.'purchase', $data_upd);
//
//    $detail_id = array();
//    $line_no = 1;
//    foreach ($data['detail'] as $key => $value) {
//      $data_det = array();
//      $data_det['purchase_id'] = $purchase_id;
//      $data_det['product_id'] = $value['product_id'];
//      $data_det['line_no'] = $line_no;
//      $data_det['qty'] = $value['qty'];
//      $data_det['unit'] = $value['unit'];
//      $data_det['unit_cost'] = $value['unit_cost'];
//      $data_det['status'] = Agent::STATUS_DETAIL_OPEN;
//      $data_det['date_upd'] = $today;
//      $line_no = $line_no + 1;
//
//      if (!empty($value['purchase_detail_id'])) {
//	$purchase_detail_id = $value['purchase_detail_id'];
//	$this->db->where('purchase_detail_id', $purchase_detail_id); // condition for update.
//	$this->db->update(DB_PREFIX.'purchase_detail', $data_det);
//      } else {
//	$data_det['date_add'] = $today; // add detail
//	$this->db->insert(DB_PREFIX.'purchase_detail', $data_det);
//	$purchase_detail_id = $this->db->insert_id();
//      }
//      
//      $detail_id[$key] = $purchase_detail_id; // for not delete or update detail.
//    }
//
//    if (!empty($detail_id)) {
//      $detail_id = implode(',', $detail_id);
//      $sql = "DELETE FROM purchase_detail WHERE purchase_id = $purchase_id AND purchase_detail_id NOT IN ($detail_id) ";
//      $this->db->query($sql); // delete not exists.
//    }
//
//    unset($data_upd);
//    unset($data_det);
//
//    return $purchase_id;
    }

    public function deleteAttribute($purchase_id) {
//    $purchase_id = implode(',', $purchase_id);
//    $sql = "UPDATE purchase SET active = 0, status = '".Agent::STATUS_MASTER_DELETE."', date_upd = '".date("Y-m-d H:i:s")."' ";
//    $sql.= "WHERE purchase_id IN ($purchase_id) ";
//    $this->db->query($sql);
//    return $this->db->affected_rows();
    }

}

// end definition