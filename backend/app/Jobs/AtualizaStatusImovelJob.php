<?php

namespace App\Jobs;

use App\Models\Imovel;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AtualizaStatusImovelJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $imovel;
    protected $contratado;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Imovel $imovel, $contratado = false)
    {
        $this->imovel = $imovel;
        $this->contratado = $contratado;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->contratado)
            $this->imovel->status = Imovel::STATUS_CONTRATADO;

            $this->imovel->save();
    }
}
