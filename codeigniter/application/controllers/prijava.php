<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prijava extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $login = $this->session->flashdata("login");
        if(isset($login["error_message"])) {
            $data["error_message"] = $login["error_message"];

        }
        if(isset($login["username"])) {
            $data["username"] = $login["username"];
        } else {
            $data["username"] = "";

        }
        $this->session->unset_userdata("login");
        $this->load->view('/login/login', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function provjeri() {
        $user  = new User();
        $user->username = $this->input->get_post('username');
        $user->password = $this->input->get_post('password');
        if($user->login()) {
            //user logged
            $this->session->set_userdata("user", $user);
            if($this->session->userdata('redirect')) {
                $redirect = $this->session->userdata('redirect');
                $this->session->unset_userdata("redirect");
                redirect($redirect, 'refresh');
            } else {
                redirect("/", 'location');
            }
        } else {
            $login = array(
                "username" => $user->username,
                "error_message" => $user->error->login_error,
                "success_message" => null
            );
            $this->session->set_flashdata("login", $login);
            redirect("/prijava", 'refresh');
        }
    }

    public function odjava() {
        $this->session->unset_userdata("user");
        redirect('/', 'refresh');
    }

}
/* End of file prijava.php */
/* Location: ./application/controllers/prijava.php */