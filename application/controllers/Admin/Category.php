<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller{
    private $data;
    public function __construct(){
        parent::__construct();
        $this->load->model('admin/Category_model');
        $this->data=array(); 
    }
    public function index(){
        $this->data['title']="Category Management";
        $this->data['page_data']=array();
        $this->data['content']=$this->parser->parse('admin/category/category',$this->data,true);
        $this->parser->parse('../../templates/admin/main',$this->data);
    }
}