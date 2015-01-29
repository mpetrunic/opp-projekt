<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_company extends CI_Migration {

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
            'identification_number' => array(
                'type' => 'CHAR',
                'constraint' => 13,
                'null' => FALSE,
                'default' => ''
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 80,
                'null' => FALSE,
                'default' => ''
            ),
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('companies', TRUE);
        $this->db->query('ALTER TABLE companies ADD UNIQUE INDEX (identification_number)');
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('companies');
    }
}
/* End of file 006_add_company.php */
/* Location: ./application/migrations/006_add_company.php */