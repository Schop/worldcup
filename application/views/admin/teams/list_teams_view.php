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
            <a href="<?php echo site_url('admin/teams/create');?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-plus"></span> <?php echo lang('create_team');?></a>
          </div>
          <div class="panel-body">
            <?php
            if(!empty($teams))
            {
            ?>
              <table class="table table-striped table-hover dataTable"  cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td><?php echo lang('ID');?></td>
                    <td><?php echo lang ('team_identifier');?></td>
                    <td><?php echo lang ('team_name');?></td>
                    <td><?php echo lang('team_shortname');?></td>
                    <td><?php echo lang ('team_flag');?></td>
                    <td><?php echo lang ('operations');?></td>
                  </tr>
                </thead>
                <tbody>
            <?php
              foreach($teams as $team)
              {
            ?>    
                  <tr>
                    <td><?php echo $team->id; ?></td>
                    <td><?php echo $team->identifier; ?></td>
                    <td><?php echo $team->name; ?></td>
                    <td><?php echo $team->shortname; ?></td>
                    <td><img src="<?php echo site_url('assets/flags/24/'.$team->flag.'.png');?>" /> <?php echo $team->flag; ?></td>
                    <td><?php echo anchor('admin/teams/edit/'.$team->id,'<span class="glyphicon glyphicon-pencil"></span>','data-toggle="tooltip" data-placement="auto top" title="'.sprintf(lang('edit_team'),$team->name).'"');
                        echo ' '.anchor('admin/teams/delete/'.$team->id,'<span class="glyphicon glyphicon-remove"></span>', 'data-toggle="tooltip" data-placement="auto top" title="'.lang('delete_team').'"');?>
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