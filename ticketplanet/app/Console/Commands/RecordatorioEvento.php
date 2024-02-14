<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Session;
use App\Models\Compra;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\DescargaEntradasMail;

class RecordatorioEvento extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recordatorio-evento';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'algo';

    /**
     * Execute the console command.
     */
    public function handle()
    {
      $sessions = $this->obtenerSessiones();
       foreach($sessions as $session){
             foreach($session->compras as $compra){
               Mail::to($compra->emailPurchaser)->send(new DescargaEntradasMail($compra->pdfTickets));
             }
        }

    }

    private function obtenerSessiones()
    {
        $hoy = Carbon::now();
        $diaSiguiente = $hoy->copy()->addDay()->toDateString();

        return Session::where('date', $diaSiguiente)->get();
    }
}
