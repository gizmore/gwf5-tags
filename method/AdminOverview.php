<?php
final class Tags_AdminOverview extends GWF_Method
{
	public function execute()
	{
		return $this->templatePHP('admin_overview.php');
	}
}
