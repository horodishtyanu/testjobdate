<?php
namespace Testjob\Date;

defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();

use Bitrix\Main\Entity\DataManager;
use Bitrix\Main\Entity\IntegerField;
use Bitrix\Main\Entity\StringField;
use Bitrix\Main\Entity\Validator;
use Bitrix\Main;
use Bitrix\Main\ORM;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class DateTable extends DataManager
{
    public static function getTableName()
    {
        return 'testjob_table';
    }

    public static function getMap()
    {
        return array(
            new IntegerField('ID', array(
                'autocomplete' => true,
                'primary' => true,
                'title' => Loc::getMessage('ID'),
            )),
            new StringField('NAME', array(
                'required' => true,
                'title' => Loc::getMessage('NAME'),
                'default_value' => function () {
                    return Loc::getMessage('NAME_DEFAULT_VALUE');
                },
                'validation' => function () {
                    return array(
                        new Validator\Length(null, 255),
                    );
                },
            )),
            new ORM\Fields\DatetimeField('DATE_INSERT', array(
                'default_value' => function(){
                        return new Main\Type\DateTime();
                    },
                'title' => Loc::getMessage('DATE_INSERT'),
            )),
        );
    }
}
