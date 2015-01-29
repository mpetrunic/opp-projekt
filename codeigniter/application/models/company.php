<?php

class Company extends DataMapper {


    // Insert related models that Company can have more than one of.
    var $has_many = array('bookstore');

    var $table = "companies";

    var $validation = array(
        'identification_number' => array(
            'rules' => array(),
            'label' => 'Matični broj'
        ),
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
/* End of file company.php */
/* Location: ./application/models/company.php */