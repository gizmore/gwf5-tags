<?php
final class Tags_AdminOverview extends GWF_Method
{
	public function execute()
	{
		$tVars = array(
			'navbar' => Module_Tags::instance()->tagsNavbar(),
		);
		return $this->templatePHP('overview.php', $tVars);
	}
}
