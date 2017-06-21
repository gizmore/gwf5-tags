<?php
final class Module_Tags extends GWF_Module
{
	public $module_priority = 40;
	public function onLoadLanguage() { $this->loadLanguage('lang/tags'); }
	public function getClasses() { return ['GWF_Tag', 'GWF_TagTable', 'GDO_Tag', 'GDO_TagTable', 'GWF_TaggedObject']; }
	
	
	##################
	### Top Navbar ###
	##################
	public function tagsNavbar()
	{
		return $this->templatePHP('navbar.php');
	}
}
