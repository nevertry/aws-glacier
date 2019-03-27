<?php

namespace App\Playground\Files;

use Aws\Glacier\GlacierClient;

Class Backup {
    public $client;
    private $config;

    public function __construct()
    {
        $this->client = GlacierClient::factory($this->getConfig());
    }

    /**
     * Get Configuration from base path
     */
    private function getConfig($configFile = 'config/aws.php')
    {
        $this->config = include(base_path($configFile));
        return $this->config;
    }

    public function listVault()
    {
        $command = $this->client->getCommand('ListVaults');
        $request = \Aws\serialize($command);

        var_dump($request);
    }

    public function listJobs()
    {
        $result = $this->client->listJobs(array('vaultName' => 'foo'));
        $array = $result->get('JobList');
        //Creates an array with metadata regarding your jobs
        print_r($array);
    }

    public function describeVault()
    {
        $result = $this->client->describeVault([
            'vaultName' => $this->config['vaultName'],
        ]);

        var_dump($result->__toString());

        // $command = $this->client->getCommand('UploadArchive', [
        //     'vaultName' => $this->config['vaultName'],
        // ]);

        // $request = \Aws\serialize($command);

        // print_r($request);
    }

    /**
     * test
     */
    public function test()
    {
        $command = $this->client->getCommand('UploadArchive', [
            'vaultName'  => 'foo',
            'sourceFile' => __DIR__ . '/test-content.txt',
        ]);

        $request = \Aws\serialize($command);

        print_r($request);
    }
}