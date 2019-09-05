<?php

\Controller::loadLanguageFile('tl_fieldpalette');
\Controller::loadDataContainer('tl_fieldpalette');
\Controller::loadDataContainer('tl_member');

$GLOBALS['TL_DCA']['tl_member_address'] = $GLOBALS['TL_DCA']['tl_fieldpalette'];
$dca                                    = &$GLOBALS['TL_DCA']['tl_customer_files'];

