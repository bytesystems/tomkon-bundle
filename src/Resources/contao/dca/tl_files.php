<?php
$dc = &$GLOBALS['TL_DCA']['tl_files'];

if (Input::get('do') == 'member') {
    $GLOBALS['TL_DCA']['tl_files']['config']['ptable']                = 'tl_member';
    $GLOBALS['TL_DCA']['tl_files']['list']['sorting']['headerFields'] = ['firstname', 'lastname', 'username', 'email'];
}
