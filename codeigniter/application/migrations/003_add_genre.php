<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_genre extends CI_Migration {

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
                'unique_index' => TRUE,
                'default' => ''
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->add_key('name');
        $this->dbforge->create_table('genres', TRUE);
        $this->db->query('ALTER TABLE genres ADD UNIQUE INDEX (name)');
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('genres');
    }
}
/* End of file 003_add_genre.php */
/* Location: ./application/migrations/003_add_genre.php */