<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends MY_Controller
{
    public $autoload = array(
        'model' => array('user_model' => 'user')
    );

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $user_id = get_user_id();
        if ($this->input->method() === 'post') {

            // profile updates
            $this->user->update($user_id, array(
                'status' => $this->input->post('status'),
                'fullname' => $this->input->post('fullname'),
                'sex' => $this->input->post('sex'),
                'address' => $this->input->post('address'),
                'about' => $this->input->post('about')
            ));

            $this->session->set_flashdata('success', 'Thiết lập đã được lưu lại');
            redirect($this->uri->uri_string());
        }

        $this->set_title('Thông tin tài khoản');
        $this->set_data(array('user' => $this->user->get($user_id)));
        $this->render('account');
    }

    public function profile($id, $username)
    {
        $this->set_title('Trang cá nhân');
        $this->set_data(array('user' => $this->user->get($id)));
        $this->render('profile');
    }

    private function check_validation()
    {
        //link_tag()
//        return $this->form_validation->set_rules($config)
//            ->run();
        return false;
    }
}
