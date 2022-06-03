<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Subcategory_Model extends CI_Model{
    public function get_subcategory(){
        $this->db->select('s.id,s.name,s.categoryorder,c.name as parent,s.isactive');
        $this->db->where([
            's.isactive>'=>-1,
            's.parent>'=>0
        ]);
        $this->db->join('categories c','c.id=s.parent and c.isactive=1');
        return $this->db->get('categories s')->result();
    //    var_dump( $this->db->last_query());exit;
    }
    public function get_category_list(){
        $this->db->select('id,name');
        $this->db->where([
            'isactive'=>1,
            'parent'=>0
        ]);
        return $this->db->get('categories')->result();
    }
    public function get_single_subcategory($id){
        $this->db->select();
        $this->db->where([
            'isactive>'=>-1,
            'parent>'=>0,
            'id'=>$id,
        ]);
        return $this->db->get('categories')->row();
    }
    public function save($form){
        $data=[
            'name'=>$form->name,
            'slug_url'=>url_title($form->name,'-',true),
            'parent'=>$form->parent,
            'isactive'=>$form->isactive,
            'categoryorder'=>$form->categoryorder

        ];
        if($form->id>0){
            return $this->db->update('categories',$data,['id'=>$form->id]);
        }else{
            return $this->db->insert('categories',$data);             
        }
    }
}