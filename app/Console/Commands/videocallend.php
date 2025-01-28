<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\VideoCall;
use Carbon\Carbon;

class videocallend extends Command
{
    /*** The name and signature of the console command.** @var string*/
    protected $signature = 'videocallend:cron';

    /*** The console command description.** @var string */
    protected $description = 'Command description';

    /*** Create a new command instance.** @return void */
    public function __construct()
    {
        parent::__construct();
    }

    /*** Execute the console command.** @return int */
    public function handle()
    {  
        $i = 0;
       while ( $i<= 1) 
       {
          $user = VideoCall::where('status',1)->where('call_time', '<=', Carbon::now()->subSeconds(30)->toDateTimeString())->get();

          $count_items = count($user);
          for($i = 0; $i<$count_items; $i++)
          {
                $user[$i]->update([
                'status' => 5,
                'status_type' => 'not_attend',
                'type' => Null,
                'message' => "Not attend"
                ]);
          }
          $i++;
       }
    }
}
