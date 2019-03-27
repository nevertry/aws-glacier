<?php

return [
    'accountId' => getenv('AWS_ACCOUNT_ID'),
    'version'=> 'latest',
    'region' => getenv('AWS_REGION'),
    'credentials' => [
        'key'    => getenv('AWS_KEY'),
        'secret' => getenv('AWS_SECRET'),    
    ],
    'vaultName' => getenv('AWS_VAULT_NAME'),
];
