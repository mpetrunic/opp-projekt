<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
    {
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $book = new Book();
        $data = array(
            "newest_books" => $book->get_newest_books(8),
            "popular_books" => $book->get_popular_books(8)
        );
        $this->load->view('header', $header_data);
		$this->load->view('home', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
	}
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */