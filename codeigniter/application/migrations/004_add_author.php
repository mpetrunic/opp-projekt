<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_author extends CI_Migration {

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
                'constraint' => 50,
                'null' => FALSE,
                'default' => ''
            ),
            'surname' => array(
                'type' => 'VARCHAR',
                'constraint' => 60,
                'null' => FALSE,
                'default' => ''
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('authors', TRUE);
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('authors');
    }
}
/* End of file 004_add_author.php */
/* Location: 004_add_author.php */ 