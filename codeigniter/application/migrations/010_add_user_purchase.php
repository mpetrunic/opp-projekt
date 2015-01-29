<?php

class Migration_Add_user_purchase extends CI_Migration {

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
            'seller_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            ),
            'purchase_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            )
        ));
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('users_purchases', TRUE);
        $this->dbforge->drop_column('purchases', 'seller');
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->add_column('purchases', array(
            'seller' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE
            )
        ));
        $this->dbforge->drop_table("users_purchases");
    }
}
/* End of file 010_add_user_purchase.php */
/* Location: ./application/migrations/010_add_user_purchase.php */