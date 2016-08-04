<?php

class Category extends CI_Controller {

    private $base_url;
    private $list_catalog;
    private $base_context;

    public function __construct() {
        parent::__construct();
        $this->load->model('admin/catalog/category_model');
        $this->load->library('list/ListCatalog');

        $this->base_url = URL_BASE.'/admin/catalog/category';
        $this->list_catalog = new ListCatalog();
        $this->base_context = new BaseContext();
    }

    public function index() {
        $this->getList();
    }

    public function add() {
        if ($this->input->post()) {
            $value = $this->input->post();

            $data = array();
            $data['id_parent'] = isset($value['id_parent']) ? $value['id_parent'] : 0;
            $data['level_depth'] = $this->getLevelDepth($value['id_parent']);
            $data['is_root_category'] = 0;
            $data['active'] = isset($value['active']) ? 1 : 0;
            $data['name'] = $value['name'];
            $data['link_rewrite'] = $value['name'];
            //echo '<pre>'; print_r($data); exit;

            $category_id = $this->category_model->addCategory($data);

            if ($value['save'] == 'save') {
                redirect($this->base_url, 'refresh');
            } else {
                $this->getFormData($category_id);
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


        $data['load_js'] = array('additional/admin/catalog/category_list');
        $data['load_page'] = 'theme/admin/catalog/category_list';
        $this->load->view('layout/admin/pattern', $data);
    }

    public function getListRecord() {
        if ($this->input->post()) {

            $value = $this->input->post();
            $offset = offset_dyna($value);
            list($search, $sorts, $limit, $start) = $offset;

            $columns = array('C.id_category', 'C.id_parent', 'C.level_depth', 'C.is_root_category', 'CL.name', 'CL.description', 'CL.link_rewrite');
            $conditions = array();
            $data = array();
            $data['queryRecordCount'] = $this->list_catalog->getCategoryListTotal($search, $columns, $conditions);
            $data['recordsFiltered'] = $data['queryRecordCount'];
            $data['records'] = array();
            $results = $this->list_catalog->getCategoryList($start, $limit, $sorts, $search, $columns, $conditions);

            $tmp = array();
            foreach ($results as $key => $result) {
                $tmp['row'] = $start + ($key + 1);
                $tmp['id_category'] = $result['id_category'];
                $tmp['checkbox'] = table_checkbox($result['id_category']);
                $tmp['name'] = $result['name'];
                $tmp['description'] = $result['description'];
                $tmp['option'] = table_option($this->base_url, $result['id_category'], array('edit'));

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

    private function getFormData($category_id) {
        $data = $this->initForm();
        $data['action'] = $this->base_url.'/edit/'.$category_id;
        $data['cancel'] = $this->base_url;
        //$data['receipt_id'] = $receipt_id;
        $data['result'] = $this->base_context->getBaseContextCategory();
        $this->rendorForm($data);
    }

    function sub_category($category = '', $level = '') {
        $str = '';
        $str2 = '';

        $str.= "<li>{$category['name']} ";


        $results = $this->base_context->getBaseContextCategory($category['id_category']);




        if (!empty($results)) {

            $str2.= "<ul>";
            foreach ($results as $result) {

                // echo '<pre>'; print_r($result); exit;

                $str2.= $this->sub_category($result);
            }
            $str2.= "</ul>";
        }

        $str.= $str2."</li>";

        return $str;
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
            
            if($id_parent != 0) { continue; }
            
            $str1.= "<li><input type='radio' name='id_parent' value='{$category['id_category']}' >{$category['name']}</li>";
            
            $str2 = '';
            foreach ($categories as $in_category) {
                $in_id_category = $in_category['id_category'];
                $in_id_parent = $in_category['id_parent'];
                $in_level_depth = $in_category['level_depth'];
                
                if($id_category != $in_id_category){
                    if($id_category == $in_id_parent){
                        $str2.= "<li><input type='radio' name='id_parent' value='{$in_category['id_category']}' >{$in_category['name']}</li>";
                    }
                }
            } // end loop 2
            
            if(!empty($str2)){
                $str1.= "<ul>".$str2."</ul>";
            }
            
        } // end loop 1
        $str.= $str1;
        $str.= "</ul>";
        
        echo json_encode($str);
        return;
        
        echo '<pre>';
        print_r($str);
        exit;
















        foreach ($categories as $category) {
            $id_category = $category['id_category'];
            $id_parent = $category['id_parent'];
            $level_depth = $category['level_depth'];


            $htmls[$id_parent][$id_category] = "<li><input type='radio' name='id_parent' value='{$category['id_category']}' >{$category['name']}</li>";
        }

        //   krsort($html);

        foreach ($htmls as $html) {
            
        }



        





        echo '<pre>';
        print_r(implode($html[0]));
        exit;






        for ($i = $max_level; $i > 0; $i--) {
            $categories_data = $categories_level[$i];

            foreach ($categories_data as $category) {
                // unset($categories[$key]);
                $id_category = $category['id_category'];
                $id_parent = $category['id_parent'];
                $level_depth = $category['level_depth'];

                //   if($id_parent != 0){ continue; }
                //   $str.= "<li><input type='radio' name='id_parent' value='{$category['id_category']}' >{$category['name']}</li>";


                $str2 = '';
                foreach ($categories as $in_category) {
                    $in_id_category = $in_category['id_category'];
                    $in_id_parent = $in_category['id_parent'];
                    $in_level_depth = $in_category['level_depth'];

                    if ($id_category != $in_id_category && $level_depth != $in_level_depth) {

                        if ($id_category == $in_id_parent) {
                            $html[] = $in_category['name'];
                        }
                    }
                }

//                if (!empty($str2)) {
//                    $str.= "<ul>".$str2."</ul>";
//                }
//
//                unset($categories[$id_category]);
            }
        }


        echo '<pre>';
        print_r($html);
        exit;



















        $categories = $this->base_context->getBaseContextCategory();





        foreach ($categories as $category) {
            $ss = $this->sub_category($category);
        }








        $sss = '';

        do {
            foreach ($categories as $category) {
                $level_depth = $category['level_depth'];
                $id_category = $category['id_category'];
                $id_parent = $category['id_parent'];

                $abc = $this->base_context->getBaseContextCategory($id_category);

                if (!empty($abc)) {
                    
                }
            }
        } while (!empty($categories));



        echo '<pre>';
        print_r($sss);
        exit;

        exit;

        echo '<pre>';
        print_r($ss);
        exit;

        exit;

        $ss = $this->sub_category($results);



        print_r($ss);
        exit;




        $categories_data = array();
        $categories_level = array();
        $categories = array();
        $category_parent = array();
        $data = array();



//        echo '<pre>';
//        print_r($categories);
//        exit;



        $context = array();
        $str = '';
        $str2 = '';
        $str3 = '';
        $html = '';




        foreach ($categories as $category) {
            $this->sub_category($categories, $category, $html);
        }


        $str.= "<ul>";
        foreach ($categories as $category) {

            $id_category = $category['id_category'];
            $id_parent = $category['id_parent'];

            if ($id_parent == 0) {
                $str.= "<li><input type='radio' name='id_parent' value='{$category['id_category']}' >{$category['name']}</li>";
            }

            $str2 = '';
            foreach ($categories as $in_category) {

                $in_id_category = $in_category['id_category'];
                $in_id_parent = $in_category['id_parent'];

                //if ($in_id_parent == 1) {
                if ($id_category != $in_id_category && $id_parent != $in_id_parent) {
                    if ($id_category == $in_id_parent) {
                        $str2.= "<li><input type='radio' name='id_parent' value='{$in_category['id_category']}' >{$in_category['name']}</li>";
                    }
                }
                //   }

                $str3 = '';
                foreach ($categories as $in2_category) {
                    $in2_id_category = $in2_category['id_category'];
                    $in2_id_parent = $in2_category['id_parent'];

                    // if ($in2_id_parent == 2) {
                    // if ($id_category != $in_id_category && $id_parent != $in_id_parent) {
                    if ($in_id_category == $in2_id_parent) {
                        $str3.= "<li><input type='radio' name='id_parent' value='{$in2_category['id_category']}' >{$in2_category['name']}</li>";
                    }
                    //}
                    // }
                }

                unset($categories[$in_id_category]);

                if (!empty($str3)) {
                    $str2.= "<ul>$str3</ul>";
                }
            }



            if (!empty($str2)) {
                $str.= "<ul>$str2</ul>";
            }
        }

        $str.= "</ul>";

        echo '<pre>';
        print_r($str);
        exit;


        for ($i = $max_level; $i > 0; $i--) {

            $categories_data = $categories_level[$i];

            // echo '<pre>'; print_r($categories_data); exit;

            $str.= "<ul>";
            foreach ($categories_data as $category) {
                // unset($categories[$key]);
                $id_category = $category['id_category'];
                $id_parent = $category['id_parent'];
                $level_depth = $category['level_depth'];

                //   if($id_parent != 0){ continue; }

                $str.= "<li><input type='radio' name='id_parent' value='{$category['id_category']}' >{$category['name']}</li>";


                $str2 = '';
                foreach ($categories as $in_category) {
                    $in_id_category = $in_category['id_category'];
                    $in_id_parent = $in_category['id_parent'];
                    $in_level_depth = $in_category['level_depth'];

                    if ($id_category != $in_id_category && $level_depth != $in_level_depth) {

                        if ($id_category == $in_id_parent) {
                            $str2.= "<li><input type='radio' name='id_parent' value='{$in_category['id_category']}' >{$in_category['name']}</li>";
                        }
                    }
                }

                if (!empty($str2)) {
                    $str.= "<ul>".$str2."</ul>";
                }

                unset($categories[$id_category]);
            }
        }

        $str.= "</ul>";

        print_r($str);
        exit;



//        print_r($str);
//        exit;
//
//        if ($id_parent == 1) {
//            
//        }
//
//        $context[$id_category][$id_parent] = "<li><input type='radio' name='id_parent' value='{$category['id_category']}' >{$category['name']}</li>";
//
//
//
//
//
//        $html = array();
//
//        for ($i = $max_level; $i > 0; $i--) {
//            $categories_data = $categories_level[$i];
//
//            $html.= "<ul>";
//
//            foreach ($categories_data as $category) {
//
//
//                $html.= "<li>";
//                $html.= "<input type='radio' name='id_parent' value='{$category['id_category']}' >";
//                $html.= $category['name'];
//                $html.= "</li>";
//            }
//
//            $html.= "</ul>";
//        }
//
//
//        $html = "
//        	<ul>
//		<li><input type='radio' name='id_parent' value='1' >book</li>
//		<li><input type='radio' name='id_parent' value='2' >fasion</li>
//		<li><input type='radio' name='id_parent' value='3' >play
//			<ul>
//				<li><input type='radio' name='id_parent' value='5' >ssssssssss</li>
//				
//			</ul>
//		</li>
//		<li><input type='radio' name='id_parent' value='4' >test</li>
//	</ul> ";
//
//        echo json_encode($html);
    }

    private function getLevelDepth($id_parent) {
        $level = (int) $this->category_model->getLevelDepth($id_parent) + 1;
        return $level;
    }

    private function initForm() {
        $data = array();
        $data['sub_menu'] = 'category';
        $data['text_title'] = 'Category';
        $data['text_panel_title'] = 'Category List';
        $data['form_form'] = 'form_category';
        $data['today'] = date("d-m-Y");
        return $data;
    }

    private function rendorForm($data) {
        $data['selector'] = array(Agent::SELECTOR_SAVE, Agent::SELECTOR_SAVE_STAY, Agent::SELECTOR_CANCEL);


        $data['load_js'] = array('additional/admin/catalog/category_form');
        $data['load_plugin_js'] = array('tree/tree');
        $data['load_plugin_css'] = array('tree/tree');

        $data['load_page'] = 'theme/admin/catalog/category_form';
        $this->load->view('layout/admin/pattern', $data);
    }

}
