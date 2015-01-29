<?php

class Migration_Add_admin_user extends CI_Migration {

    public function up() {
        $admin = new User();
        $admin->username = "admin";
        $admin->password = "admin";
        $admin->confirm_password = "admin";
        $admin->name = "Admin";
        $admin->surname = "Administrator";
        $admin->nickname = "admin";
        $admin->email = "admin@marinpetrunic.com";
        $admin->privilege = "admin";
        $admin->validate()->save();
    }

    public function down() {
        $admin = new User();
        $admin->where('username', 'admin')->get()->delete();

    }
}
/* End of file 012_add_admin_user.php */
/* Location: ./application/migrations/012_add_admin_user.php */