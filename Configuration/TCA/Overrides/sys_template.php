<?php

if (!defined('TYPO3')) {
    die('Access denied.');
}

(function() {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'twoclick',
        'Configuration/TypoScript',
        'TwoClick Template'
    );
})();
