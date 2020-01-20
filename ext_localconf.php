<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
call_user_func(function(){
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:celements/Configuration/TypoScript/setup.typoscript">');

    // Adds content elements to ce selection
    \KALA\Celements\Utility\ContentElementUtility::configureContentElement('IccVideo', 'content-media', "LLL:EXT:celements/Resources/Private/Language/locallang_be.xlf:tt_content.video.ce.title", "LLL:EXT:celements/Resources/Private/Language/locallang_be.xlf:tt_content.video.ce.description");
});
