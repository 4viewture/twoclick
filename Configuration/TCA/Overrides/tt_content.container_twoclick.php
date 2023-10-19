<?php

\TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\B13\Container\Tca\Registry::class)->configureContainer(
    (
    new \B13\Container\Tca\ContainerConfiguration(
        'container_ce_twoclick', // CType
        'LLL:EXT:twoclick/Resources/Private/Language/locallang_be.xlf:ce_twoclick_container.title', // label
        'LLL:EXT:twoclick/Resources/Private/Language/locallang_be.xlf:ce_twoclick_container.description', // description
        [
            [
                ['name' => 'LLL:EXT:twoclick/Resources/Private/Language/locallang_be.xlf:ce_twoclick_container.name', 'colPos' => 10000],
            ],
        ] // grid configuration
    )
    )
        // set an optional icon configuration
        ->setIcon('EXT:twoclick/Resources/Public/Icons/Extension.svg')
        ->setGroup('LLL:EXT:twoclick/Resources/Private/Language/locallang_be.xlf:ce_twoclick_container.name')
);


$GLOBALS['TCA']['tt_content']['types']['container_ce_twoclick']['showitem'] = implode(
    ',',
    [
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general',
        '--palette--;;general, header;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:header.ALT.div_formlabel',
        'bodytext;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:bodytext_formlabel',
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.images',
        'image',
        '--div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance',
        '--palette--;;frames',
        '--palette--;;appearanceLinks',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language',
        '--palette--;;language',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access',
        '--palette--;;hidden',
        '--palette--;;access',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories',
        'categories',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes',
        'rowDescription',
        '--div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended',
        ''
    ]
);
