<?php

class Author extends DataMapper {

    var $has_many = array('deed');

    var $validation = array(
        'name' => array(
            'rules' => array('required', 'trim', 'min_length' => 3, 'max_length' => 50),
            'label' => 'Ime autora'
        ),
        'surname' => array(
            'rules' => array('required', 'trim', 'min_length' => 3, 'max_length' => 60),
            'label' => 'Prezime autora'
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

    function already_exists($name, $surname) {
        $author = $this->where("name",$name)
            ->where("surname", $surname)
            ->get(1);
        if($author->id == null) {
            return false;
        } else {
            return true;
        }
    }
}
/* End of file author.php */
/* Location: author.php */ 