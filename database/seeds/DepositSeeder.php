<?php

use Illuminate\Database\Seeder;

class DepositSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Deposit::class,100)->create()->each(function ($item) {
            factory(\App\Transaction::class)->create([
                'deposit_id' => $item->id,
                'date' => $item->created_at
            ]);
        });
        $endDate = \Carbon\Carbon::now();
        for ($i = \Carbon\Carbon::now()->addYears(-1) ; $endDate->gte($i) ;$i->addDay()) {
            \Artisan::call('calculate:deposit', [
                'date' => $i->toDateString()
            ]);
            \Artisan::call('calculate:service', [
                'date' => $i->toDateString()
            ]);

        }

    }
}
