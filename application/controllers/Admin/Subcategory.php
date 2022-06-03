<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Subcategory extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        is_admin_need_logged();
        $this->load->model('admin/Subcategory_model', 'model');
        $this->data = array();
    }
    public function index()
    {
        $this->data['page_data'] = $this->model->get_subcategory();
        $this->data['title'] = "Subcategory Management";
        $this->data['content'] = $this->parser->parse('admin/subcategory/subcategory', $this->data, true);
        $this->parser->parse('../../templates/admin/main', $this->data);
    }
    public function add($id = 0)
    {
        $this->valid_id($id);
        $form = $this->input->post();
        // var_dump(!empty($form));exit;
        if (!empty($form)) {
            $this->save((object) $form);
        }
        if ($id > 0) {
            $this->data['title'] = 'Edit Subcategory';
            $this->data['btn_text'] = "Edit";
            $this->data['subcategory_id'] = $id;
            $this->data['subcategory'] = json_encode($this->model->get_single_subcategory($id));
        } else {
            $this->data['title'] = 'Add Subcategory';
            $this->data['btn_text'] = "Add";
            $this->data['subcategory_id'] = 0;
            $this->data['subcategory'] = false;
        }
        $this->data['category_list'] = $this->model->get_category_list();
        $this->data['content'] = $this->parser->parse('admin/subcategory/add_subcategory', $this->data, true);
        $this->parser->parse('../../templates/admin/main', $this->data);
    }
    protected function save($form)
    {
        $this->valid_id($form->id);
        if ($form->id > 0) {
            $subcategory = $this->model->get_single_subcategory($form->id);
            if ($subcategory == null) {
                $this->session->set_flashdata('subcategory_error', 'Subcategory not found');
                redirect('admin/subcategory');
            }
            $valid_name = $form->name == $subcategory->name ? '' : '|is_unique[categories.name]';
            $msg = "Subcategory updated successfully";
        } else {
            $valid_name = '|is_unique[categories.name]';
            $msg = "Subcategory added successfully";
        }
        $this->form_validation->set_rules('name', 'Subcategory Name', 'required' . $valid_name);
        $this->form_validation->set_rules('parent', 'Category', 'required|numeric');
        $this->form_validation->set_rules('categoryorder', 'Subcategory order', 'required|numeric');
        $this->form_validation->set_rules('isactive', 'Status', 'required|numeric');
        if ($this->form_validation->run() == true) {
            $status = $this->model->save($form);
            if ($status) {
                $this->session->set_flashdata('subcategory_success', $msg);
                redirect('admin/subcategory');
            }
        }
        return false;
    }
    public function delete($id)
    {
        $this->valid_id($id);
        $subcategory = $this->model->get_single_subcategory($id);
        if ($subcategory == null) {
            $this->session->set_flashdata('subcategory_error', 'Subcategory not found');
            redirect('admin/subcategory');
        }
        $this->db->update('categories', ['isactive' => -1], ['id' => $id]);
        $this->session->set_flashdata('subcategory_error', 'Subcategory deleted successfully');
        redirect('admin/subcategory');
    }
    private function valid_id($id)
    {
        if (!is_numeric($id)) {
            $this->session->set_flashdata('subcategory_error', 'Bad Request!');
            redirect('admin/subcategory');
        }
        return true;
    }
}
