<?php
$navbar = GDO_Bar::make();
$navbar->addFields(array(
	GDO_Link::make('link_tags')->href(href('Tags', 'AdminTags')),
	GDO_Link::make('link_untagged')->href(href('Tags', 'AdminTags')),
	GDO_Link::make('link_tagged_tables')->href(href('Tags', 'AdminTags')),
));
echo $navbar->renderCell();
