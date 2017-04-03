<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

  <div class="page-content">
    <div class="row">
      <div class="col-md-2">
        <?php $this->load->view('templates/_parts/admin_master_sidebar_view'); ?>
      </div>

      <div class="col-md-10">
        <div class="content-box-large">
          <div class="panel-heading">
            <div class="panel-title"><?php echo $page_title; ?></div>
          </div>
          <div class="panel-body">
            <a href="<?php echo site_url('admin/users/create');?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-plus"></span> <?php echo lang('create_new_user');?></a>
            <?php if ($group_id != NULL) { ?>
            <a href="<?php echo site_url('admin/users');?>" class="btn btn-info btn-outline"><span class="glyphicon glyphicon-eye-open"></span> <?php echo lang('show_all_users');?></a>
            <?php } ?>
            <?php foreach ($groups as $group) { ?>
              <?php if ($group->id != $group_id) { ?>
            <a href="<?php echo site_url('admin/users/index/'.$group->id);?>" class="btn btn-info btn-outline"><span class="glyphicon glyphicon-eye-close"></span> <?php echo sprintf(lang('show_users_in_group'), $group->name);?></a>
              <?php } ?>
            <?php } ?>
          </div>
          <div class="panel-body">
            <?php
            if(!empty($users))
            {
            ?>
              <table class="table table-striped table-hover dataTable">
              <thead>
                <tr>
                  <td><?php echo lang('ID');?></td>
                  <td><?php echo lang('username');?></td>
                  <td><?php echo lang('name');?></td>
                  <td><?php echo lang('email');?></td>
                  <td><?php echo lang('last_login');?></td>
                  <td><?php echo lang('operations');?></td>
                </tr>
              </thead>
              <tbody>
            <?php
              foreach($users as $user)
              {
            ?>    
                <tr>
                  <td><?php echo $user->id;?></td>
                  <td><?php echo $user->username;?></td>
                  <td><?php echo $user->first_name.' '.$user->last_name;?></td>
                  <td><?php echo $user->email;?></td>
                  <td><?php if ($user->last_login !=NULL) { echo date('Y-m-d H:i:s', $user->last_login); } ?></td>
                  <td><?php if($current_user->id != $user->id) echo anchor('admin/users/edit/'.$user->id,'<span class="glyphicon glyphicon-pencil"></span>', 'data-toggle="tooltip" data-placement="auto top" title="'.lang('edit_user').'"').' '.anchor('admin/users/delete/'.$user->id,'<span class="glyphicon glyphicon-remove"></span>', 'data-toggle="tooltip" data-placement="auto top" title="'.lang('delete_user').'"');
                    else echo '&nbsp;'; ?>
                  </td>
                </tr>
            <?php } ?>
              </tbody>
            </table>
            <?php }
            ?>
          </div>    
        </div>
      </div>
    </div>
  </div>  