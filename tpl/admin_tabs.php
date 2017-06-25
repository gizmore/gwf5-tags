<?php
$bar = GDO_Bar::make();
$bar->addField(GDO_Link::make('link_tag_overview'));
echo $bar->render();
