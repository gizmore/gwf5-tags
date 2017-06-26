<?php
final class GWF_Tag extends GDO
{
	public function memCached() { return false; }
	
	public function gdoColumns()
	{
		return array(
			GDO_AutoInc::make('tag_id'),
			GDO_TagName::make('tag_name')->notNull()->unique(),
			GDO_Int::make('tag_count')->unsigned()->notNull()->initial('1')->writable(false),
		);
	}
	
	public function getID() { return $this->getVar('tag_id'); }
	public function getName() { return $this->getVar('tag_name'); }
	public function getCount() { return $this->getVar('tag_count'); }
	
	public function displayName() { return $this->getName(); }
	public function renderCell() { return GWF_Template::modulePHP('Tags', 'cell/tag.php', ['field' => $this])->getHTML(); }
	
	public function href_edit() {return href('Tags', 'AdminEdit', '&id='.$this->getID()); }
	
	##############
	### Static ###
	##############
	/**
	 * @return GWF_Tag[]
	 */
	public function all()
	{
		if (!($cache = GDOCache::get('gwf_tags')))
		{
			$cache = self::table()->select('tag_name, tag_id, tag_count')->exec()->fetchAllArray2dObject();
			GDOCache::set('gwf_tags', $cache);
		}
		return $cache;
	}
	
	/**
	 * 
	 * @param GDO $gdo
	 * @return GWF_Tag[]
	 */
	public static function forObject(GDO $gdo=null)
	{
		if ($gdo)
		{
			if (!($cache = $gdo->tempGet('gwf_tags')))
			{
				$tags = $gdo->gdoTagTable();
				$tags instanceof GWF_TagTable;
				$cache = $tags->select('tag_name, tag_id, tag_count')->joinObject('tag_tag')->where("tag_object=".$gdo->getID())->exec()->fetchAllArray2dObject(GWF_Tag::table());
				$gdo->tempSet('gwf_tags', $cache);
			}
			return $cache;
		}
		return [];
	}
}
