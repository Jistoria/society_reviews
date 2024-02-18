<?php

namespace App\Console\Commands;

use App\Models\Tag;
use Illuminate\Console\Command;

class CreateDefaultsTags extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:tags';

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
        $tags = [
            'Isekai',
            'Comedia',
            'Gore',
            'Slice of Life',
            'Romance',
            'Acción',
            'Yuri',
            'Ecchi'
        ];
        foreach($tags as $tag){
                Tag::firstOrCreate(['name_tag' => $tag]);
                $this->info("El tag '$tag' ha sido creado correctamente.");
        }
    }
}
