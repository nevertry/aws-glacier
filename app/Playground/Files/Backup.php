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
     * 
     * @param string $configFile
     * @return Array
     */
    private function getConfig($configFile = 'config/aws.php')
    {
        $this->config = include(base_path($configFile));
        return $this->config;
    }

    /**
     * Set config manually
     * 
     * @param Array $configs
     */
    public function setConfig($configs)
    {
        $this->config = $configs;
    }

    /**
     * List Jobs
     */
    public function listJobs()
    {
        return $this->client->listJobs([
            'vaultName' => $this->config['vaultName']
        ]);
    }

    /**
     * Describe Vault
     */
    public function describeVault()
    {
        return $this->client->describeVault([
            'vaultName' => $this->config['vaultName'],
        ]);
    }

    /**
     * Upload to vault and get archive ID.
     * 
     * @param string $filePath
     */
    public function upload($filePath)
    {
        $result = $this->client->uploadArchive([
            'vaultName' => $this->config['vaultName'],
            'sourceFile' => $filePath,
        ]);

        return $result;
    }

    /**
     * Initiate job to get Inventory
     * 
     * @param string $description
     */
    public function getInventory($description='')
    {
        $result = $this->client->initiateJob([
            'vaultName' => $this->config['vaultName'],
            'jobParameters' => [
                'Description' => $description,
                'Type' => 'inventory-retrieval',
            ],
        ]);

        return $result;
    }

    public function doListJobs()
    {
        $result = $this->client->listJobs([
            'vaultName' => $this->config['vaultName'],
        ]);

        return $result;
    }

    /**
     * Get job output by Job ID.
     * 
     * @param string $jobId
     */
    public function doGetJobOutput($jobId)
    {
        $result = $this->client->getJobOutput([
            'vaultName' => $this->config['vaultName'],
            'jobId' => $jobId,
        ]);

        return $result;
    }

    /**
     * Send any glacier command with custom parameters.
     * 
     * @param string $commandName
     * @param array (optional) $commandParamaters
     * @return \Aws\serialize(\Aws\Result)
     */
    public function command($commandName, $commandParameters=[])
    {
        $command = $this->client->getCommand($commandName, $commandParameters);

        $request = \Aws\serialize($command);

        return $request;
    }
}