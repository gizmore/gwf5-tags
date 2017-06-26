<?php
trait GWF_TaggedObject
{
	public function getTags()
	{
		return GWF_Tag::forObject($this);
	}
	
	public function updateTags(array $newTags)
	{
		$table = $this->gdoTagTable();
		$table instanceof GWF_TagTable;
		
		$oldTags = array_keys($this->getTags());

		$new = array_diff($newTags, $oldTags);
		$deleted = array_diff($oldTags, $newTags);
		$all = GWF_Tag::table()->all();
		foreach ($new as $tagName)
		{
			if (!($tag = (@$all[$tagName])))
			{
				$tag = GWF_Tag::blank(['tag_name'=>$tagName])->insert();
				$all[$tagName] = $tag;
			}
			else
			{
				$tag->increase('tag_count');
			}
			$table->blank(['tag_tag'=>$tag->getID(), 'tag_object'=>$this->getID()])->replace();
		}
		foreach ($deleted as $tagName)
		{
			if ($tag = (@$all[$tagName]))
			{
				$tag->increase('tag_count', -1);
			}
		}
		
		# Store new cache
		$tags = [];
		foreach ($newTags as $tagName)
		{
			$tags[$tagName] = $all[$tagName];
		}
		$this->tempSet('gwf_tags', $tags);
		$this->table()->tempUnset('gwf_tags');
// 		$this->recache();
		GDOCache::set('gwf_tags', $all);
	}
}
