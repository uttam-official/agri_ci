<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Admin_Model extends CI_Model{
    public function validate_login($form){
        $this->db->select('id,name,password');
        $this->db->where([
            'email'=>$form['email'],
            'isactive'=>1
        ]);
        $data=$this->db->get('admins')->row();
        if(isset($data) && password_verify($form['password'],$data->password)){
            $enc_data=$this->encryption->encrypt(json_encode(['admin_id'=>$data->id,'admin_name'=>$data->name,'admin_email'=>$form['email']]));
            $this->session->set_userdata('admin',$enc_data);
            return true;
        }
        return false;
    }
    public function update_admin($id,$form){
        $data=[
            'email'=>$form['email'],
            'password'=>password_hash($form['password'],PASSWORD_BCRYPT)
        ];
        $this->db->where('id',$id);
        if($this->db->update('admins',$data)){
            $this->session->unset_userdata('admin');
            return true;
        }
        return false;
    }
}