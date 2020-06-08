<?php

use Illuminate\Database\Seeder;

class MineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('mine')->truncate();
        DB::table('mine')->insert([
            'name' => '田中太郎',
            'age' => '20',
        ]);
        DB::table('mine')->insert([
            'name' => '山田花子',
            'age' => '24',
        ]);
        DB::table('mine')->insert([
            'name' => '芥川龍之介',
            'age' => '48',
        ]);
        DB::table('mine')->insert([
            'name' => '松尾芭蕉',
            'age' => '75',
        ]);
        DB::table('mine')->insert([
            'name' => '斎藤一',
            'age' => '36',
        ]);
        DB::table('mine')->insert([
            'name' => '犬養毅',
            'age' => '68',
        ]);
        DB::table('mine')->insert([
            'name' => '伊藤博文',
            'age' => '48',
        ]);
        DB::table('mine')->insert([
            'name' => '後藤基',
            'age' => '31',
        ]);
        DB::table('mine')->insert([
            'name' => '前田圭太',
            'age' => '27',
        ]);
    }
}
