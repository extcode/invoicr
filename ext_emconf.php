<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Invoicr',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Daniel Lorenz',
    'author_email' => 'ext.invoicr@extco.de',
    'author_company' => 'extco.de UG (haftungsbeschränkt)',
    'state' => 'alpha',
    'internal' => '',
    'uploadfolder' => '1',
    'createDirs' => '',
    'clearCacheOnLoad' => 0,
    'version' => '0.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-7.99.99',
            'php' => '5.4.0',
            'contacts' => '0.1.0',
            'tcpdf' => '0.2.0',
        ],
        'conflicts' => [
        ],
        'suggests' => [
        ],
    ],
];