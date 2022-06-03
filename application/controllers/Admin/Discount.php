<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Discount extends CI_Controller{
    private $data;
    public function __construct(){
        parent::__construct();
        is_admin_need_logged();
        $this->load->model('admin/Discount_model','model');
        $this->data=array();
    }
    public function index(){
        $this->data['page_data']=$this->model->get_discount();
        $this->data['title']="Discount Management";
        $this->data['content']=$this->parser->parse('admin/discount/discount',$this->data,true);
        $this->parser->parse('../../templates/admin/main',$this->data);
    }
    public function add($id=0){
        $this->valid_id($id);
        $form= $this->input->post();
        if(!empty($form)){
            $this->save((object) $form);
        }
        if($id>0){
            $discount=$this->valid_discount($id);
            $this->data['title']="Edit Discount coupon";
            $this->data['btn_text']="Edit";
            $this->data['discount_id']=$id;
            $this->data['discount']=json_encode($discount);
        }else{
            $this->data['title']="Add Discount coupon";
            $this->data['btn_text']="Add";
            $this->data['discount_id']=0;
        }
        $this->data['content']=$this->parser->parse('admin/discount/add_discount',$this->data,true);
        $this->parser->parse('../../templates/admin/main',$this->data);
    }
    private function save($form){
        $id=$form->id;
        $valid_discount='|is_unique[discounts.name]';
        $msg='Discount coupon added successfully';
        if($id>0){
            $this->valid_id($id);
            $discount=$this->valid_discount($id);
            $valid_discount=$discount->name==$form->name?'':'|is_unique[discounts.name]';
            $msg='Discount coupon edited successfully';
        }
        $this->form_validation->set_rules('name','Name','required|alpha_numeric'.$valid_discount);
        $this->form_validation->set_rules('type','Type','required');
        $this->form_validation->set_rules('amount','Amount','required|numeric|greater_than[0]');
        $this->form_validation->set_rules('isactive','Status','required');
        if($this->form_validation->run()==true){
            $status=$this->model->save($form);
            if($status){
                $this->session->set_flashdata('discount_success',$msg);
                redirect('admin/discount');
            }
        }
        return false;
    }
    public function delete($id){
        $this->valid_id($id);
        $this->valid_discount($id);
        $this->db->update('discounts',['isactive'=>-1],['id'=>$id]);
        $this->session->set_flashdata('discount_error','Discount coupon deleted successfully');
        redirect('admin/discount');
    }
    private function valid_discount($id){
        $discount=$this->model->get_single_discount($id);
        if(empty($discount)){
            $this->session->set_flashdata('discount_error','Discount coupon not found');
            redirect('admin/discount');
        }
        return $discount;
    }
    private function valid_id($id){
        if(!is_numeric($id)){
            $this->session->set_flashdata('discount_error','Bad request');
            redirect('admin/discount');
        }
        return true;
    }
}