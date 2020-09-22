<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ExpenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $riel = 9000;
        $dollar = 400;
        $receivers = ['យ៉ន សុខា', 'ណារ៉ា លីមេង', 'ផៃ សុផាត'];
        foreach (range(1, 100) as $index) {
            $start_date = '2015-12-31 00:00:00';
            $end_date = '2010-01-01 00:00:00';

            $min = strtotime($start_date);
            $max = strtotime($end_date);

            // Generate random number using above bounds
            $val = rand($min, $max);
            $riel += 1200;
            $dollar += 200;
            // Convert back to desired date format
            $start = new DateTime(date('Y-m-d H:i:s', $val));
            DB::table('mlmupc_accounting_expenses')->insert([
                'date_expense' => $start,
                'no_letter' => '00'. $index .'ផសហ/ចណ',
                'description' => $index . 'ទូទាត់ថ្លៃទិញទឹកថ្នាំ',
                'expense_type' => rand(1, 2) == 1 ? 'G' : 'P',
                'dollar' => $dollar,
                'riel' => $riel,
                'reciever' => $receivers[rand(0, 2)],
            ]);
        }
    }
}
