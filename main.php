<?php

require_once __DIR__ .'/vendor/autoload.php';

// load: phpdotenv
$dotenv = Dotenv\Dotenv::create(__DIR__);
$dotenv->load();

// load: Greet
// $greet = new App\Playground\Sample\Greet();
// $greet->hello();

// run
// echo getenv('AWS_REGION');
// echo base_path('config/aws.php');

// --- Backup
$backup = new App\Playground\Files\Backup;

// upload($backup);
// echo $backup->getInventory('test-content');

// -- Get List Jobs
// echo print_r($backup->doListJobs()->get('JobList'), true);
// var_dump($backup->doListJobs());
$jobId = 'L1CmZKgJ-X2sbMuzmOt7as48LxoV0sJc47eY0hsz4aKfdkANDL9Sx1_TUkY12feXapT8kSbIPsgE33iCsn42i6eu05ps';
jobDetail($backup, $jobId);

// -- Get Job Output
// echo $backup->doGetJobOutput($jobId);

// Upload
function upload($worker)
{
    $filePath = base_path('dummy/test-content.txt');
    $upload = $worker->upload($filePath);
    echo "Archive ID: {$upload->get('archiveId')}" . lf();
}

// Get Job Detail
function jobDetail($worker, $jobId)
{
    echo "Job detail of JobId: [{$jobId}]" . lf() . print_r($worker->doListJobs()->search('JobList[?JobId==`'.$jobId.'`] | [0]'), true). lf();
}

