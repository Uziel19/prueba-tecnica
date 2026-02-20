<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Helpers\AesHelper;
use Illuminate\Support\Str;

class InitialUserSeeder extends Seeder
{
    public function run()
    {

        $consent_id2 = Str::random(30);
        $consent_id3 = Str::random(30);

        User::create([
            'user' => 'testuser',
            'name' => 'Usuario Test',
            'phone' => '5551234567',
            'password' => 'password123',
            'consent_id2' => $consent_id2,
            'consent2_status' => true,
            'consent_id3' => $consent_id3,
            'consent3_status' => true,
        ]);
    }
}
