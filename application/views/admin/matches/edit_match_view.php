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
            <div class="form-group <?php if(form_error('match_number')) { echo 'has-error'; }?>">
              <label for="match_number" class='col-sm-4 control-label'><?php echo lang('match_number'); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="match_number" value="<?php echo set_value('match_number', $match->match_number); ?>" class="form-control" placeholder="<?php echo lang('match_number'); ?>">
                <span class="help-block"><?php echo form_error('match_number');?></span>
              </div>
            </div>
            <div class="form-group <?php if(form_error('hometeam_id')) { echo 'has-error'; }?>">
              <label for="hometeam_id" class='col-sm-4 control-label'><?php echo lang('hometeam'); ?></label>
              <div class='col-sm-8'>
                <?php echo form_dropdown('hometeam_id', $teams,  set_value('hometeam_id', $match->hometeam_id),"class='form-control'"); ?>
                <span  class="help-block"><?php echo form_error('hometeam_id');?></span>
              </div>
            </div>            
            <div class="form-group <?php if(form_error('awayteam_id')) { echo 'has-error'; }?>">
              <label for="awayteam_id" class='col-sm-4 control-label'><?php echo lang('awayteam'); ?></label>
              <div class='col-sm-8'>
                <?php echo form_dropdown('awayteam_id', $teams, set_value('awayteam_id', $match->awayteam_id),"class='form-control'"); ?>
                <span class="help-block"><?php echo form_error('awayteam_id');?></span>
              </div>
            </div>
            <div class="form-group <?php if(form_error('matchtype_id')) { echo 'has-error'; }?>">
              <label for="matchtype_id" class='col-sm-4 control-label'><?php echo lang('matchtype'); ?></label>
              <div class='col-sm-8'>
                <?php echo form_dropdown('matchtype_id', $matchtypes, set_value('matchtype_id', $match->matchtype_id),"class='form-control'"); ?>
                <span class="help-block"><?php echo form_error('matchtype_id');?></span>
              </div>
            </div>
            <div class="form-group <?php if(form_error('venue_id')) { echo 'has-error'; }?>">
              <label for="venue_id" class='col-sm-4 control-label'><?php echo lang('venue'); ?></label>
              <div class='col-sm-8'>
                <?php echo form_dropdown('venue_id', $venues, set_value('venue_id', $match->venue_id),"class='form-control'"); ?>
                <span class="help-block"><?php echo form_error('venue_id');?></span>
              </div>
            </div>
            <div class="form-group <?php if(form_error('match_time')) { echo 'has-error'; }?>">           
              <label for="match_time" class='col-sm-4 control-label'><?php echo lang('match_time'); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="match_time" class="form-control" timepicker"" value="<?php echo set_value('match_time', $match->match_time); ?>" placeholder="yyyy-mm-dd HH:ii">
                <span class='help-block'><?php echo form_error('match_time');?></span>
                <div class='alert alert-info'><?php echo lang('matchtime_help_text'); ?></div>
              </div>
            </div>                          
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" name="submit" value="<?php echo lang('save'); ?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-save"></span> <?php echo lang('save'); ?></button>
              <a href="<?php echo site_url('admin/teams'); ?>" class="btn btn-danger btn-outline pull-right"><span class="glyphicon glyphicon-remove"></span> <?php echo lang('cancel'); ?></a>
            </div>
            <?php echo form_hidden('match_id', $match->id); ?>
          <?php echo form_close();?>      
          </div>        
        </div>
      </div>
      <div class="col-md-5">
        <div class="content-box-large">
          <div class="panel-heading">
            <div class="panel-title">
              <?php echo lang('matches_list');?>
            </div>
            <div class="panel-body">
              <?php if (isset($matches)) { ?>
              <table class="table dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td><?php echo lang('match_number'); ?></td>
                    <td><?php echo lang('hometeam'); ?></td>
                    <td><?php echo lang('awayteam'); ?></td>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($matches as $match) { ?>
                  <tr><td><?php echo $match->match_number; ?></td><td><?php echo $match->hometeam->name; ?></td><td><?php echo $match->awayteam->name; ?></td></tr>
                <?php } ?>
                </tbody>
              <?php } ?>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>  