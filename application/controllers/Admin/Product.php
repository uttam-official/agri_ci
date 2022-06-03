<?php defined('BASEPATH') or exit('No script direct access allowed');


class Product extends CI_Controller
{
    private $data;
    public function __construct()
    {
        parent::__construct();
        is_admin_need_logged();
        $this->load->library('image_lib');
        $this->load->library('upload');
        $this->load->helper('file');
        $this->load->model('admin/Product_model', 'model');
        $this->load->model('admin/Subcategory_model', 's_model');

        $this->data = array();
    }
    public function index()
    {
        $this->data['page_data'] = $this->model->get_product();
        $this->data['title'] = "Product Management";
        $this->data['content'] = $this->parser->parse('admin/product/product', $this->data, true);
        $this->parser->parse('../../templates/admin/main', $this->data);
    }
    public function add($id = 0)
    {
        $this->valid_id($id);
        $form = $this->input->post();
        // var_dump($form);exit;
        if (!empty($form)) {
            $this->save((object) $form);
        }
        if (validation_errors() && isset($form['category'])) {
            $this->data['subcategory_list'] = $this->subcategory_list($form['category']);
        }
        $this->data['category_list'] = $this->s_model->get_category_list();
        if ($id > 0) {
            $product=$this->valid_product($id);
            $this->data['product'] = json_encode($product);
            $this->data['title'] = "Edit Product";
            $this->data['btn_text'] = "Edit";
            $this->data['product_id'] = $id;
            $this->data['subcategory_list'] = $this->subcategory_list($product->category);
        } else {
            $this->data['title'] = "Add Product";
            $this->data['btn_text'] = "Add";
            $this->data['product_id'] = 0;
        }
        $this->data['content'] = $this->parser->parse('admin/product/add_product', $this->data, true);
        $this->parser->parse('../../templates/admin/main', $this->data);
    }
    private function save($form)
    {
        $frm_id = $id = $form->id;
        $this->valid_id($id);
        $valid_name = '|is_unique[products.name]';
        $msg = "Product added successfully";
        if ($id > 0) {
            $product=$this->valid_product($id);
            $valid_name =$product->name==$form->name?'':'|is_unique[products.name]';
            $msg = "Product updated successfully";
        }
        $this->form_validation->set_rules('category', 'Category', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('subcategory', 'Subcategory', 'required|is_natural_no_zero');
        $this->form_validation->set_rules('name', 'Name', 'required' . $valid_name);
        $this->form_validation->set_rules('price', 'Price', 'required|numeric');
        $this->form_validation->set_rules('image', 'Image', 'callback_image_check');
        $this->form_validation->set_rules('gallery', 'Gallery', 'callback_gallery_check');
        if ($this->form_validation->run() == true) {
            $id = $this->model->save($form);
            $ext = $this->image_upload($id, $id, 'product', 'image');
            $status = $status = $this->insert_image_record($id, $ext);
            $gallery = $_FILES['gallery'];
            if ($status && $gallery['error'][0] == 0) {
                $frm_id > 0 ? $this->db->delete('productgallery', ['product_id' => $id]) : '';
                $length = count($gallery['name']);
                for ($i = 0; $i < $length; $i++) {
                    $_FILES['galleryimage']['name'] = $gallery['name'][$i];
                    $_FILES['galleryimage']['type'] = $gallery['type'][$i];
                    $_FILES['galleryimage']['tmp_name'] = $gallery['tmp_name'][$i];
                    $_FILES['galleryimage']['error'] = $gallery['error'][$i];
                    $_FILES['galleryimage']['size'] = $gallery['size'][$i];
                    $file_name = $this->image_upload($id, $id . '_' . $i, 'productgallery', 'galleryimage');
                    $this->insert_gallery_record($id, $file_name);
                }
            }
            $this->session->set_flashdata('product_success', $msg);
            redirect('admin/product');
        }
        return false;
    }
    public function delete($id)
    {
        $this->valid_id($id);
        $this->valid_product($id);
        if($this->db->update('products',['isactive'=>-1],['id'=>$id])){
            $this->session->set_flashdata('product_error','Product deleted successfully');
            redirect('admin/product');
        }
    }
    private function valid_id($id)
    {
        if (!is_numeric($id)) {
            $this->session->set_flashdata('product_error', 'Bad Request');
            redirect('admin/product');
        }
        return true;
    }
    private function valid_product($id)
    {
        $product=$this->model->get_single_product($id);
        if(empty($product)){
            $this->session->set_flashdata('product_error','Product not found');
            redirect('admin/product');
        }
        return $product;
    }
    public function get_subcategory()
    {
        $subcategory = $this->subcategory_list($this->input->post('id'));
        echo json_encode($subcategory);
    }
    public function subcategory_list($id)
    {
        return $this->model->get_subcategory($id);
    }
    public function image_check($str)
    {
        $id = $this->input->post('id');
        $image = $_FILES['image'];
        $mime_allowed = ['image/jpeg', 'image/png'];

        if ($image['error'] == 0) {
            if (!in_array($image['type'], $mime_allowed)) {
                $this->form_validation->set_message('image_check', "Only jpg,jpeg,png image allowed");
                return false;
            }
            if ($image['size'] > 10485760) {
                $this->form_validation->set_message('image_check', "Maximum 10MB sized image allowed");
                return false;
            }
            if (!$this->image_dimension_check($image['tmp_name'])) {
                $this->form_validation->set_message('image_check', "Minimum 1000*1000 pixel size image allowed");
                return false;
            }
        } elseif ($id < 1) {
            $this->form_validation->set_message('image_check', "The image field is required");
            return false;
        }
        return true;
    }
    public function gallery_check($str)
    {
        $gallery = $_FILES['gallery'];
        // var_dump($gallery['error'][0]);exit;
        $mime_allowed = ['image/jpeg', 'image/png'];
        if ($gallery['error'][0] == 0) {
            foreach ($gallery['tmp_name'] as $k => $v) {
                if (!in_array($gallery['type'][$k], $mime_allowed)) {
                    $this->form_validation->set_message('gallery_check', "Only jpg,jpeg,png gallery image allowed");
                    return false;
                }
                if ($gallery['size'][$k] > 10485760) {
                    $this->form_validation->set_message('gallery_check', "Maximum 10MB sized gallery image allowed");
                    return false;
                }
                if (!$this->image_dimension_check($v)) {
                    $this->form_validation->set_message('gallery_check', "Minimum 1000*1000 pixel size gallery image allowed");
                    return false;
                }
            }
        }
        return true;
    }
    public function image_dimension_check($image)
    {
        $image_info = getimagesize($image);
        if ($image_info[0] >= 1000 && $image_info[1] >= 1000) {
            return true;
        }
        return false;
    }
    private function image_upload($id, $name, $des, $field_name)
    {
        $path = ['/small', '/medium', '/large'];
        $width = ['100', '500', '1000'];
        //upload
        for ($i = 0; $i < 3; $i++) {
            $config['upload_path'] = './upload/' . $des . $path[$i];
            $config['file_name'] = $name;
            $config['min_width'] = '1000';
            $config['min_height'] = '1000';
            $config['max_size'] = '10485760';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['overwrite'] = true;
            $this->upload->initialize($config);
            $this->upload->do_upload($field_name);
            $data = $this->upload->data();
            $this->resize_image($data, $width[$i]);
            // var_dump($this->upload->data());
        }
        return $field_name == 'image' ? $data['file_ext'] : $data['file_name'];
    }
    private function resize_image($data, $width)
    {
        $config['image_library'] = 'gd2';
        $config['source_image'] = $data['full_path'];
        $config['maintain_ratio'] = false;
        $config['width']         = $width;
        $config['height']       = $width;

        $this->image_lib->initialize($config);

        $this->image_lib->resize();

        return true;
    }
    private function insert_image_record($id, $ext)
    {
        return $this->db->update('products', ['image_extension' => $ext], ['id' => $id]);
    }
    private function insert_gallery_record($id, $file_name)
    {
        $data = [
            'product_id' => $id,
            'extension' => $file_name
        ];
        return $this->db->insert('productgallery', $data);
    }
}
