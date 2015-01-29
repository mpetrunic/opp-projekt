<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registracija extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
    }

    /**
     * Funkction which responds to url base_url/registracija or base_url/registracija/index.
     * This function will display registraction form.
     */
    public function index() {
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array(
            "error_message" => $this->session->flashdata("error_message"),
            "success_message" => $this->session->flashdata("success_message"),
        );
        if($this->session->flashdata("registration_user")) {
            $data["user"] = $this->session->flashdata("registration_user");
        } else {
            $data["user"] = new User();
        }
        $this->load->view('registration/registration_form', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    /**
     * Used for processing registration form input.
     */
    public function provjeri() {
        $user = new User();
        $user->username = $this->input->get_post("username");
        $user->name = $this->input->get_post("name");
        $user->surname = $this->input->get_post("surname");
        $user->nickname = $this->input->get_post("nickname");
        $user->email = $this->input->get_post("email");
        $user->password = $this->input->get_post("password");
        $user->confirm_password = $this->input->get_post("repeat_password");
        $user->privilege = "user";
        $user->validate();
        if($user->valid) {
            //user data is valid
            $user->save();
            $this->session->set_flashdata("success_message", 'Uspješno ste se registrirali!<br><a href=\'/prijava\'>Prijavite se</a>');
            redirect("/registracija", "refresh");
        } else {
            $this->session->set_flashdata("error_message", $user->error->all);
            $this->session->set_flashdata("registration_user", $user);
            redirect("/registracija", "refresh");
        }
    }

}
/* End of file registracija.php */
/* Location: ./application/controllers/registracija.php */