<?php

use App\Job;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //25 jobs each of type total 100 jobs creation
        for ($statusCount = 1; $statusCount<=4; $statusCount++){
            for ($jobCount = 1; $jobCount<=25; $jobCount++){
                $job = new Job();
                $job->customer_id   = 47; //phone 01304734666
                $job->title         = 'Job title '.$jobCount;
                $job->description   = 'Job description '.$jobCount;
                $job->address       = 'Address '.$jobCount;
                $job->service_id    = $jobCount;
                $job->day           = $jobCount;
                $job->budget        = 50+$jobCount;
                if ($statusCount == 1){
                    $job->status     = 'active';
                    $job->save();
                }elseif ($statusCount == 2){
                    $job->status     = 'completed';
                    $job->save();
                }elseif($statusCount == 3){
                    $job->status     = 'running';
                    $job->save();
                }else{
                    $job->status     = 'cancelled';
                    $job->save();
                    $cancelJob = new \App\CancelJob();
                    $cancelJob->canceller_id = 47;
                    $cancelJob->job_id = $job->id;
                    $cancelJob->save();
                }
            }
        }
    }
}
