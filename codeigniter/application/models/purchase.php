<?php

class Purchase extends DataMapper {

    // Insert related models that Purchase can have just one of.
    var $has_one = array(
        'book' => array(
        ),
        'buyer' => array(
            'class' => 'user',
            'other_field' => 'purchases',
        ),
        'seller' => array(
            'class' => 'user',
            'other_field' => 'sells',
        )
    );


    var $auto_populate_has_one = TRUE;

    var $created_field = 'created_on';

    var $local_time = TRUE;

    var $timestamp_format = 'Y-m-d H:i:s';

    var $unix_timestamp = false;

    var $validation = array(
        'purchase_price' => array(
            'rules' => array(),
            'label' => 'Nabavna cijena'
        ),
        'certificate' => array(),
        'bookstore_provision' => array(
            'rules' => array(),
            'label' => 'Provizija knjižare'
        ),
        'purchase_level' => array(
            'rules' => array(),
            'label' => 'Razina stoga kupnje'
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

    public function get_bookstore_income() {
        $this->where("seller_id", null)->get();
        $income = 0;
        foreach($this->all as $purchase) {
            $income += $purchase->purchase_price;
        }
        return $income;
    }

    public function get_bookstore_provision() {
        $this->get();
        $income = 0;
        foreach($this->all as $purchase) {
            $income += $purchase->bookstore_provision;
        }
        return $income;
    }

}
/* End of file purchase.php */
/* Location: ./application/models/purchase.php */