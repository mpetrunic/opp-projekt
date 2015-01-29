<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function prijavljeni() {
        User::require_admin($this);
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array();
        $user = new User();
        $data["users"] = $user->get()->all;
        $this->load->view('list/loggedin', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }
}
/* End of file admin.php */
/* Location: admin.php */ 