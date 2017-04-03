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
            <?php if(form_error('venue_name')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="venue_name" class='col-sm-4 control-label'><?php echo lang('venue_name'); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="venue_name" value="<?php echo set_value('venue_name'); ?>" class="form-control" placeholder="<?php echo lang('venue_name'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('venue_name');?></span>
              </div>
            </div>
            <?php if(form_error('venue_location')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="venue_location" class='col-sm-4 control-label'><?php echo lang('venue_location'); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="venue_location" value="<?php echo set_value('venue_location'); ?>" class="form-control" placeholder="<?php echo lang('venue_location'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('venue_location');?></span>
              </div>
            </div>            
            <?php if(form_error('venue_time_offset_utc')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="venue_time_offset_utc" class='col-sm-4 control-label'><?php echo lang('venue_time_offset_utc'); ?></label>
              <div class="col-sm-8">
                <input type="text" name="venue_time_offset_utc" value="<?php echo set_value('venue_time_offset_utc'); ?>" class="form-control" placeholder="<?php echo lang('venue_time_offset_utc'); ?>">
                <span id="helpBlock" class="help-block"><?php echo form_error('venue_time_offset_utc');?></span>
              </div>
            </div>
          
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" name="submit" value="<?php echo lang('save'); ?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-save"></span> <?php echo lang('save'); ?></button>
              <a href="<?php echo site_url('admin/venues'); ?>" class="btn btn-danger btn-outline pull-right"><span class="glyphicon glyphicon-remove"></span> <?php echo lang('cancel'); ?></a>
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
              <?php if (isset($venues)) { ?>
              <table class="table dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td><?php echo lang('ID'); ?></td>
                    <td><?php echo lang('venue_name'); ?></td>
                    <td><?php echo lang('venue_location'); ?></td>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($venues as $venue) { ?>
                  <tr><td><?php echo $venue->id; ?></td><td><?php echo $venue->name; ?></td><td><?php echo $venue->location; ?></td></tr>
                <?php } ?>
                </tbody>
              <?php } ?>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>  