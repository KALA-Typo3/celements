<?php

if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
call_user_func(function(){
    $additionalFields = [
        'tx_celements_layout' => [
            'label' => 'Layout',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['',''],
                ],
            ]
        ],
    ];
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('tt_content', $additionalFields);

    function addVideoContentElement() {
        $types = [
            'showitem' => '--div--;LLL:EXT:celements/Resources/Private/Language/locallang_be.xlf:tt_content.video.tabName, 
                    header,header_layout, tx_celements_layout,
                    media',
            'columnsOverrides' => [
                'bodytext' => [
                    'config' => [
                        'enableRichtext' => true,
                    ],
                ],
                'tx_celements_layout' => [
                    'config' => [
                        'items' => [
                            [
                                'LLL:EXT:celements/Resources/Private/Language/locallang_be.xlf:tt_content.video.layout.normal',
                                ''
                            ],
                            [
                                'LLL:EXT:celements/Resources/Private/Language/locallang_be.xlf:tt_content.video.layout.fluid',
                                'fluid'
                            ],
                        ]
                    ]
                ],
                'media' => [
                    'config' => [
                        'maxitems' => '1',
                    ],
                ],
            ],
        ];

        \KALA\Celements\Utility\ContentElementUtility::registerContentElement(
            'IccVideo',
            'content-media',
            $types,
            "LLL:EXT:celements/Resources/Private/Language/locallang_be.xlf:tt_content.video.ce.title"
        );
    }

    addVideoContentElement();
});
