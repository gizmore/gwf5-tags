<?php
$user = GWF_User::current();
$module = Module_Tags::instance();
echo $module->renderAdminTabs();

$gdo = GWF_Tag::table();
$query = $gdo->select('*');

$table = GDO_Table::make();
$table->addFields($gdo->gdoColumnsCache());
$table->addField(GDO_Button::make('edit'));
$table->filtered();
$table->paginateDefault();
$table->query($query);
$table->href(href('Tags', 'AdminOverview'));

echo $table->render();
