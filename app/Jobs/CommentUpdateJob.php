<?php

namespace App\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Comentario;
use App\Models\Review;

class CommentUpdateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable;
    protected $comentario;

    public function __construct(Comentario $comentario)
    {
        $this->comentario = $comentario;
    }

    public function handle()
    {
        info('hola'.$this->comentario);
        //comentario  
        $this->comentario->save();      
    }
}
