<?php

class Comment extends DataMapper {

    // Insert related models that  Comment can have just one of.
    var $has_one = array('book', 'user');


    //comment created timestamp
    var $created_field = 'created_on';

    var $local_time = TRUE;

    var $timestamp_format = 'Y-m-d H:i:s';

    var $unix_timestamp = false;

    var $auto_populate_has_one = TRUE;

    var $validation = array(
        'content' => array(
            'rules' => array('required', 'trim', 'min_length' => 3),
            'label' => 'Komentar'
        ),
        'mark' => array(
            'rules' => array('greater_than' => 0, 'less_than' => 11),
            'label' => 'Ocjena'
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

    function getAvgMark(Book $book) {
        $comments = $this->where("book_id", $book->id)->get_iterated();
        $count = 0;
        $total = 0;
        foreach($comments as $comment) {
            $count++;
            $total += $comment->mark;
        }
        if($count == 0) {
            return null;
        }
        return number_format($total/$count,1, '.', ',');
    }

}
/* End of file comment.php */
/* Location: ./application/models/comment.php */