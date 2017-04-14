<?php

defined('TYPO3_MODE') or die();

$_LLL = 'LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf';

return [
    'ctrl' => [
        'title' => 'LLL:EXT:invoicr/Resources/Private/Language/locallang_db.xlf:tx_invoicr_domain_model_item',
        'label' => 'sku',
        'label_alt' => 'title',
        'label_alt_force' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'dividers2tabs' => true,

        'versioningWS' => 2,
        'versioning_followPages' => true,

        'hideTable' => true,

        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'sku,title,description,quatity,price,',
        'iconfile' => 'EXT:invoicr/Resources/Public/Icons/tx_invoicr_domain_model_item.gif'
    ],
    'interface' => [
        'showRecordFieldList' => 'sys_language_uid, l10n_parent, l10n_diffsource, hidden, sku, title, description, quantity, price, tax, invoice',
    ],
    'types' => [
        '1' => ['showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, sku, title, description, quantity, price, tax, invoice, --div--;LLL:EXT:cms/locallang_ttc.xlf:tabs.access, starttime, endtime'],
    ],
    'palettes' => [
        '1' => ['showitem' => 'description'],
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
        'sku' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_item.sku',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim, reu'
            ],
        ],
        'title' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_item.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim'
            ],
        ],
        'description' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_item.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim',
                'wizards' => [
                    'RTE' => [
                        'icon' => 'wizard_rte2.gif',
                        'notNewRecords' => 1,
                        'RTEonly' => 1,
                        'title' => 'LLL:EXT:cms/locallang_ttc.xlf:bodytext.W.RTE',
                        'type' => 'script',
                        'module' => [
                            'name' => 'wizard_rte',
                        ],
                    ]
                ]
            ],
        ],
        'quantity' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_item.quantity',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'price' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_item.price',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'tax' => [
            'exclude' => 1,
            'label' => $_LLL . ':tx_invoicr_domain_model_item.tax',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'double2'
            ]
        ],
        'invoice' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
    ],
];
