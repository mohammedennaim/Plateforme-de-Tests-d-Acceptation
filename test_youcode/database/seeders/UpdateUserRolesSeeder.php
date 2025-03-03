<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UpdateUserRolesSeeder extends Seeder
{
    public function run()
    {
        User::whereNull('role_id')->update(['role_id' => 2]); // 2 pour le rôle étudiant
    }
}