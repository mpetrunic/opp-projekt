<?php

/**
 * Djelo u prijevodu jel...
 */
class Deed extends DataMapper {

    var $table = "deeds";

    // Insert related models that Deed can have just one of.
    var $has_one = array('genre', 'author');

    var $has_many = array('book');

    var $auto_populate_has_one = TRUE;

    var $validation = array(
        'title' => array(
            'rules' => array('required', 'trim', 'unique', 'max_length' => 60, 'min_length' => 3),
            'label' => 'Naslov'
        ),
        'content' => array(
            'rules' => array('required', 'trim', 'min_length' => 10),
            'label' => 'Sadržaj'
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

}
/* End of file deed.php */
/* Location: ./application/models/deed.php */