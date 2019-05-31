<?php
defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Application;
use Bitrix\Main\Loader;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\ModuleManager;
use Testjob\Date\DateTable;

Loc::loadMessages(__FILE__);

if (class_exists('testjobdate')) {
    return;
}

class testjobdate extends CModule
{
    /** @var string */
    public $MODULE_ID;

    /** @var string */
    public $MODULE_VERSION;

    /** @var string */
    public $MODULE_VERSION_DATE;

    /** @var string */
    public $MODULE_NAME;

    /** @var string */
    public $MODULE_DESCRIPTION;

    /** @var string */
    public $MODULE_GROUP_RIGHTS;

    /** @var string */
    public $PARTNER_NAME;

    /** @var string */
    public $PARTNER_URI;

    public function __construct()
    {
        $this->MODULE_ID = 'testjobdate';
        $this->MODULE_VERSION = '0.0.1';
        $this->MODULE_VERSION_DATE = '2019-05-31 0:23:14';
        $this->MODULE_NAME = Loc::getMessage('MODULE_NAME');
        $this->MODULE_DESCRIPTION = Loc::getMessage('MODULE_DESCRIPTION');
        $this->MODULE_GROUP_RIGHTS = 'N';
        $this->PARTNER_NAME = "Testjob";
        $this->PARTNER_URI = "http://www.testjob.ru";
    }

    public function doInstall()
    {
        ModuleManager::registerModule($this->MODULE_ID);
        $this->installDB();
        for ($i=0; $i < 3; $i++) { 
            $result = DateTable::add([
                "NAME" => "Элемент".$i
            ]);
            if (!$result->isSuccess()) {
                // throw new Exception("Ошибка при добавлении элементов!", 1);
                var_dump($result);
            }
        }
        $this->installFiles();
    }

    public function doUninstall()
    {
        $this->uninstallDB();
        ModuleManager::unregisterModule($this->MODULE_ID);
    }

    public function installDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            DateTable::getEntity()->createDbTable();
        }
    }

    public function uninstallDB()
    {
        if (Loader::includeModule($this->MODULE_ID)) {
            $connection = Application::getInstance()->getConnection();
            $connection->dropTable(DateTable::getTableName());
        }
    }

    public function installFiles()
    {
        CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/local/modules/testjobdate/install/components", $_SERVER["DOCUMENT_ROOT"]."/local/components", true, true);
    }
}
