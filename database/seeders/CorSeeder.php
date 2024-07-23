<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cor;
use App\Models\RandomColor;

class CorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cores = RandomColor::many(100, array('luminosity'=>'bright'));

      for ($i=0; $i < 100; $i++) {
        factory(Cor::class)->create([
          'hexadecimal' => $cores[$i],
        ]);
      }
    }
}
