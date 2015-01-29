<?php

class Genre extends DataMapper {

    var $has_many = array('deed');

    var $validation = array(
      'name' => array(
          'rules' => array('required', 'trim', 'unique', 'min_length' => 3, 'max_length' => 50),
          'label' => 'Ime žanra'
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
/* End of file genre.php */
/* Location: ./application/models/genre.php */