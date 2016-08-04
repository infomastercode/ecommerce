<?php

class Product extends CI_Controller {

    private $base_url;
    private $base_context;

    public function __construct() {
        parent::__construct();

        $this->base_url = URL_BASE.'/admin/catalog/product';
        $this->base_context = new BaseContext();
    }

    public function index() {
        $this->getList();
    }

    public function add() {
        if ($this->input->post()) {
            $value = $this->input->post();
            echo '<pre>'; print_r($value); exit;
//            $product_id = $this->product_model->addProduct($value);
//
//            if (!empty($_FILES['userfile']['name'])) {
//                $this->setImage($product_id);
//            }
//
//            if ($value['save'] == 'save') {
//                redirect($this->base_url, 'refresh');
//            } else {
//                $this->getFormData($product_id); // save stay
//                return;
//            }
        }
        $this->getForm();
    }

    public function edit() {
        
    }

    public function delete() {
        
    }

    private function getList() {
        $data = $this->initForm();
        $data['action'] = '#';
        $data['add'] = $this->base_url.'/add';
        $data['delete'] = $this->base_url.'/delete';
        $data['selector'] = array(Agent::SELECTOR_ADD, Agent::SELECTOR_DELETE);


        $data['load_js'] = array('additional/admin/catalog/product_list');
        $data['load_page'] = 'theme/admin/catalog/product_list';
        $this->load->view('layout/admin/pattern', $data);
    }

    public function getListRecord() {
        if ($this->input->post()) {

            $value = $this->input->post();
            $offset = offset_dyna($value);
            list($search, $sorts, $limit, $start) = $offset;

            $columns = array('product_id', 'image_small', 'reference', 'product_name', 'date_add');
            $conditions = array();
            $data = array();
            $data['queryRecordCount'] = $this->list_part->getProductListTotal($search, $columns, $conditions);
            $data['totalRecordCount'] = $data['queryRecordCount'];
            $data['records'] = array();
            $results = $this->list_part->getProductList($start, $limit, $sorts, $search, $columns, $conditions);

            $tmp = array();
            foreach ($results as $key => $result) {
                $tmp['row'] = $start + ($key + 1);
                $tmp['product_id'] = $result['product_id'];
                $tmp['checkbox'] = table_checkbox($result['product_id']);
                $tmp['image_small'] = table_image($result['image_small']);
                $tmp['reference'] = $result['reference'];
                $tmp['product_name'] = $result['product_name'];
                $tmp['date_add'] = table_date($result['date_add']);
                $tmp['option'] = table_option($this->base_url, $result['product_id'], array('edit'));

                array_push($data['records'], $tmp);
            }

            echo json_encode($data);
        }
    }

    private function getForm() {
        $data = $this->initForm();
        $data['action'] = $this->base_url.'/add';
        $data['cancel'] = $this->base_url;

        $this->rendorForm($data);
    }

    private function initForm() {
        $data = array();
        $data['sub_menu'] = 'product';
        $data['text_title'] = 'Products';
        $data['text_panel_title'] = 'Products List';
        $data['form_form'] = 'form_product';
        $data['today'] = date("d-m-Y");
        return $data;
    }

    private function rendorForm($data) {
        $data['selector'] = array(Agent::SELECTOR_SAVE, Agent::SELECTOR_SAVE_STAY, Agent::SELECTOR_CANCEL);
        $data['load_js'] = array('additional/admin/catalog/product_form');
        $data['load_page'] = 'theme/admin/catalog/product_form';
        $this->load->view('layout/admin/pattern', $data);
    }

    public function getCategory() {

        $htmls = array();
        $str = '';
        $str1 = '';
        $str2 = '';

        $results = $this->base_context->getBaseContextCategory();

        foreach ($results as $result) {
            $level_depth = $result['level_depth'];
            $id_category = $result['id_category'];
            $id_parent = $result['id_parent'];

            $categories_level[$level_depth][$id_category] = $result;
            $categories[$id_category] = $result;
            $max_level = $result['level_depth'];
        }

        $str.= "<ul>";
        foreach ($categories as $category) {
            $id_category = $category['id_category'];
            $id_parent = $category['id_parent'];
            $level_depth = $category['level_depth'];

            if ($id_parent != 0) {
                continue;
            }

            $str1.= "<li><input type='checkbox' name='id_parent[]' value='{$category['id_category']}' >{$category['name']}</li>";

            $str2 = '';
            foreach ($categories as $in_category) {
                $in_id_category = $in_category['id_category'];
                $in_id_parent = $in_category['id_parent'];
                $in_level_depth = $in_category['level_depth'];

                if ($id_category != $in_id_category) {
                    if ($id_category == $in_id_parent) {
                        $str2.= "<li><input type='checkbox' name='id_parent[]' value='{$in_category['id_category']}' >{$in_category['name']}</li>";
                    }
                }
            } // end loop 2

            if (!empty($str2)) {
                $str1.= "<ul>".$str2."</ul>";
            }
        } // end loop 1
        $str.= $str1;
        $str.= "</ul>";

        echo json_encode($str);
    }

}
