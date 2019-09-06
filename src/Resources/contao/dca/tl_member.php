<?php


use Contao\CoreBundle\DataContainer\PaletteManipulator;

\Controller::loadLanguageFile('tl_files');
\Controller::loadDataContainer('tl_files');

$arrDca = &$GLOBALS['TL_DCA']['tl_member'];

PaletteManipulator::create()
    ->addLegend('hk_legend','personal_legend',PaletteManipulator::POSITION_AFTER)
    ->addField('hk_number', 'hk_legend', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_member');

$arrDca['fields']['hk_number']
     = [
        'label'     => &$GLOBALS['TL_LANG']['tl_member']['hk_number'],
        'exclude'   => true,
        'inputType' => 'text',
        'eval'      => array('mandatory'=>false, 'maxlength'=>16,'tl_class'=>'w50'),
        'sql'       => "varchar(16) NOT NULL default ''"
    ];
