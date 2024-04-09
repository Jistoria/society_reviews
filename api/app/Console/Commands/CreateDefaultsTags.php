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
        $tags = [
            'Isekai' => 'Un género de anime y manga en el que los personajes principales son transportados o reencarnados en un mundo paralelo.',
            'Comedia' => 'Género que busca entretener y hacer reír al público a través de situaciones divertidas y diálogos humorísticos.',
            'Gore' => 'Contenido con escenas explícitas de violencia, sangre y mutilación.',
            'Slice of Life' => 'Se centra en momentos cotidianos de la vida de los personajes, sin tramas complejas o conflictos épicos.',
            'Romance' => 'Historias centradas en relaciones amorosas entre personajes.',
            'Acción' => 'Género que se caracteriza por secuencias emocionantes, peleas y confrontaciones.',
            'Yuri' => 'Relaciones románticas o sexuales entre mujeres en el anime y manga.',
            'Ecchi' => 'Contenido que sugiere situaciones sexuales de manera subida de tono, pero sin mostrar explícitamente actos sexuales.',
        ];

        foreach ($tags as $name => $description) {
            Tag::firstOrCreate([
                'name_tag' => $name,
                'description' => $description,
            ]);
            $this->info("El tag '$name' ha sido creado correctamente.");
        }
    }
}
