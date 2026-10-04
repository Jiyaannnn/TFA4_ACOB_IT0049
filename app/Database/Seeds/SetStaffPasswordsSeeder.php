<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class SetStaffPasswordsSeeder extends Seeder
{
    public function run(): void
    {
        $initialPassword = (string) getenv('TFA4_INITIAL_PASSWORD');
        if (strlen($initialPassword) < 12) {
            throw new \RuntimeException('Set TFA4_INITIAL_PASSWORD to at least 12 characters first.');
        }

        // Use this after importing the SQL export on another device.
        // Each staff member receives a valid hash; they can change it in the edit form.
        $hash = password_hash($initialPassword, PASSWORD_DEFAULT);
        $this->db->table('users')->where('id >', 0)->update(['password' => $hash]);
    }
}
