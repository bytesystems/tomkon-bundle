<?php


use Contao\CoreBundle\DataContainer\PaletteManipulator;

$arrDca = &$GLOBALS['TL_DCA']['tl_member'];

$arrDca['list']['operations']['editContent'] = [
    'label' => &$GLOBALS['TL_LANG']['tl_member']['content'],
    'href'  => 'table=tl_content',
    'icon'  => 'article.gif'
];

//
PaletteManipulator::create()
    ->addLegend('hk_legend','personal_legend',PaletteManipulator::POSITION_AFTER)
    ->addField('hk_number', 'company', PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_member');

// Modify the palette
//$arrDca['palettes']['default'] = '{hk_legend},hk_number;' . $arrDca['palettes']['default'];

$arrDca['fields']['hk_number']
     = [
        'label'     => &$GLOBALS['TL_LANG']['tl_member']['hk_number'],
        'exclude'   => true,
        'inputType' => 'text',
        'eval'      => array('mandatory'=>false, 'maxlength'=>16,'tl_class'=>'w50'),
        'sql'       => "varchar(16) NOT NULL default ''"
    ];
//    'memberFiles' => [
//        'label'        => &$GLOBALS['TL_LANG']['tl_member']['memberFiles'],
//        'inputType'    => 'fieldpalette',
//        'foreignKey'   => 'tl_member_address.id',
//        'relation'     => ['type' => 'hasMany', 'load' => 'eager'],
//        'sql'          => "blob NULL",
//        'eval'         => ['tl_class' => 'clr'],
//        'fieldpalette' => [
//            'config'   => [
//                'hidePublished' => false,
//                'table'         => 'tl_member_address',
//            ],
//            'list'     => [
//                'label' => [
//                    'fields' => ['city'],
//                    'format' => '%s',
//                ],
//            ],
//            'palettes' => [
//                'default' => '{contact_legend},phone,fax;{address_legend},company,street,street2,postal,city,state,country,addressText',
//            ],
//        ],
//    ],
