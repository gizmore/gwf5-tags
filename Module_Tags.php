<?php
final class Module_Tags extends GWF_Module
{
	public $module_priority = 40;
	public function onLoadLanguage() { $this->loadLanguage('lang/tags'); }
	public function getClasses() { return ['GWF_Tag', 'GWF_TagTable', 'GDO_Tag', 'GDO_Tags', 'GDO_TagCloud', 'GDO_TagName', 'GDO_TagTable', 'GWF_TaggedObject']; }
	
	public function onIncludeScripts()
	{
		$this->addJavascript('js/gwf-tag-ctrl.js');
	}
	
	public function href_administrate_module() { return href('Tags', 'AdminOverview'); }
	
	public function renderAdminTabs()
	{
		return $this->templatePHP('admin_tabs.php');
	}
	
	
	public function hookClearCache()
	{
// 		$query = GWF_Tag::table()->update()->set("tag_count=COUNT(*)")->where('true')->group('tag_id');
// 		foreach (GWF5::instance()->getActiveModules() as $module)
// 		{
// 			if ($classes = $module->getClasses())
// 			{
// 				foreach ($classes as $class)
// 				{
// 					if (is_subclass_of($class, 'GWF_TagTable'))
// 					{
// 						$table = GDO::tableFor($class);
// 						$query->join("RIGHT JOIN {$table->gdoTableIdentifier()} ON tag_tag=tag_id");
// 					}
// 				}
// 			}
// 		}
// 		$query->exec();
// 		GWF_Tag::table()->deleteWhere('tag_count=0')->exec();
	}
	
	##################
	### Top Navbar ###
	##################
	public function tagsNavbar()
	{
		return $this->templatePHP('navbar.php');
	}
}
