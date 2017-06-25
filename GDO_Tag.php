<?php
class GDO_Tag extends GDO_Object
{
	public function defaultLabel()
	{
		return $this->label('tag');
	}

	public function __construct()
	{
		$this->table(GWF_Tag::table());
		$this->completion(href('Tags', 'CompleteTag'));
	}
		
}