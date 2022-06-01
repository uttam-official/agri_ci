<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Category_Model extends CI_Model{
    public function get_category_details(){
        $this->db->select('c.id,c.name,c.categoryorder,c.isactive,count(s.id) as no_of_subcategory');
        $this->db->where([
            'c.isactive>'=>-1,
            'c.parent'=>0
        ]);
        $this->db->group_by('c.id');
        $this->db->join('categories s','s.parent=c.id and s.isactive=1','left');
        return $this->db->get('categories c')->result();
    }
    public function get_single_category($id){
        $this->db->select('id,name,categoryorder,isactive,extension');
        $this->db->where([
            'isactive>'=>-1,
            'parent'=>0,
            'id'=>$id
        ]);
        return $this->db->get('categories')->row();
    }


    public function save($form){
        $id=$form->id;
        $data=[
            'name'=>$form->name,
            'slug_url'=>url_title($form->name,'-',true),
            'categoryorder'=>$form->categoryorder,
            'isactive'=>$form->isactive
        ];
        if($id>0){
            $this->db->update('categories',$data,['id'=>$id]);

        }else{
            $this->db->insert('categories',$data);
            $id=$this->db->insert_id();
        }
        return $id;
    }
}