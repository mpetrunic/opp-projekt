<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_bookstore extends CI_Migration {

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
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => FALSE,
                'default' => ''
            ),
            'company' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
            'user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('bookstores', TRUE);
    }


    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('bookstores');
    }
}
/* End of file 007_add_bookstore.php */
/* Location: ./application/migrations/007_add_bookstore.php */