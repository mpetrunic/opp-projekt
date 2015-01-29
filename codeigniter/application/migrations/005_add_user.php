<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_user extends CI_Migration {

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
                'constraint' => 70,
                'null' => FALSE,
                'default' => ''
            ),
            'nickname' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
                'default' => ''
            ),
            'username' => array(
                'type' => 'VARCHAR',
                'constraint' => 50,
                'null' => FALSE,
                'default' => ''
            ),
            'email' => array(
                'type' => 'VARCHAR',
                'constraint' => 100,
                'null' => FALSE,
                'default' => ''
            ),
            'password' => array(
                'type' => 'VARCHAR',
                'constraint' => 40,
                'null' => FALSE,
                'default' => ''
            ),
            'privilege' => array(
                'type' => 'VARCHAR',
                'constraint' => 20,
                'null' => FALSE,
                'default' => 'korisnik'
            )

        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users', TRUE);
        $this->db->query('ALTER TABLE users ADD UNIQUE INDEX (nickname)');
        $this->db->query('ALTER TABLE users ADD UNIQUE INDEX (username)');
        $this->db->query('ALTER TABLE users ADD UNIQUE INDEX (email)');
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('users');
    }

}
/* End of file 005_add_user.php */
/* Location: ./application/migrations/005_add_user.php */