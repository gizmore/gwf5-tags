<?php $field instanceof GDO_Tag; $id = 'gwftag_'.$field->name; ?>
<md-input-container
 class="md-block md-float md-icon-left<?php echo $field->classError(); ?>" flex
 ng-controller="GWFTagCtrl"
 ng-init='init("#<?php echo $id; ?>", <?php echo $field->initJSON(); ?>)'>
  <label for="form[<?php echo $field->name; ?>]"><?php echo $field->displayLabel(); ?></label>
  <?php echo $field->htmlIcon(); ?>
  <md-chips
   ng-model="tags"
   md-on-add="onChange()"
   md-on-remove="onChange()"
   md-removable="removable"
   md-add-on-blur="true"
   md-max-chips="<?php echo $field->maxTags; ?>"
   readonly="<?php echo $field->writable?'false':'true'; ?>"
   required="<?php echo $field->null?'false':'true'; ?>"
   placeholder="<?php echo $field->displayLabel(); ?>">
   <md-autocomplete
    md-search-text="searchText"
    md-items="item in completeTags(searchText)">
   <md-item-template>
     <div md-highlight-text="searchText" md-highlight-flags="^i">{{item}}</div>
   </md-item-template>
   </md-autocomplete>
  </md-chips>
  <input
   type="hidden"
   id="<?php echo $id; ?>"
   name="form[<?php echo $field->name; ?>]"
   value="<?php echo $field->displayFormValue(); ?>"
   <?php echo $field->htmlRequired(); ?>
   <?php echo $field->htmlDisabled(); ?>/>
  <div class="gwf-form-error"><?php echo $field->displayError(); ?></div>
</md-input-container>
