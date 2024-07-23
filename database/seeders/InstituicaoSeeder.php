<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Instituicao;
use App\Models\User;

class InstituicaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $users = User::all();
      foreach ($users as $user) {
        for ($i=1; $i<=2 ; $i++) {
          factory(Instituicao::class)->create([
            'endereco_id' => $i,
            'user_id' => $user->id,
          ]);
        }
      }
    }
}
