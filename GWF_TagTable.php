<?php
class GWF_TagTable extends GDO
{
	/**
	 * @return GDO
	 */
	public function gdoTagObjectTable() {}

	public function gdoCached() { return false; }
	public function gdoAbstract() { return $this->gdoTagObjectTable() === null; }
	public function gdoColumns()
	{
		return array(
			GDO_Object::make('tag_tag')->klass('GWF_Tag'),
			GDO_TagTable::make('tag_object')->table($this->gdoTagObjectTable()),
			GDO_CreatedBy::make('tag_created_by'),
			GDO_CreatedAt::make('tag_created_at'),
		);
	}
	
	public function allObjectTags()
	{
		$table = $this->gdoTagObjectTable();
		if (!($cache = $table->tempGet('gwf_tags')))
		{
			$cache = $this->select('tag_name, tag_id, COUNT(*) tag_count')->joinObject('tag_tag')->group('tag_id')->exec()->fetchAllArray2dObject(GWF_Tag::table());
			$table->tempSet('gwf_tags', $cache);
		}
		return $cache;
	}
	
	/**
	 * @return GWF_TagTable[]
	 */
	public static function allTagTables()
	{
		$tables = [];
		foreach (GWF5::instance()->getActiveModules() as $module)
		{
			if ($classes = $module->getClasses())
			{
				foreach ($classes as $className)
				{
					if (is_subclass_of($className, 'GWF_TagTable'))
					{
						$tables[] = GDO::tableFor($className);
					}
				}
			}
		}
		return $tables;
	}
	
	
}
