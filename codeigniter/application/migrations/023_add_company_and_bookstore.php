<?php

class Migration_Add_company_and_bookstore extends CI_Migration {

    public function up() {
        $this->load->dbforge();
        $this->dbforge->drop_column("bookstores","user");
        $this->dbforge->drop_column("bookstores","company");
        $this->dbforge->add_column("bookstores", array(
            "company_id" => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
            )
        ));
        $companie = new Company();
        $companie->identification_number = "4408871929248";
        $companie->name = "Otrip d.o.o";
        $companie->save();
        $bookstore = new BookStore();
        $bookstore->name = "O3p Knjižara";
        $bookstore->save($companie);
    }

    public function down() {
        $this->load->dbforge();
        $this->dbforge->add_column("bookstores", array(
            'user' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'null' => TRUE,
            )
        ));
        $bookstore = new BookStore();
        $bookstore->where("name", "O3p Knjižara")->get()->delete();
        $companie = new Company();
        $companie->where("identification_number", "4408871929248")->get()->delete();

    }
}
/* End of file 023_add_company_and_bookstore.php */
/* Location: ./application/migrations/023_add_company_and_bookstore.php */