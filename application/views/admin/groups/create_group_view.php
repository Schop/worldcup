<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

  <div class="page-content">
    <div class="row">
      <div class="col-md-2">
        <?php $this->load->view('templates/_parts/admin_master_sidebar_view'); ?>
      </div>

      <div class="col-md-5">
        <div class="content-box-large">
          <div class="panel-heading">
            <div class="panel-title"><?php echo $page_title; ?></div>
          </div>
          <div class="panel-body">
          <?php echo form_open('',array('class'=>'form-horizontal'));?>
            <?php if(form_error('group_name')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="group_name" class='col-sm-4 control-label'><?php echo lang('group_name'); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="group_name" value="<?php echo set_value('group_name'); ?>" class="form-control" placeholder="<?php echo lang('group_name'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('group_name');?></span>
              </div>
            </div>
            <?php if(form_error('group_description')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="group_description" class='col-sm-4 control-label'><?php echo lang('group_description'); ?></label>
              <div class="col-sm-8">
                <input type="text" name="group_description" value="<?php echo set_value('group_description'); ?>" class="form-control" placeholder="<?php echo lang('group_description'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('group_description');?></span>
              </div>
            </div>
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" name="submit" value="<?php echo lang('save'); ?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-save"></span> <?php echo lang('save'); ?></button>
              <a href="<?php echo site_url('admin/groups'); ?>" class="btn btn-danger btn-outline pull-right"><span class="glyphicon glyphicon-remove"></span> <?php echo lang('cancel'); ?></a>
            </div>
          <?php echo form_close();?>          
          </div>        
        </div>
      </div>
      <div class="col-md-5">
        <div class="content-box-large">
          <div class="panel-heading">
            <div class="panel-title">
              <?php echo lang('groups_list');?>
            </div>
            <div class="panel-body">
              <?php if (isset($groups)) { ?>
              <table class="table dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td><?php echo lang('ID'); ?></td>
                    <td><?php echo lang('group_name'); ?></td>
                    <td><?php echo lang('group_description'); ?></td>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($groups as $group) { ?>
                  <tr><td><?php echo $group->id; ?></td><td><?php echo $group->name; ?></td><td><?php echo $group->description; ?></td></tr>
                <?php } ?>
                </tbody>
              <?php } ?>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>  