<?php
final class Tags_CompleteTag extends GWF_MethodCompletion
{
	public function execute()
	{
		$q = $this->getSearchTerm();
		$max = $this->getMaxSuggestions();
		$result = [];
		foreach (GWF_Tag::table()->all() as $tag)
		{
			if ( (!$q) || (mb_stripos($tag->getName(), $q)!==false) )
			{
				$result[] = array(
					'id' => $tag->getID(),
					'text' => $tag->displayName(),
					'display' => $tag->renderCell(),
				);
			}
			if (count($result) > $max)
			{
				break;
			}
		}
		die(json_encode($result));
	}
}
