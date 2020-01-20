<?php
$EM_CONF[$_EXTKEY] = array(
    'title' => 'celements',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Deividas Simas',
    'author_email' => 'deividas.simas@insignio.de',
    'author_company' => 'Insignio CRM GmbH',
    'shy' => false,
    'priority' => false,
    'module' => false,
    'state' => 'stable',
    'internal' => null,
    'uploadfolder' => '0',
    'createDirs' => '',
    'modify_tables' => '',
    'clearCacheOnLoad' => 0,
    'lockType' => '',
    'version' => '0.1.0',
    'constraints' => array(
        'depends' => array(
            'extbase' => '6.2',
            'fluid' => '6.2',
            'typo3' => '7.0.0-9.9.999',
        ),
        'conflicts' => array(
        ),
        'suggests' => array(
        ),
    ),
    'autoload' => array(
        'psr-4' => array(
            'KALA\\Celements\\' => 'Classes'
        ),
    ),
);