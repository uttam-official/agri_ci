<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Discount_Model extends CI_Model{
    public function get_discount(){
        $this->db->select('id,name,validfrom,validtill,type,amount,isactive');
        $this->db->where('isactive>',-1);
        return $this->db->get('discounts')->result();
    }
    public function get_single_discount($id){
        $this->db->select('id,name,validfrom,validtill,type,amount,isactive');
        $this->db->where([
            'isactive>'=>-1,
            'id'=>$id
        ]);
        return $this->db->get('discounts')->row();
    }
    public function save($form){
        $data=[
            'name'=>$form->name,
            'validfrom'=>$form->validfrom,
            'validtill'=>$form->validtill,
            'type'=>$form->type,
            'amount'=>$form->amount,
            'isactive'=>$form->isactive
        ];
        if($form->id>0){
            return $this->db->update('discounts',$data,['id'=>$form->id]);
        }else{
            return $this->db->insert('discounts',$data);
        }
    }
}