<?php

class BookStore extends DataMapper {

    // Insert related models that BookStore can have just one of.
    var $has_one = array('company');

    var $auto_populate_has_one = TRUE;

    var $validation = array(
        'name' => array(
            'rules' => array(),
            'label' => 'Naziv'
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
/* End of file bookstore.php */
/* Location: ./application/models/bookstore.php */