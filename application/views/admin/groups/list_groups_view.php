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
            <a href="<?php echo site_url('admin/groups/create');?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-plus"></span> <?php echo lang('create_group');?></a>
          </div>
          <div class="panel-body">
            <?php
            if(!empty($groups))
            {
            ?>
              <table class="table table-striped table-hover dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td><?php echo lang('ID');?></td>
                    <td><?php echo lang ('group_name');?></td>
                    <td><?php echo lang ('group_description');?></td>
                    <td><?php echo lang ('operations');?></td>
                  </tr>
                </thead>
                <tbody>
            <?php
              foreach($groups as $group)
              {
            ?>    
                  <tr>
                    <td><?php echo $group->id; ?></td>
                    <td><?php echo anchor('admin/users/index/'.$group->id,$group->name,'data-toggle="tooltip" data-placement="auto top" title="'.sprintf(lang('show_users_in_group'),$group->name).'"'); ?></td>
                    <td><?php echo $group->description; ?></td>
                    <td><?php echo anchor('admin/groups/edit/'.$group->id,'<span class="glyphicon glyphicon-pencil"></span>','data-toggle="tooltip" data-placement="auto top" title="'.lang('edit_group').'"');
                        if(!in_array($group->name, array('admin','members'))) echo ' '.anchor('admin/groups/delete/'.$group->id,'<span class="glyphicon glyphicon-remove"></span>', 'data-toggle="tooltip" data-placement="auto top" title="'.lang('delete_group').'"');?>
                    </td>
                  </tr>
              <?php  } ?>    
                </tbody>
              </table>
            <?php 
              }
            ?>
          </div>        
        </div>
      </div>
    </div>
  </div>  