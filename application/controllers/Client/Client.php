<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Client extends CI_Controller {
    public function index(){
        $this->load->view('client/index');
    }
    public function login(){
        echo "HEllo";
    }
}
