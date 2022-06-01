<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        is_admin_need_logged();
        $this->load->model('admin/Category_model', 'model');
        $this->data = array();
    }
    public function index()
    {
        $this->data['title'] = "Category Management";
        $this->data['page_data'] = $this->model->get_category_details();
        $this->data['content'] = $this->parser->parse('admin/category/category', $this->data, true);
        $this->parser->parse('../../templates/admin/main', $this->data);
    }
    public function add($id = 0)
    {
        if (!is_numeric($id)) {
            $this->session->set_flashdata('category_error', 'Bad Request !');
            redirect('admin/category');
        }
        if (!empty($this->input->post())) {
            $form = (object) $this->input->post();
            $this->save($form);
        }
        if ($id > 0) {
            $this->data['title'] = "Edit Category";
            $this->data['btn_text'] = "Edit";
            $this->data['category_id'] = $id;
            $category = $this->model->get_single_category($id);
            if ($category == null) {
                $this->session->set_flashdata('category_error', 'Category not found');
                redirect('admin/category');
            }
            $this->data['category'] = json_encode($category);
        } else {
            $this->data['title'] = "Add Category";
            $this->data['btn_text'] = "Add";
            $this->data['category_id'] = $id;
            $this->data['category'] = false;
        }
        $this->data['content'] = $this->parser->parse('admin/category/add_category', $this->data, true);
        $this->parser->parse('../../templates/admin/main', $this->data);
    }
    protected function save($form)
    {
        if ($form->id > 0) {
            $category=$this->model->get_single_category($form->id);
            if ($category == null) {
                $this->session->set_flashdata('category_error', 'Category not found');
                redirect('admin/category');
            }
            $valid_name = $form->name==$category->name?'':'|is_unique[categories.name]';
            $msg = "Category updated Successfully";
        } else {
            $msg = "Category added Successfully";
            $valid_name = "|is_unique[categories.name]";
        }
        $this->form_validation->set_rules('name', 'Category Name', 'required' . $valid_name);
        $this->form_validation->set_rules('categoryorder', 'Category Order', 'required|numeric');
        $this->form_validation->set_rules('image', 'Category Image', 'callback_image_check');
        $this->form_validation->set_rules('isactive', 'Status', 'required');
        if ($this->form_validation->run() == true) {
            $id = $this->model->save($form);
            // $extension=pathinfo($_FILES['image']['tmp_name'],PATHINFO_EXTENSION);
            $config['upload_path'] = 'upload/category/';
            $config['file_name'] = $id;
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['overwrite'] = true;

            $this->load->library('upload', $config);
            $status = true;
            if ($this->upload->do_upload('image')) {
                $status = $this->db->update('categories', ['extension' => $this->upload->data('file_ext')], ['id' => $id]);
            }
            if ($status) {
                $this->session->set_flashdata('category_success', $msg);
                redirect('admin/category');
            }
        }
        return false;
    }
    //Image Validation
    public function image_check($str)
    {
        // var_dump($_FILES['image']);exit;
        $id = $this->input->post('id');
        if ($_FILES['image']['size'] > 0) {
            $mime = $_FILES['image']['type'];
            $allowed_mime = array('image/jpeg', 'image/png');
            if (!in_array($mime, $allowed_mime)) {
                $this->form_validation->set_message('image_check', 'The image feild only accept Jpeg,Jpg,Png');
                return false;
            }
        } else {
            if ($id > 0) {
                return true;
            } else {
                $this->form_validation->set_message('image_check', 'The Image field is required');
                return false;
            }
        }
        return true;
    }
    public function delete($id)
    {
        if (!is_numeric($id)) {
            $this->session->set_flashdata('category_error', 'Bad Request !');
            redirect('admin/category');
        }
        $category = $this->model->get_single_category($id);
        if ($category == null) {
            $this->session->set_flashdata('category_error', 'Category not found');
            redirect('admin/category');
        }
        if($this->db->update('categories',['isactive'=>-1],['id'=>$id])){
            $this->session->set_flashdata('category_error', 'Category deleted sucessfully');
            redirect('admin/category');
        }

    }
}
