<?php

class Migration_Add_book_purchase_table extends CI_Migration {

    public function up() {
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
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('books_purchases');
    }
}
/* End of file 013_add_book_purchase_table.php */
/* Location: ./application/migrations/013_add_book_purchase_table.php */