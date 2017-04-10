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
            <a href="<?php echo site_url('admin/matches/create');?>" class="btn btn-success btn-outline"><span class="glyphicon glyphicon-plus"></span> <?php echo lang('create_match');?></a>
          </div>
          <div class="panel-body">
            <?php
            if(!empty($matches))
            {
            ?>
              <table class="table table-striped table-hover dataTable"  cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td><?php echo lang('ID'); ?> </td>
                    <td><?php echo lang ('match_info');?></td>
                    <td></td>
                    <td></td>
                    <td align='center'><?php echo lang('result'); ?></td>
                    <td><?php echo lang ('operations');?></td>
                  </tr>
                </thead>
                <tbody>
            <?php
              foreach($matches as $match)
              {
            ?>    
                  <tr>
                    <td><?php echo $match->id ; ?></td>
                    <td>
                      <?php echo lang ('match_number').': '.$match->match_number;?><br/>
                      <?php echo $match->matchtype->matchtype;?><br/>
                      <?php echo $match->match_time; ?><br/>
                      <?php echo $match->venue->name; ?>
                    </td>
                    <td align="center">
                      <img src="<?php echo site_url('assets/flags/48/'.$match->hometeam->flag.'.png');?>" /><br/>
                      <?php echo $match->hometeam->name;?><br/>
                      <?php echo '('.$match->hometeam->identifier.')';?>
                    </td>

                    <td align="center">   
                      <img src="<?php echo site_url('assets/flags/48/'.$match->awayteam->flag.'.png');?>" /><br/> 
                      <?php echo $match->awayteam->name;?><br/>
                      <?php echo '('.$match->awayteam->identifier.')'; ?>
                    </td>
                    <?php if ($match->result_home_goals!="" && $match->result_away_goals!="") { ?>
                    <td align='center' style="vertical-align: middle;">
                    <span style="font-size:48px;"><?php echo $match->result_home_goals." - ".$match->result_away_goals;?></span><br/>
                     <?php echo anchor('admin/matches/edit_match_result/'.$match->id, lang('edit_match_result'),'data-toggle="tooltip" data-placement="auto top" title="'.lang('edit_match_result').'"'); ?>
                    </td>
                    <?php } else { ?>
                    <td align='center' style="vertical-align: middle;">
                    <?php echo anchor('admin/matches/edit_match_result/'.$match->id, lang('edit_match_result'),'data-toggle="tooltip" data-placement="auto top" title="'.lang('edit_match_result').'"'); ?>
                    </td>
                    <?php } ?>
                    <td style="vertical-align: middle;">
                      <?php echo anchor('admin/matches/edit/'.$match->id,lang('edit_match'),'data-toggle="tooltip" data-placement="auto top" title="'.lang('edit_match').'"');?>
                      <br/>
                      <?php echo anchor('admin/matches/show_predictions/'.$match->id, lang('show_predictions'),'data-toggle="tooltip" data-placement="auto top" title="'.lang('show_predictions').'"'); ?>                        
                      <br/>
                        <?php echo ' '.anchor('admin/matches/delete/'.$match->id,lang('delete_match'), 'class="text-danger" data-toggle="tooltip" data-placement="auto top" title="'.lang('delete_match').'"');?>
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