<?php defined('BASEPATH') OR exit('No direct script access allowed');
    class Admin extends CI_Controller{
        private $data;
        public function __construct()
        {
            parent::__construct();
            $this->load->model('admin/Admin_model','model');
        }
        public function index(){
            is_admin_need_logged();
            $this->data['title']="AgriExpress Dashboard";
            $this->data['content']=$this->parser->parse('admin/admin/dashboard',$this->data,true);
            $this->parser->parse('../../templates/admin/main',$this->data);
        }
        public function login(){
            is_admin_logged();
            $form=$this->input->post();
            if(!empty($form)){
                $this->form_validation->set_rules('email','Email','required|valid_email');
                $this->form_validation->set_rules('password','Password','required');
                if($this->form_validation->run()!=false){
                    $this->validate($form);
                }
            }
            $this->data['title']="Admin Login";
            $this->data['content']=$this->parser->parse('admin/admin/login',$this->data,true);
            $this->parser->parse('../../templates/admin/blank',$this->data);
        }
        protected function validate($form){
            $status=$this->model->validate_login($form);
            if($status){
                redirect('admin');
            }else{
                $this->session->set_flashdata('login_error','Enter valid email and password');
                redirect('admin/login');
            }
        }
        public function logout(){
            is_admin_need_logged();
            // echo $this->session->userdata('admin');
            $this->session->unset_userdata('admin');
            redirect('admin/login');
        }
        public function settings(){
            is_admin_need_logged();
            $admin=json_decode($this->encryption->decrypt($this->session->userdata('admin')));
            $this->data['email']=$admin->admin_email;
            $form=$this->input->post();
            if(!empty($form)){
                $is_unique=$this->data['email']==$form['email']?'':'|is_unique[admins.email]';
                $this->form_validation->set_rules('email','Email','required|valid_email'.$is_unique);
                $this->form_validation->set_rules('password','Password','required');
                if($this->form_validation->run()==true){
                    $this->update_admin($admin->admin_id,$form);
                }
            }


            $this->data['title']="Admin > Settings";
            $this->data['content']=$this->parser->parse('admin/admin/settings',$this->data,true);
            $this->parser->parse('../../templates/admin/main',$this->data);
        }
        protected function update_admin($id,$form){
            is_admin_need_logged();
            $status=$this->model->update_admin($id,$form);
            if($status){
                $this->session->set_flashdata('login_warning','Your session has expired ... Please Login');
                redirect('admin/login');
            }
        }
    }