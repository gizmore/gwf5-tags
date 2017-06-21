<?php
class GWF_TagTable extends GDO
{
	/**
	 * @return GDO
	 */
	public function gdoTagTable() {}
	
	public function gdoCached() { return false; }
	public function gdoAbstract() { return $this->gdoTagTable() === null; }
	public function gdoColumns()
	{
		return array(
			GDO_Object::make('tag_id')->klass('GWF_Tag'),
			GDO_TagTable::make('tag_object')->table($this->gdoTagTable()),
		);
	}
}
