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
            <div class="form-group <?php if(form_error('result_home_goals')) { echo 'has-error'; }?>">
              <label for="result_home_goals" class='col-sm-4 control-label'><?php echo sprintf(lang('result_home_goals'), $match->hometeam->name); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="result_home_goals" value="<?php echo set_value('result_home_goals', $match->result_home_goals); ?>" class="form-control" placeholder="<?php echo  sprintf(lang('result_home_goals'), $match->hometeam->name); ?>">
                <span class="help-block"><?php echo form_error('result_home_goals');?></span>
              </div>
            </div>            
            <div class="form-group <?php if(form_error('result_away_goals')) { echo 'has-error'; }?>">
              <label for="result_away_goals" class='col-sm-4 control-label'><?php echo sprintf(lang('result_away_goals'), $match->awayteam->name); ?></label>
              <div class='col-sm-8'>
                <input type="text" name="result_away_goals" value="<?php echo set_value('result_away_goals', $match->result_away_goals); ?>" class="form-control" placeholder="<?php echo sprintf(lang('result_away_goals'), $match->awayteam->name); ?>">
                <span class="help-block"><?php echo form_error('result_away_goals');?></span>
              </div>
            </div>                      
            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" name="submit" value="<?php echo lang('save'); ?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-save"></span> <?php echo lang('save'); ?></button>
              <a href="<?php echo site_url('admin/matches'); ?>" class="btn btn-danger btn-outline pull-right"><span class="glyphicon glyphicon-remove"></span> <?php echo lang('cancel'); ?></a>
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