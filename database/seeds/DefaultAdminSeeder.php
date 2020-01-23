<?php

use Illuminate\Database\Seeder;

class DefaultAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\Models\User::class)->create([
            'name' => 'Eam.Watch Admin',
            'email' => 'admin@eam.watch',
            'password' => '$2y$10$VLXCs6sKybmlPstSSmRuBuHBon.5ab5v9lR.qawQA.G4JZ1ljdxWq'
        ]);
        $user->assignRole('admin');
    }
}