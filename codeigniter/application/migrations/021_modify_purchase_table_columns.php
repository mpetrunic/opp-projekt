<?php

class Migration_Modify_purchase_table_columns extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->drop_column("purchases", "book");
        $this->dbforge->drop_column("purchases", "buyer");
        $this->dbforge->drop_column("purchases", "created_on");
        $this->dbforge->add_column("purchases", array(
           "book_id" => array(
               'type' => 'INT',
               'constraint' => 11,
               'unsigned' => TRUE,
               'null' => TRUE,
               'auto_increment' => FALSE
           ),
            "buyer_id" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            "seller_id" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
                'auto_increment' => FALSE
            ),
            "created_on" => array(
                'type' => "DATETIME",
                'null' => false
            )
        ));
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->drop_column("purchases", "book_id");
        $this->dbforge->drop_column("purchases", "buyer_id");
        $this->dbforge->drop_column("purchases", "seller_id");
        $this->dbforge->drop_column("purchases", "created_on");
        $this->dbforge->add_column("purchases", array(
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
            'created_on' => array(
                'type' => 'TIMESTAMP'
            )
        ));
    }
}
/* End of file 021_modify_purchase_table_columns.php */
/* Location: ./application/migrations/021_modify_purchase_table_columns.php */