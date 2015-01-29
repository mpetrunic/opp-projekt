<?php

class User extends DataMapper {

    var $number_of_bookstore_books = 0;

    var $number_of_user_books = 0;

    var $total_bought_books_price = 0.0;

    var $total_bought_books  = 0;

    var $rank = 0;

    var $number_clients_and_partners = 0;


    // Insert related models that User can have more than one of.
    var $has_many = array(
        'purchases' => array(
            'class' => 'purchase',
            'other_field' => 'buyer'
        ),
        'sells' => array(
            'class' => 'purchase',
            'other_field' => 'seller'
        ),
        'comment' => array());

    var $auto_populate_has_many = TRUE;

    var $validation = array(
        'name' => array(
            'rules' => array('required', 'trim', 'max_length' => 50, 'min_length' => 3),
            'label' => 'ime korisnika'
        ),
        'surname' => array(
            'rules' => array('required', 'trim', 'max_length' => 70, 'min_length' => 3),
            'label' => 'prezime korisnika'
        ),
        'nickname' => array(
            'rules' => array('required', 'trim', 'unique', 'max_length' => 50, 'min_length' => 3),
            'label' => 'nadimak korisnika'
        ),
        'email' => array(
            'rules' => array('required', 'trim', 'unique', 'valid_email', 'max_length' => 100),
            'label' => 'email adresa korisnika'
        ),
        'username' => array(
            'rules' => array('required', 'trim', 'unique', 'max_length' => 50, 'min_length' => 3),
            'label' => 'korisničko ime'
        ),
        'password' => array(
            'rules' => array('required', 'trim', 'min_length' => 3, 'max_length' => 40, 'encrypt'),
            'label' => 'lozinka',
            'type' => 'password'
        ),
        'confirm_password' => array(
            'label' => 'ponovljena lozinka',
            'rules' => array('required', 'encrypt', 'matches' => 'password', 'min_length' => 3, 'max_length' => 40),
            'type' => 'password'
        ),
        'privilege' => array(
            'rules' => array('required', 'min_length' => 3, 'max_length' => 20),
            'label' => 'razina prava'
        )
    );

    /**
     * Constructor: calls parent constructor
     */
    function __construct($id = NULL)
    {
        parent::__construct($id);
    }

    /**
     * Post model initialization action.
     * @param bool $from_cache
     */
    function post_model_init($from_cache = FALSE)
    {
    }

    /**
     * Login
     *
     * Authenticates a user for logging in.
     *
     * @access    public
     * @return    bool
     */
    function login()
    {
        // backup username for invalid logins
        $uname = $this->username;

        // Create a temporary user object
        $u = new User();

        // Get this users stored record via their username
        $u->where('username', $uname)->get();

        // Give this user their stored salt
        $this->salt = $u->salt;

        // Validate and get this user by their property values,
        // this will see the 'encrypt' validation run, encrypting the password with the salt
        $this->validate()->get();

        // If the username and encrypted password matched a record in the database,
        // this user object would be fully populated, complete with their ID.

        // If there was no matching record, this user would be completely cleared so their id would be empty.
        if ($this->exists())
        {
            return TRUE;
        }
        else
        {
            // Login failed, so set a custom error message
            $this->error_message('login_error', 'Korisničko ime ili lozinka neispravni!');
            // restore username for login field
            $this->username = $uname;

            return FALSE;
        }
    }


    /**
     * Encrypt (prep)
     *
     * Encrypts this objects password with a random salt.
     *
     * @access    private
     * @param    string
     * @return    void
     */
    function _encrypt($field)
    {
        if (!empty($this->{$field}))
        {
            if (empty($this->salt))
            {
                $this->salt = md5(uniqid(rand(), true));
            }

            $this->{$field} = sha1($this->salt . $this->{$field});
        }
    }

    public function calculate_stats() {
        $this->number_of_bookstore_books = 0;
        $this->number_clients_and_partners = 0;
        $this->number_of_user_books = 0;
        $this->total_bought_books_price = 0.0;
        $this->total_bought_books = 0;
        $this->rank = 0;
        if($this->purchases != null) {
            foreach($this->purchases as $purchase) {
                if($purchase->seller->id == null) {
                    $this->number_of_bookstore_books++;
                } else {
                    $this->number_of_user_books++;
                    $this->number_clients_and_partners++;
                    $this->rank += 2;
                }
                $this->total_bought_books++;
                $this->total_bought_books_price += $purchase->purchase_price;
            }
        }
        if($this->sells != null) {
            foreach($this->sells as $sell) {
                $this->number_clients_and_partners++;
                $this->rank += 3;
            }
        }
        $this->rank += $this->number_of_bookstore_books;
        $this->rank += $this->total_bought_books_price/500;
        $this->rank = 1 + floor($this->rank/20);
        if($this->rank > 10){
            $this->rank = 10;
        }
    }

    public function has_book($book_id) {
        foreach($this->purchases as $purchase) {
            if($purchase->book->id == $book_id) {
                return true;
            }
        }
        return false;
    }

    /**
     * Used by controllers which restricts access to specific site locations
     * by requiering user login.
     * @param CI_Controller $controller
     */
    public static function require_login(CI_Controller $controller = null) {
        if($controller->session->userdata("user")) return;
        if($controller != null) {
            $controller->load->helper('url');
            $redirect_url = current_url();
            $login = array(
                "error_message" => "Za pristup ovoj stranici potrebno se prijaviti!"
            );
            $controller->session->set_userdata("redirect", $redirect_url);
            $controller->session->set_flashdata("login", $login);
            redirect("/prijava", "refresh");
        }
    }

    public static function require_admin(CI_Controller $controller = null) {
        if($controller->session->userdata("user")) {
            $user = $controller->session->userdata("user");
            if($user->privilege === "admin") {
                return;
            }
        }
        if($controller != null) {
            $controller->load->helper('url');
            $redirect_url = current_url();
            $login = array(
                "error_message" => "Pristup ovoj stranici je dopušten samo administratorima!"
            );
            $controller->session->set_userdata("redirect", $redirect_url);
            $controller->session->set_flashdata("login", $login);
            redirect("/prijava", "refresh");
        }
    }

    public static function commented_book(User $user,Book $book) {
        $comment = new Comment();
        $comment->where("user_id", $user->id)
            ->where("book_id", $book->id)->get();
        if($comment->id != null) {
            return TRUE;
        }
        return FALSE;
    }

}
/* End of file user.php */
/* Location: ./application/models/user.php */