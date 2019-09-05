<?php

// Modify the palette
$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace
(
',company,',
',hk_number,company',
$GLOBALS['TL_DCA']['tl_member']['palettes']['default']
);

// Add the field meta data
$GLOBALS['TL_DCA']['tl_member']['fields']['hk_number'] = array
(
'label'     => &$GLOBALS['TL_LANG']['tl_member']['hk_number'],
'exclude'   => true,
'inputType' => 'text',
'eval'      => array('mandatory'=>false, 'maxlength'=>16,'tl_class'=>'w50'),
'sql'       => "varchar(16) NOT NULL default ''"
);
