<?php

namespace App\Console\Commands;

use App\Models\Bus;
use App\Models\Driver;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class setDrivers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:set-drivers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $response=DB::transaction(function () {

            $bus = Bus::all();
            $driver=Driver::all();
            foreach ($bus as $busssss) {
                $data=['driver_id'=>$driver->random()->id];
                $busssss->update($data);
            }
        });
        $this->info('Random drivers have been assigned to all buses successfully.');


        //
    }
}
