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
            <?php if(form_error('team_name')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="team_name" class='col-sm-4 control-label'><?php echo lang('team_name'); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="team_name" value="<?php echo set_value('team_name'); ?>" class="form-control" placeholder="<?php echo lang('team_name'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('team_name');?></span>
              </div>
            </div>
            <?php if(form_error('team_shortname')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="team_shortname" class='col-sm-4 control-label'><?php echo lang('team_shortname'); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="team_shortname" value="<?php echo set_value('team_shortname'); ?>" class="form-control" placeholder="<?php echo lang('team_shortname'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('team_shortname');?></span>
              </div>
            </div>            
            <?php if(form_error('team_identifier')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="team_identifier" class='col-sm-4 control-label'><?php echo lang('team_identifier'); ?></label>
              <div class="col-sm-8">
                <input type="text" name="team_identifier" value="<?php echo set_value('team_identifier'); ?>" class="form-control" placeholder="<?php echo lang('team_identifier'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('team_identifier');?></span>
              </div>
            </div>
            <?php if(form_error('team_flag')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="team_flag" class='col-sm-4 control-label'><?php echo lang('team_flag'); ?></label>
              <div class="col-sm-8">
                <input type="text" name="team_flag" value="<?php echo set_value('team_flag'); ?>" class="form-control" placeholder="<?php echo lang('team_flag'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('team_flag');?></span>
              </div>
            </div>            
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" name="submit" value="<?php echo lang('save'); ?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-save"></span> <?php echo lang('save'); ?></button>
              <a href="<?php echo site_url('admin/teams'); ?>" class="btn btn-danger btn-outline pull-right"><span class="glyphicon glyphicon-remove"></span> <?php echo lang('cancel'); ?></a>
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
              <?php if (isset($teams)) { ?>
              <table class="table dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td><?php echo lang('ID'); ?></td>
                    <td><?php echo lang('team_name'); ?></td>
                    <td><?php echo lang('team_identifier'); ?></td>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($teams as $team) { ?>
                  <tr><td><?php echo $team->id; ?></td><td><?php echo $team->name; ?></td><td><?php echo $team->identifier; ?></td></tr>
                <?php } ?>
                </tbody>
              <?php } ?>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>  