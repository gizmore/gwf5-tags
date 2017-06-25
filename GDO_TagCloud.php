<?php
class GDO_TagCloud extends GDO_Template
{
	use GDO_ObjectTrait;
	
	public function __construct()
	{
		$this->module(Module_Tags::instance());
		$this->template('cell/tag_cloud.php', ['field'=>$this]);
	}
	
	/**
	 * @return GWF_Tag[]
	 */
	public function getTags()
	{
		return $this->getTagTable()->allObjectTags();
	}
	
	/**
	 * @return GWF_TagTable
	 */
	public function getTagTable()
	{
		return $this->table->gdoTagTable();
	}
	
	##############
	### Filter ###
	##############
	public function filterQuery(GDOQuery $query)
	{
		if ($filterId = $this->filterValue())
		{
			$tagtable = $this->getTagTable();
			$objtable = $this->table;
			$query->join("JOIN {$tagtable->gdoTableIdentifier()} ON tag_tag={$filterId} AND tag_object={$objtable->gdoPrimaryKeyColumn()->identifier()}");
		}
		return $query;
	}
	
	
	public function hrefTagFilter(GWF_Tag $tag)
	{
		$name = $this->name;
		$url = preg_replace("/&f\\[$name\\]=\d+/", '', $_SERVER['REQUEST_URI']);
		$url = preg_replace("/&page=\d+/", '', $url);
		return $url . "&f[$name]=" . $tag->getID(); 
	}
}
