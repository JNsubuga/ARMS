<?php

namespace App\Console\Commands;

use App\Models\Healthyhistory;
use Illuminate\Console\Command;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Http;

class DueDateCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'duedate:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**Add by Joe
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
     * @return int
     */
    public function handle()
    {
        info("Cron Job running at " . now());
        /* */
        $response = Http::get('https://jsonplaceholder.typicode.com/healthyhistories');

        $healthyhistories = $response->json();

        if (!empty($healthyhistories)) {
            $toAlerts = Healthyhistory::all();
            foreach ($toAlerts as $key => $toAlert) {
                $toDe = date('Ymd', strtotime(now()));
                $DoR = date('Ymd', strtotime($toAlert['DoR']));
                $leftDeis = $DoR - $toDe;
                if ($leftDeis <= 7) {
                    return redirect(route('healthyhistory.index'))->with('The daet is due!!! Please take action!!');
                }
            }
        }
        return 0;
    }
}
