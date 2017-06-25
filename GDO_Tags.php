<?php
final class GDO_Tags extends GDOType
{
	public function __construct()
	{
		$this->initial = '[]';
	}
	
	public function getGDOValue()
	{
		return ($tags = @json_decode($this->getValue())) ? $tags : [];
	}
	
	public function setGDOValue($value)
	{
		return $this->value(json_encode($value));
	}
	
	################
	### Max Tags ###
	################
	public $maxTags = 10;
	public function maxTags(int $maxTags)
	{
		$this->maxTags = $maxTags;
		return $this;
	}
	
	##############
	### Render ###
	##############
	public function render()
	{
		return GWF_Template::modulePHP('Tags', 'form/tag.php', ['field' => $this]);
	}
	
	public function renderCell()
	{
		return GWF_Template::modulePHP('Tags', 'cell/tag.php', ['field' => $this]);
	}
	
	public function initJSON()
	{
		return json_encode(array(
			'all' => array_keys(GWF_Tag::all()),
			'tags' => json_decode($this->formValue()),
		));
	}
	
	################
	### Validate ###
	################
	public function validate($value)
	{
		if (!($tags = @json_decode($value)))
		{
			return $this->error('err_json');
		}
		
		if (count($tags) > $this->maxTags)
		{
			return $this->error('err_max_tags', [$this->maxTags]);
		}

		$namefield = GDO_TagName::make();
		foreach ($tags as $tagName)
		{
			if (!$namefield->validate($tagName))
			{
				return $this->error('err_tag_name', [htmlspecialchars($tagName)]);
			}
		}
		
		return true;
	}
}
