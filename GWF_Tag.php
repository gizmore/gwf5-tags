<?php
final class GWF_Tag extends GDO
{
	public function gdoColumns()
	{
		return array(
			GDO_AutoInc::make('tag_id'),
			GDO_Name::make('tag_name')->notNull()->unique(),
			GDO_Int::make('tag_count')->notNull()->initial('0')
		);
		
	}
}
