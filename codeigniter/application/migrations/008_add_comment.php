<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_comment extends CI_Migration {

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
            'book' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'content' => array(
                'type' => 'TEXT',
                'null' => FALSE,
                'default' => ''
            ),
            'mark' => array(
                'type' => 'SMALLINT'
            )
        ));
        $this->dbforge->add_field("created_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('comments', TRUE);
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('comments');
    }

}
/* End of file 008_add_comment.php */
/* Location: ./application/migrations/008_add_comment.php */