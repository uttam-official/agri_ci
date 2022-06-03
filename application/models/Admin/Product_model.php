<?php defined('BASEPATH') OR exit('No script direct access allowed');
class Product_Model extends CI_Model{
    public function get_product(){
        $this->db->select('p.id,p.name,c.name as category,s.name as subcategory,p.price,p.availability,p.isactive');
        $this->db->join('categories c','p.category=c.id');
        $this->db->join('categories s','p.subcategory=s.id');
        $this->db->where('p.isactive',1);
        return $this->db->get('products p')->result();
    }
    public function get_single_product($id){
        $this->db->select('p.id,p.name,p.category,p.subcategory,p.description,p.price,p.availability,p.image_extension,p.special,p.featured,p.isactive,GROUP_CONCAT(g.extension) as gallery');
        $this->db->join('productgallery g','g.product_id=p.id','left');
        $this->db->where([
            'p.id'=>$id,
            'p.isactive'=>1
        ]);
        $this->db->group_by('p.id');
        return $this->db->get('products p')->row();
        // echo $this->db->last_query();exit;
    }
    public function get_subcategory($id){
        $this->db->select('id,name');
        $this->db->where([
            'isactive'=>1,
            'parent'=>$id
        ]);
        return $this->db->get('categories')->result();
    }
    public function save($form){
        $id=$form->id;
        $data=[
            'category'=>$form->category,
            'subcategory'=>$form->subcategory,
            'name'=>$form->name,
            'slug_url'=>url_title($form->name,'dash',true),
            'description'=>$form->description,
            'price'=>$form->price,
            'availability'=>$form->availability,
            'special'=>isset($form->special)?1:0,
            'featured'=>isset($form->featured)?1:0,
        ];
        if($id>0){
            $this->db->update('products',$data,['id'=>$id]);
            return $id;
        }else{
            $this->db->insert('products',$data);
            return $this->db->insert_id();
            
        }
    }
}