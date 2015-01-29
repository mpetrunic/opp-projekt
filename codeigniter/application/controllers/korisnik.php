<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Korisnik extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    public function profil($username = null) {
        User::require_login($this);
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $user = new User();
        $user->where("username", $username)->get();
        if($user->id == null) {
            show_404();
            return;
        }
        $user->calculate_stats();
        $data = array();
        $data["user"] = $user;
        $this->load->view('header', $header_data);
        $this->load->view('user/profile', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function mojprofil() {
        User::require_login($this);
        $user = $this->session->userdata('user');
        $header_data = array(
            "user" => $user
        );
        $this->load->view('header', $header_data);
        $user->purchases->get();
        $user->calculate_stats();
        $data = array();
        $data["user"] = $user;
        $data["success_message"] = $this->session->flashdata("success_message");
        $this->load->view('user/myprofile', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function partneri() {
        User::require_login($this);
        $user = $this->session->userdata('user');
        $header_data = array(
            "user" => $user
        );
        $this->load->view('header', $header_data);
        $data = array();
        $data["user"] = $user;
        $this->load->view('user/partners', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

}
/* End of file korisnik.php */
/* Location: ./application/controllers/korisnik.php */