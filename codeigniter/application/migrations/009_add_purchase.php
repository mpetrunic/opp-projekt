<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Add_purchase extends CI_Migration {

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
            'buyer' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'seller' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'purchase_price' => array(
                'type' => 'DECIMAL',
                'constraint' => '9,2',
                'unsigned' => TRUE,
                'default' => 0.0
            ),
            'certificate' => array(
                'type' => 'VARCHAR',
                'constraint' => 200,
                'null' => FALSE,
                'default' => ''
            ),
            'bookstore_provision' => array(
                'type' => 'DECIMAL',
                'constraint' => '9,2',
                'unsigned' => TRUE,
                'default' => 0.0
            ),
            'purchase_level' => array(
                'type' => 'SMALLINT'
            )
        ));
        $this->dbforge->add_field("created_on TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('purchases', TRUE);
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_table('purchases');
    }
}
/* End of file 009_add_purchase.php */
/* Location: ./applications/migrations/009_add_purchase.php */