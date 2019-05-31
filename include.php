<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Loader;
use Bitrix\Main\EventManager;

Loader::registerAutoLoadClasses('testjobdate', array(
    'Testjob\Date\DateTable' => 'lib/DateTable.php',
));
