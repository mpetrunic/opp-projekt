<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Statistika extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
    }

    public function index() {
        User::require_admin($this);
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array();
        $book = new Book();
        $data["total_books"] = $book->get()->result_count();
        $purchase = new Purchase();
        $data["total_income"] = $purchase->get_bookstore_income();
        $data["total_purchases"] = $purchase->get()->result_count();
        $data["total_provision"] = $purchase->get_bookstore_provision();
        $this->load->view('stats/stats', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }
}