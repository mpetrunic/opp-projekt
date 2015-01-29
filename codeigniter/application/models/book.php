<?php

/**
 * Class Book
 */
class Book extends DataMapper {

    // Insert related models that Book can have just one of.
    var $has_one = array('deed');

    // Insert related models that Book can have more than one of.
    var $has_many = array('purchase', 'comment');

    var $auto_populate_has_one = TRUE;

    var $created_field = 'created_on';

    var $local_time = TRUE;

    var $timestamp_format = 'Y-m-d H:i:s';

    var $unix_timestamp = false;

    var $validation = array(
        'publication_year' => array(
            'rules' => array('required'),
            'label' => 'godina izdanja'
        ),
        'page_number' => array(
            'rules' => array('required', 'greater_than' => 0),
            'label' => 'broj stranica'
        ),
        'price' => array(
            'rules' => array('required', 'greater_than' => 0),
            'label' => 'cijena knjige'
        ),
        'max_purchase_level' => array(
            'rules' => array('required', 'greater_than' => 1),
            'label' => 'broj razina stoga kupnje'
        ),
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

    function get_newest_books($limit = 10) {
        return $this->order_by("created_on", "DESC")->get($limit)->all;
    }

    function get_popular_books($limit = 10) {
        return $this->order_by("purchases_number", "DESC")->get($limit)->all;
    }

    function get_lowest_price() {
        $limit = $this->price * 0.5;
        $current_purchase_level = $this->get_current_purchase_level();
        return number_format((1/($this->max_purchase_level-$current_purchase_level)) * ($this->price-$limit)+$limit, 2, ",", '.');
    }

    function get_current_purchase_level() {
        $this->purchase->order_by("created_on", "DESC")->get();
        $current_purchase_level = $this->max_purchase_level-1;
        if($this->purchase->result_count() != 0) {
            $current_purchase_level =  $this->purchase->all[0]->purchase_level-1;
            if($current_purchase_level < 1) {
                return 1;
            }
        }
        return $current_purchase_level;
    }

    function get_current_seller() {
        $this->purchase->order_by("created_on", "DESC")->get();
        if($this->purchase->result_count() != 0) {
            return $this->purchase->all[0]->buyer;
        }
        return null;
    }

    function search($search_field = "name", $search_param = "") {
        switch($search_field) {
            case "autor" : {
                return $this->like_related("deed/author", "name", $search_param)
                    ->or_like_related("deed/author", "surname", $search_param)
                    ->get()->all;
            } break;
            case "zanr": {
                return $this->like_related("deed/genre", "name", $search_param)->get()->all;
            }break;
            case "godina" : {
                return $this->where("publication_year", $search_param)->get()->all;
            }break;
            default: {
                return $this->like_related_deed("title", $search_param)->get()->all;
            }
        }
    }
}
/* End of file book.php */
/* Location: ./application/models/book.php */