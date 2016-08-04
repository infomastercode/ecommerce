<?php

class Attribute extends CI_Controller {

    private $base_url;
    private $list_attribute;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/catalog/attribute_model');
        $this->load->library('list/ListAttribute');
        
        $this->base_url = URL_BASE.'/admin/catalog/attribute';
        $this->list_attribute = new ListAttribute();
    }

    public function index() {
        $this->getList();
    }

    public function add() {
        if ($this->input->post()) {
            $value = $this->input->post();
            //echo '<pre>'; print_r($value); exit;
            $attribute_id = $this->attribute_model->addAttribute($value);

            if ($value['save'] == 'save') {
                redirect($this->base_url, 'refresh');
            } else {
                $this->getFormData($attribute_id); // save stay
                return;
            }
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


        $data['load_js'] = array('additional/admin/catalog/attribute_list');
        $data['load_page'] = 'theme/admin/catalog/attribute_list';
        $this->load->view('layout/admin/pattern', $data);
    }

    public function getListRecord() {
        if ($this->input->post()) {

            $value = $this->input->post();
            $offset = offset_dyna($value);
            list($search, $sorts, $limit, $start) = $offset;

            $columns = array('AG.id_attribute_group', 'AGL.name', 'total');
            $conditions = array();
            $data = array();
            $data['queryRecordCount'] = $this->list_attribute->getAttributeListTotal($search, $columns, $conditions);
            $data['totalRecordCount'] = $data['queryRecordCount'];
            $data['records'] = array();
            $results = $this->list_attribute->getAttributeList($start, $limit, $sorts, $search, $columns, $conditions);
            //echo '<pre>'; print_r($results); exit;

            $tmp = array();
            foreach ($results as $key => $result) {
                $tmp['row'] = $start + ($key + 1);
                $tmp['id_attribute_group'] = $result['id_attribute_group'];
                $tmp['checkbox'] = table_checkbox($result['id_attribute_group']);
                $tmp['name'] = $result['name'];
                $tmp['total'] = $result['total'];
                $tmp['option'] = table_option($this->base_url, $result['id_attribute_group'], array('edit'));

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
        $data['sub_menu'] = 'attribute';
        $data['text_title'] = 'Attribute';
        $data['text_panel_title'] = 'Attribute List';
        $data['form_form'] = 'form_attribute';
        $data['today'] = date("d-m-Y");
        return $data;
    }

    private function rendorForm($data) {
        $data['selector'] = array(Agent::SELECTOR_SAVE, Agent::SELECTOR_SAVE_STAY, Agent::SELECTOR_CANCEL);
        $data['load_js'] = array('additional/admin/catalog/attribute_form');
        $data['load_page'] = 'theme/admin/catalog/attribute_form';
        $this->load->view('layout/admin/pattern', $data);
    }

}
