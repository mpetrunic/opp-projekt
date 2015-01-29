<?php

class Migration_Remove_extra_tables extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->drop_table("books_comments");
        $this->dbforge->drop_table("books_purchases");
        $this->dbforge->drop_table("users_purchases");
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'book_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            'comment_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('books_comments', TRUE);
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'book_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            'purchase_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('books_purchases', TRUE);
        $this->dbforge->add_field(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => TRUE
            ),
            'seller_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'purchase_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users_purchases', TRUE);
    }
}
/* End of file 024_remove_extra_tables.php */
/* Location: ./application/migrations/024_remove_extra_tables.php */