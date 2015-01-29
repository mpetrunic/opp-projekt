<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_Add_book extends CI_Migration {

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
            'deed' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            'publication_year' => array(
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => TRUE,
                'null' => FALSE,
                'auto_increment' => FALSE
            ),
            'cover' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => FALSE,
                'default' => ''
            ),
            'page_number' => array(
                'type' => 'INT',
                'constraint' => 6,
                'unsigned' => FALSE,
                'null' => FALSE,
                'auto_increment' => FALSE,
                'default' => 0
            ),
            'price' => array(
                'type' => 'DECIMAL',
                'constraint' => '9,2',
                'unsigned' => TRUE,
                'default' => 0.0
            ),
            'pdf' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => FALSE,
                'default' => ''
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('books', TRUE);
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('books');
    }
}

/* End of file 001_add_Book.php */
/* Location: ./application/migrations/001_add_Book.php */