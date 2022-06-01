<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

function is_admin_logged() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('admin');
    if (isset($user)) { 
        redirect('admin');
    }
}
function is_admin_need_logged() {
    // Get current CodeIgniter instance
    $CI =& get_instance();
    // We need to use $CI->session instead of $this->session
    $user = $CI->session->userdata('admin');
    if (!isset($user)) { redirect('admin/login'); } 
}