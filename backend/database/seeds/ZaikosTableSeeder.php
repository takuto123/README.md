<?php

use Illuminate\Database\Seeder;
use App\Models\Zaiko;

class ZaikosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   //0から１や２に数字を変更するとランダムで在庫名、金額、個数、詳細が入ります。
        factory(Zaiko::class,0)->create();
    }
}
