<?defined('B_PROLOG_INCLUDED') and (B_PROLOG_INCLUDED === true) or die();?>

<?
if ($this->StartResultCache())
{
	if (!CModule::IncludeModule("testjobdate"))
	{
		$this->abortResultCache();
		ShowError("Модуль тестового задания не установлен!");
		return;
	}

	$ob = Testjob\Date\DateTable::GetList();
	while ($res = $ob->Fetch()) {
		$arResult[] = $res;
	}
	if ($arResult == null) {
		$this->abortResultCache();
	}
	$this->SetResultCacheKeys(['NAME', 'DATE_INSERT']);
	$this->includeComponentTemplate();
}
?>
