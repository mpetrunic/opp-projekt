<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_deed extends CI_Migration {

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
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => FALSE,
                'unique' => TRUE,
                'default' => ''
            ),
            'content' => array(
                'type' => 'TEXT',
                'null' => FALSE,
                'default' => ''
            ),
            'author' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            'genre' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('title');
        $this->dbforge->create_table('deeds', TRUE);
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('deeds');
    }

}

/* End of file 002_add_deed.php */
/* Location: ./application/migrations/002_add_deed.php */