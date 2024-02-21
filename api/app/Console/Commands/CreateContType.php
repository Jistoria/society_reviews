<?php

namespace App\Console\Commands;

use App\Models\ContentType;
use Illuminate\Console\Command;

class CreateContType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:cont-type';

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
        //
        $c_types = ['temporada','pelicula','ova','especiales','spin off'];
        foreach($c_types as $c_type){
            ContentType::firstOrCreate(['type'=>$c_type]);
            $this->info("El tipo '$c_type' ha sido creado correctamente.");
        }

    }
}
