<?php
final class Tags_AdminEdit extends GWF_MethodForm
{
	private $gdo;
	
	public function execute()
	{
		$this->gdo = GWF_Tag::table()->find(Common::getRequestString('id'));
		return Module_Tags::instance()->renderAdminTabs()->add(parent::execute());
	}
	
	public function createForm(GWF_Form $form)
	{
		$tags = GWF_Tag::table();
		$form->addFields($tags->gdoColumnsCache());
		$form->addField(GDO_AntiCSRF::make());
		$form->addField(GDO_Submit::make());
		$form->addField(GDO_Submit::make('delete'));
		$form->addField(GDO_Submit::make('merge'));
		$form->addField(GDO_Tag::make('merge_tag')->validator([$this, 'validateMergeTarget']));
		$form->withGDOValuesFrom($this->gdo);
	}
	
	public function validateMergeTarget(GWF_Form $form, GDO_Tag $tag)
	{
		if (isset($_POST['merge']))
		{
			if (!($other = $tag->getGDOValue()))
			{
				return $tag->error('err_tag_merge_target_needed');
			}
			if ($other->getID() === $this->gdo->getID())
			{
				return $tag->error('err_tag_merge_target_self');
			}
		}
		return true;
	}
	
	public function formValidated(GWF_Form $form)
	{
		$this->gdo->saveVars($form->values());
		return parent::formValidated($form);
	}
	
	public function onSubmit_merge(GWF_Form $form)
	{
// 		$mergeInto = $form->getField('merge_tag')->getGDOValue();
		
// 		foreach (GWF_TagTable::allTagTables() as $tagTable)
// 		{
// 			foreach ($tagTable->allObjectsWithTag($this->gdo) as $object)
// 			{
// 				$tagTable
// 			}
// 		}
	}

	public function onSubmit_delete(GWF_Form $form)
	{
		$this->gdo->delete();
		$rows = GDODB::instance()->affectedRows();
		return $this->message('msg_tag_deleted', [$rows])->add(GWF_Website::redirectMessage(href('Tags', 'AdminOverview')));
	}

}
