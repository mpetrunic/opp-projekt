<?php

class Migration_Add_user_salt_column extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->add_column('users', array(
           'salt' => array(
               'type' => 'VARCHAR',
               'constraint' => 32,
               'null' => TRUE,
               'default' => ''
           )
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column('users', 'salt');
    }
}
/* End of file 011_add_user_salt_column.php */
/* Location: ./application/migrations/011_add_user_salt_column.php */