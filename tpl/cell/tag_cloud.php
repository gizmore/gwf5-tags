<?php $field instanceof GDO_TagCloud; $filterValue = $field->filterValue(); ?>

<div class="gdo-tag-cloud">
<?php foreach ($field->getTags() as $tag) : ?>
  <a
   href="<?php echo $field->hrefTagFilter($tag); ?>"
   class="<?php echo $filterValue === $tag->getID() ? 'gwf-selected' : ''; ?>">
    <span><?php echo $tag->displayName(); ?>(<?php echo $tag->getCount(); ?>)</span>
 </a>
<?php endforeach; ?>
  <input type="hidden" name="f[<?php echo $field->name; ?>]" value="<?php echo $field->displayFilterValue(); ?>" />
</div>