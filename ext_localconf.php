<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Extcode.' . $_EXTKEY,
    'Invoice',
    [
        'Invoice' => 'list, show, download',
    ],
    // non-cacheable actions
    [
        'Invoice' => 'create, update, delete, ',
    ]
);
