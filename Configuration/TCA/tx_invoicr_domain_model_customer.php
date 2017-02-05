<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => 'LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf:tx_invoicr_domain_model_customer',
        'label' => 'number',
        'label_alt' => 'company, contact',
        'label_alt_force' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'versioningWS' => 2,
        'versioning_followPages' => true,

        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'number,',
        'iconfile' => 'EXT:invoicr/Resources/Public/Icons/tx_invoicr_domain_model_item.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, number, company, contact, address, mandates',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, number, company, contact, address, mandates, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => ''],
    ],
    'columns' => [
        't3ver_label' => [
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ]
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.hidden',
            'config' => [
                'type' => 'check',
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'l10n_mode' => 'mergeIfNotBlank',
            'label' => 'LLL:EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'size' => 13,
                'max' => 20,
                'eval' => 'datetime',
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, date('m'), date('d'), date('Y'))
                ],
            ],
        ],
        'number' => [
            'exclude' => 0,
            'label' => $_LLL . ':tx_invoicr_domain_model_customer.number',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'company' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_customer.company',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_contacts_domain_model_company',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'contact' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_customer.contact',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_contacts_domain_model_contact',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'address' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_customer.address',
            'config' => [
                'type' => 'select',
                'items' => [
                    ['', 0],
                ],
                'foreign_table' => 'tx_contacts_domain_model_address',
                'size' => 1,
                'minitems' => 0,
                'maxitems' => 1,
            ],
        ],
        'mandates' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_customer.mandates',
            'config' => [
                'type' => 'inline',
                'foreign_table' => 'tx_invoicr_domain_model_mandate',
                'foreign_field' => 'customer',
                'maxitems' => 9999,
                'foreign_sortby' => 'sorting',
                'appearance' => [
                    'collapseAll' => 1,
                    'levelLinksPosition' => 'top',
                    'showSynchronizationLink' => 1,
                    'showPossibleLocalizationRecords' => 1,
                    'showAllLocalizationLink' => 1,
                    'useSortable' => 1,
                    'useCombination' => 1,
                    'newRecordLinkPosition' => 'bottom',
                ],
            ],
        ],
        'invoices' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],

    ],
];
