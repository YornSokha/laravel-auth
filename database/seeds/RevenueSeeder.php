<?php

use Illuminate\Database\Seeder;

class RevenueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $riel = 9000;
        foreach (range(1, 300) as $index) {
            $start_date = '2015-12-31 00:00:00';
            $end_date = '2010-01-01 00:00:00';

            $min = strtotime($start_date);
            $max = strtotime($end_date);

            // Generate random number using above bounds
            $val = rand($min, $max);
            $riel += 1200;
            // Convert back to desired date format
            $start = new DateTime(date('Y-m-d H:i:s', $val));
            DB::table('mlmupc_accounting_revenues')->insert([
                'date_expense' => $start,
                'no_invoice' => '280-1' . sprintf("%'.09d\n", $index),
                'description' => $index . 'ទូទាត់ថ្លៃទិញទឹកថ្នាំ',
                'riel' => $riel,
                'payer' => ($index % 2 ) == 0 ? 'យ៉ន សុខា' : 'ណារ៉ា លីមេង',
                'revenue_type' => ($index % 2) == 0 ? 73023 : 73044,
                'owner' => ($index % 2 ) == 0 ? 'ផៃ សុផាត' : 'វ៉ន ប៊ុនធឿន',
                'organization' => ($index % 2) == 0 ? 'Car accessory Co.,LTD.' : 'សង្កាត់ទឹកល្អក់ ៣ ខ័ណ្ឌទួលគោក រាជធានីភ្នំពេញ',
            ]);
        }
    }
}
