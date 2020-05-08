<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Model\Omoide;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send omoide by email';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $omoide = Omoide::inRandomOrder()->first();
        Mail::send(['text'=>'emails.omoide_mail'],['omoide'=>$omoide],function($message){
            $message
                ->to(env('MAIL_TO'))
                ->subject('本日の思い出メール');
        });
        $omoide->fill(['notified_at'=>date('Y-m-d H:i:s')])->save();
    }
}
