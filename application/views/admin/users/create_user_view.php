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
          <!-- first name -->
            <?php if(form_error('first_name')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="first_name" class='col-sm-4 control-label'><?php echo lang('first_name');?></label>
              <div class='col-sm-8'>
                <input type="text" name="first_name" value="<?php echo set_value('first_name'); ?>" class="form-control" placeholder="First Name">
                <span id="helpBlock" class="help-block"><?php echo form_error('first_name');?></span>
              </div>
            </div>
          <!-- last name -->
            <?php if(form_error('last_name')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="last_name" class='col-sm-4 control-label'><?php echo lang('last_name');?></label>
              <div class="col-sm-8">
                <input type="text" name="last_name" value="<?php echo set_value('last_name'); ?>" class="form-control" placeholder="Last Name">
                <span id="helpBlock" class="help-block"><?php echo form_error('last_name');?></span>
              </div>
            </div>
          <!-- username -->
            <?php if(form_error('username')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="username" class='col-sm-4 control-label'><?php echo lang('username');?></label>
              <div class="col-sm-8">
                <input type="text" name="username" value="<?php echo set_value('username'); ?>" class="form-control" placeholder="Username">
                <span id="helpBlock" class="help-block"><?php echo form_error('username');?></span>
              </div>
            </div>
          <!-- email -->
            <?php if(form_error('email')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="email" class='col-sm-4 control-label'><?php echo lang('email');?></label>
              <div class="col-sm-8">
                <input type="email" name="email" value="<?php echo set_value('email'); ?>" class="form-control" placeholder="Email Address">
                <span id="helpBlock" class="help-block"><?php echo form_error('email');?></span>
              </div>
            </div>
           <!-- password -->
            <?php if(form_error('password')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="password" class='col-sm-4 control-label'><?php echo lang('password');?></label>
              <div class="col-sm-8">
                <input id="password" type="password" name="password" value="<?php echo set_value('password'); ?>" class="form-control" placeholder="Password">
                <span id="helpBlock" class="help-block"><?php echo form_error('password');?></span>
              </div>
            </div>
            <!-- password_confirm-->
            <?php if(form_error('password_confirm')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php  } ?>
              <label for="password_confirm" class='col-sm-4 control-label'><?php echo lang('password_confirm');?></label>
              <div class="col-sm-8">
                <input type="password" name="password_confirm" value="<?php echo set_value('password_confirm'); ?>" class="form-control" placeholder="Confirm Password">
                <span id="helpBlock" class="help-block"><?php echo form_error('password_confirm');?></span>
              </div>
            </div>
            <!-- groups -->
            <?php if (form_error('groups[]')) { ?>
            <div class="form-group has-error">
            <?php } else { ?>
            <div class="form-group">
            <?php } ?>
              <?php
              if(isset($groups))
              { ?>
                <label for="groups[]" class='col-sm-4 control-label'><?php echo lang('groups');?></label>
                <div class='col-sm-8'>
                <?php
                  foreach($groups as $group)
                  {
                ?>    
                  <div class="checkbox">
                    <label>
                    <input type="checkbox" name="groups[]" value="<?php echo $group->id; ?>" <?php echo set_checkbox('groups[]', $group->id); ?> >
                      <?php echo ' '.$group->name; ?>
                    </label>
                  </div>
                <?php
                  }
                ?>
                  <span id="helpBlock" class="help-block"><?php echo form_error('groups[]');?></span>  
                <?php  
                }
                ?>
                </div>
            </div>

            <div class="col-sm-offset-4 col-sm-8">
              <button type="submit" name="submit" value="Create user" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-save"></span> <?php echo lang('save');?></button>
              <a href="<?php echo site_url('admin/users'); ?>" class="btn btn-danger btn-outline pull-right"><span class="glyphicon glyphicon-remove"></span> <?php echo lang('cancel');?></a>
            </div>
          <?php echo form_close();?>          
          </div>        
        </div>
      </div>
      <div class="col-md-5">
        <div class="content-box-large">
          <div class="panel-heading">
            <div class="panel-title">
              Users List
            </div>
            <div class="panel-body">
              <?php if (isset($users)) { ?>
              <table class="table dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr><td><?php echo lang('username');?></td><td><?php echo lang('first_name');?></td><td><?php echo lang('last_name');?></td></tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) { ?>
                  <tr>
                    <td><?php echo $user->username; ?></td>
                    <td><?php echo $user->first_name; ?></td>
                    <td><?php echo $user->last_name; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
              <?php } ?>
              </table>
            </div>
          </div>
      </div>
    </div>
  </div>