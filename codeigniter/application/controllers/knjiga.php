<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Knjiga extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("Pdf");
    }

	public function index()
    {
        show_404();
	}

    public function prikaz($id = null) {
        User::require_login($this);
        $user = $this->session->userdata('user');
        $header_data = array(
            "user" => $user
        );
        $this->load->view('header', $header_data);
        $book = new Book($id);
        $book->comment->order_by("created_on", "DESC")->get_iterated();
        $current_purchase_level = $book->max_purchase_level - $book->purchase->get()->result_count();
        if($book->id == null) {
            show_404();
            return;
        }
        $comment = new Comment();
        $data = array();
        $data["book"] = $book;
        $data["current_purchase_level"] = $current_purchase_level;
        $data["mark"] = $comment->getAvgMark($book);
        $data["user_commented"] = User::commented_book($user, $book);
        $data["error_messages"] = $this->session->flashdata("error_messages");
        $data["success_message"] = $this->session->flashdata("success_message");
        $data["comment_content"] = $this->session->flashdata("comment_content");
        $this->load->view('/book/knjiga', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function komentiraj($id = null) {
        User::require_login($this);
        $book = new Book($id);
        $user = $this->session->userdata("user");
        if($book->id == null) {
            show_404();
            return;
        }
        if(User::commented_book($user, $book)) {
            show_error("Već ste komentirali knjigu", 403);
            return;
        }
        $comment = new Comment();
        $comment->content = $this->input->get_post("comment");
        $comment->mark = $this->input->get_post("rating");
        $comment->validate();
        if($comment->valid) {
            $comment->save($book);
            $comment->save($user);
            $this->session->set_flashdata("success_message", "Uspješno ste komentirali");
            redirect("/knjiga/prikaz/".$book->id);
            return;
        } else {
            $this->session->set_flashdata("error_messages", $comment->error->all);
            $this->session->set_flashdata("comment_comment", $this->input->get_post("comment"));
            redirect("/knjiga/prikaz/".$book->id);
            return;
        }
    }

    public function nova() {
        User::require_admin($this);
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array(
            "error_message" => $this->session->flashdata("error_message"),
            "success_message" => $this->session->flashdata("success_message"),
        );
        if($this->session->flashdata("new_book")) {
            $data["book"] = $this->session->flashdata("new_book");
        } else {
            $data["book"] = new Book();
        }
        $this->load->view('/book/new', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function spremi() {
        User::require_admin($this);
        $book = new Book();
        $book->publication_year = $this->input->get_post("publication_year");
        $book->price = $this->input->get_post("price");
        $book->page_number = $this->input->get_post("page_number");
        $book->max_purchase_level = $this->input->get_post("max_purchase_level");
        $deed = new Deed();
        $author = new Author();
        $author_name = $this->input->get_post("author_name");
        $author_surname = $this->input->get_post("author_surname");
        $save_author = false;
        if(!$author->already_exists($author_name, $author_surname)) {
            $author->name = $author_name;
            $author->surname = $author_surname;
            $save_author = true;
        }
        $deed->author = $author;
        $genre = new Genre();
        $genre->get_by_name($this->input->get_post("genre"));
        $save_genre = false;
        if($genre->id == null) {
            $genre->name = $this->input->get_post("genre");
            $save_genre = true;
        }
        $deed->genre = $genre;
        $deed->title = $this->input->get_post("title");
        $deed->content = $this->input->get_post("content");
        $book->deed = $deed;
        $book->validate();
        $deed->validate();
        $author->validate();
        $genre->validate();
        $erors = $this->process_upload_files($book);
        if($book->valid && $deed->valid && $author->valid && $genre->valid && empty($erors)) {
            if($save_author) {
                $author->save();
            }
            if($save_genre) {
                $genre->save();
            }
            $deed->save($author);
            $deed->save($genre);
            $book->save($deed);
        } else {

            $this->session->set_flashdata(
                "error_message",
                array_merge(
                    $book->error->all,
                    $deed->error->all,
                    $author->error->all,
                    $genre->error->all,
                    $erors));
            $this->session->set_flashdata("new_book", $book);
            $this->delete_uploads($book);
            redirect("/knjiga/nova", "refresh");
            return;
        }
        $this->session->set_flashdata("success_message", 'Uspješno ste dodali knjigu <a href="/knjiga/prikaz/'.$book->id.'">'.$book->deed->title.'</a>');
        redirect("/knjiga/nova", "refresh");
    }

    public function kupnja($book_id = null) {
        User::require_login($this);
        $book = new Book($book_id);
        if($book->id == null) {
            show_404();
            return;
        }
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array();
        if($book->get_current_seller() == null) {
            $book->current_seller = "Knjižara";
        } else {
            $book->current_seller = $book->get_current_seller()->username;
        }
        $data["book"] = $book;
        $this->load->view('book/buy', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function kupi($book_id = null) {
        User::require_login($this);
        $book = new Book($book_id);
        if($book->id == null) {
            show_404();
            return;
        }
        $user = $this->session->userdata('user');
        if($user->has_book($book->id) || $book->deleted) {
            show_error("Nije moguće kupiti knjigu", 400);
            return;
        }
        $purchase = new Purchase();
        $purchase->purchase_price = str_replace(",", ".", str_replace(".", "",$book->get_lowest_price()));
        $purchase->bookstore_provision = 0.2 * $purchase->purchase_price;
        $purchase->purchase_level = $book->get_current_purchase_level();
        $seller = $book->get_current_seller();
        $purchase->certificate = $this->generate_certificate($purchase, $user, $book);
        $purchase->save(array(
            'buyer' => $user,
            'seller' => $seller,
            'book' => $book
        ));
        $book->purchases_number++;
        $book->save();
        $this->session->set_flashdata("success_message", 'Uspješno ste kupili knjigu <b>'.$book->deed->title.'</b>.');
        redirect("/korisnik/mojprofil");
    }

    public function potvrda($book_id = null) {
        User::require_login($this);
        $book = new Book($book_id);
        if($book->id == null) {
            show_404();
            return;
        }
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array();
        $book->purchase->get();
        $data["book"] = $book;
        $this->load->view('book/certificate', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function pretraga() {
        User::require_login($this);
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array();
        $book = new Book();
        $data["books"] = $book->get_iterated();
        $this->load->view('search/search', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function pretrazi() {
        User::require_login($this);
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array();
        $book = new Book();
        $data["books"] = $book->search($this->input->get_post("search_field"), $this->input->get_post("search_param"));
        $this->load->view('search/search', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function preuzimanje($book_id = null) {
        User::require_login($this);
        $book = new Book($book_id);
        if($book->id == null) {
            show_404();
            return;
        }
        $user = $this->session->userdata("user");
        if(!$user->has_book($book->id)) {
            show_error("Pristup odbijen. Vi ne posjedujete ovu knjigu!", 403);
            return;
        }
        $this->load->helper('download');
        $data = file_get_contents("../codeigniter/uploads/books/".$book->pdf);
        force_download($book->deed->title.".pdf", $data);
    }

    public function certifikat($book_id = null) {
        User::require_login($this);
        $book = new Book($book_id);
        if($book->id == null) {
            show_404();
            return;
        }
        $user = $this->session->userdata("user");
        if(!$user->has_book($book->id)) {
            show_error("Pristup odbijen. Vi ne posjedujete certifikat za ovu knjigu!", 403);
            return;
        }
        $purchase = new Purchase();
        $purchase->where("buyer_id",$user->id)
            ->where("book_id", $book->id)->get();
        $this->load->helper('download');
        $data = file_get_contents("../codeigniter/uploads/certificates/".$purchase->certificate);
        force_download("Certifikat za knjigu ".$book->deed->title.".pdf", $data);
    }

    public function popis() {
        User::require_admin($this);
        $header_data = array(
            "user" => $this->session->userdata('user')
        );
        $this->load->view('header', $header_data);
        $data = array();
        $book = new Book();
        $data["books"] = $book->where("deleted", false)->get()->all;
        $data["success_message"] = $this->session->flashdata("success_message");
        $this->load->view('book/list', $data);
        $footer_data = array();
        $bookstore = new BookStore();
        $footer_data["bookstore"] = $bookstore->get()->all[0];
        $this->load->view('footer', $footer_data);
    }

    public function ukloni($book_id = null) {
        User::require_admin($this);
        $book = new Book($book_id);
        if($book->id == null || $book->deleted) {
            show_404();
            return;
        }
        $book->deleted = true;
        $book->save();
        $this->alert_users_about_book_deleted($book);
        $this->session->set_flashdata("success_message", 'Uspješno ste uklonili knjigu <a href="/knjiga/prikaz/'.$book->id.'">'.$book->deed->title.'</a> iz prodaje!');
        redirect("/knjiga/popis", "refresh");
    }

    private function process_upload_files(Book $book) {
        $errors = array();
        $cover_error = $this->upload_cover($book);
        if(!empty($cover_error)) {
            array_push($errors, $cover_error);
        }
        $book_error = $this->upload_book($book);
        if(!empty($book_error)) {
            array_push($errors, $book_error);
        }
        return $errors;
    }

    private function  upload_cover(Book $book) {
        $config['upload_path'] = "./assets/img/cover/";
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '2048';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if(!$this->upload->do_upload("cover")) {
            return $this->upload->error_msg[0];
        }
        $data = $this->upload->data();
        $book->cover = $data["file_name"];
        return null;
    }

    private function upload_book(Book $book) {
        $config['upload_path'] = "../codeigniter/uploads/books/";
        $config['allowed_types'] = 'pdf';
        $config['max_size']	= '2048';
        $config['encrypt_name'] = TRUE;
        $this->upload->initialize($config);
        if(!$this->upload->do_upload("book_file")) {
            return $this->upload->error_msg[0];
        }
        $data = $this->upload->data();
        $book->pdf = $data["file_name"];
        return null;
    }

    private function delete_uploads(Book $book) {
        $this->load->helper('file');
        if($book->cover != null) {
            delete_files("/public_html/assets/img/cover/".$book->cover);
        }
        if($book->pdf != null) {
            delete_files("../codeigniter/uploads/books/".$book->pdf);
        }

    }

    private function alert_users_about_book_deleted(Book $book) {

        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'o3p.no.reply@gmail.com',
            'smtp_pass' => 'oppgrupao3p',
            'mailtype' => 'text',
            'charset' => 'utf-8',
            'wordwrap' => TRUE,
            "newline" => "\r\n"
        );
        $this->load->library('email', $config);
        $user_emails = "";
        foreach($book->purchase->get()->all as $purchase) {
            $user_emails .= $purchase->buyer->email.",";
        }
        $this->email->from('o3p.no.reply@gmail.com', 'No-Reply');
        $this->email->to($user_emails);
        $this->email->subject('Obavijest o uklanjanju knjige iz prodaje!');
        $this->email->message('Poštovani, ovime vas obavještavamo kako se knjiga '
            .$book->deed->title
            .' uklanja iz prodaje te na njoj više neće biti moguće zarađivati');
        $this->email->send();
    }

    private function generate_certificate(Purchase $purchase, User $buyer, Book $book) {
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('o3p_Knjizara');
        $pdf->SetTitle('Transaction certificate');
        $pdf->SetSubject('Certificate of a book purchase transaction');
        $pdf->SetKeywords('certificate, transaction, o3p');

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
        $pdf->setFooterData(array(0,64,0), array(0,64,128));

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // set default font subsetting mode
        $pdf->setFontSubsetting(true);

        // Set font
        $pdf->SetFont('helvetica', '', 14, '', true);

        // Add a page
        $pdf->AddPage();


        $struser = $buyer->name;
        $strtitle = $book->deed->title;
        $strauthor = $book->deed->author->name . $book->deed->author->surname;
        $stryear = $book->publication_year;
        $strtoday = date("Y.m.d");
        $strprice = $purchase->purchase_price;
        // Set some content to print
        $html = <<<EOD
        <h3>Book purchase certificate</h3>
        <p>Thank you for choosing o3pBookstore for your online e-book expirience!</p>
		<br>
        <p><b>User:</b> $struser</p>
        <p><b>Transaction information:</b>
        <br>
        <br>
		<table border="1">
		<tr>
        <td><b>Title:</b></td><td>$strtitle<br></td>
		</tr>
		<tr>
        <td><b>Author:</b></td><td>$strauthor<br></td>
        </tr>
		<tr>
		<td><b>Year:</b></td><td>$stryear<br></td>
        </tr>
		<tr>
		<td><b>Date of purchase:</b></td><td>$strtoday<br></td>
        </tr>
		<tr>
		<td><b>Price:</b></td><td>$strprice<br></td>
		</tr>
		</table>
EOD;

        // Print text using writeHTMLCell()
        $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

        // ---------------------------------------------------------

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.

        $pdf_name = date("Y_m_d") . "_transaction_certificate_" . $strtitle . "_" . $strauthor . "_ " . $buyer->id. ".pdf";

        $pdf->Output("../codeigniter/uploads/certificates/" . $pdf_name, 'F');

        return $pdf_name;

        //============================================================+
        // END OF FILE
        //============================================================+
    }

}

/* End of file knjiga.php */
/* Location: ./application/controllers/knjiga.php */