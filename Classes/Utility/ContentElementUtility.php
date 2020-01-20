<?php

    namespace KALA\Celements\Utility;

    use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
    use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

    class ContentElementUtility
    {
        const TEMPLATES_ID = 1514;
        const PARTIALS_PATH = 'EXT:celements/Resources/Private/Partials/';
        const TEMPLATES_PATH = 'EXT:celements/Resources/Private/Templates/';
        const LAYOUTS_PATH = 'EXT:celements/Resources/Private/Layouts/';

        /**
         * call only from ext_tables || TCA Configuration
         *
         * @param string $name            Content element name (future template name)
         * @param string $icon            icon identifier or path
         * @param array $ceTypes          types array for content element
         * @param string $title           Plugin title shown in backend
         * @param string $description     Plugin description shown in backend
         * @param bool $dontShowSystemTab Hide default TYPO3 configuration in CE settings
         */
        public static function registerContentElement(
            $name,
            $icon = '',
            $ceTypes = [],
            $title = '',
            $dontShowSystemTab = false
        ) {
            $nameLowercase = strtolower($name);

            if (!$dontShowSystemTab && !isset($GLOBALS['TCA']['tt_content']['palettes']['icc_system'])) {
                $GLOBALS['TCA']['tt_content']['palettes']['icc_system'] = [
                    'label' => 'LLL:EXT:celements/Resources/Private/Language/locallang_be.xlf:tt_content.tabs.system',
                    'showitem' => 'CType,hidden,--linebreak--,starttime, endtime,--linebreak--, fe_group',
                ];
            }

            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(
                [
                    $title,
                    'celements_' . $nameLowercase,
                    //$icon,
                ],
                'CType',
                'celements'
            );

            if (!empty($ceTypes)) {
                if (!$dontShowSystemTab && false === strpos($ceTypes['showitem'], '--palette--;;icc_system')) {
                    $ceTypes['showitem'] .= (substr(
                            $ceTypes['showitem'],
                            -1
                        ) != ',' ? ',' : '') . '--div--;LLL:EXT:celements/Resources/Private/Language/locallang_be.xlf:tt_content.tabs.system,--palette--;;icc_system';
                }
                $GLOBALS['TCA']['tt_content']['types']['celements_' . $nameLowercase] = $ceTypes;
            }


        }

        public static function configureContentElement($identifier, $icon, $title, $description)
        {
            self::addToCEList($identifier, $icon, $title, $description);
            self::setupCE($identifier);
        }

        public static function getTemplatePaths()
        {
            return "
templateRootPaths." . self::TEMPLATES_ID . " = " . self::TEMPLATES_PATH . "               
partialRootPaths." . self::TEMPLATES_ID . " = " . self::PARTIALS_PATH . "               
layoutRootPaths." . self::TEMPLATES_ID . " = " . self::LAYOUTS_PATH . "               
";
        }

        public static function setupCE($identifier)
        {
            $nameLowercase = strtolower($identifier);

//            ExtensionManagementUtility::addPItoST43("celements_${nameLowercase}", '', '', 'CType');
            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScript(
                'celements_' . $nameLowercase,
                'setup',
                "tt_content.celements_${nameLowercase} =< lib.contentElement
tt_content.celements_${nameLowercase} {
    templateName = " . ucfirst(
                    $nameLowercase
                ) . "

" . self::getTemplatePaths() . "
}"
            );
        }

        public static function addToCEList($identifier, $icon, $title, $description)
        {
            $identifier = 'celements_' . strtolower($identifier);
            $content = self::wrap("\t\t\ttt_content_defValues {\n|\n\t\t\t}", "\t\t\t\tCType = ${identifier}");
            $content = self::wrap(
                "\t\t${identifier} {\n|\n\t\t}\n",
                "\t\t\ticonIdentifier = ${icon}\n\t\t\ttitle = ${title}\n\t\t\tdescription = ${description}\n${content}"
            );
            $content = self::wrap("\telements {\n|\n\t}\n", $content);
            $content .= "\tshow := addToList(${identifier})";

            \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
                self::wrap("mod.wizards.newContentElement.wizardItems.common {\n|\n}\n", $content)
            );
        }

        public static function wrap($parts, $content)
        {
            return str_replace('|', $content, $parts);
        }
    }