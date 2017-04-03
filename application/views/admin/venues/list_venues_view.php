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
            <a href="<?php echo site_url('admin/venues/create');?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-plus"></span> <?php echo lang('create_venue');?></a>
          </div>
          <div class="panel-body">
            <?php
            if(!empty($venues))
            {
            ?>
              <table class="table table-striped table-hover dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td><?php echo lang('ID');?></td>
                    <td><?php echo lang ('venue_name');?></td>
                    <td><?php echo lang ('venue_location');?></td>
                    <td><?php echo lang('venue_time_offset_utc');?></td>
                    <td><?php echo lang ('operations');?></td>
                  </tr>
                </thead>
                <tbody>
            <?php
              foreach($venues as $venue)
              {
            ?>    
                  <tr>
                    <td><?php echo $venue->id; ?></td>
                    <td><?php echo $venue->name; ?></td>
                    <td><?php echo $venue->location; ?></td>
                    <?php if ($venue->time_offset_utc > 0) { ?>
                    <td>+<?php echo $venue->time_offset_utc; ?></td>
                    <?php } else { ?>
                    <td><?php echo $venue->time_offset_utc; ?></td>
                    <?php } ?>
                    <td><?php echo anchor('admin/venues/edit/'.$venue->id,'<span class="glyphicon glyphicon-pencil"></span>','data-toggle="tooltip" data-placement="auto top" title="'.sprintf(lang('edit_venue'),$venue->name).'"');
                        echo ' '.anchor('admin/venues/delete/'.$venue->id,'<span class="glyphicon glyphicon-remove"></span>', 'data-toggle="tooltip" data-placement="auto top" title="'.lang('delete_venue').'"');?>
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