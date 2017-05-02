<?php defined('BASEPATH') OR exit('No direct script access allowed');?>

  <div class="page-content">
    <div id="mainrow" class="row">
      <div class="col-md-2">
        <?php $this->load->view('templates/_parts/admin_master_sidebar_view'); ?>
      </div>

      <div class="col-md-10">
        <div class="content-box-large">
          <div class="panel-heading">
            <div class="panel-title"><?php echo $page_title; ?></div>
          </div>
          <div class="panel-body">

              <table class="table table-striped table-hover dataTable" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <td></td>
                    <td><?php echo lang('match'); ?> </td>
                    <td><?php echo lang('prediction'); ?></td>
                    <td><?php echo lang('points');?></td>
                    <td><?php echo lang('points_total_for_this_match');?></td>
                    <td><?php echo lang('total_after_match');?></td>
                  </tr>
                </thead>
                <tbody>
                <?php foreach ($predictions as $prediction) { ?>
                  <tr>
                    <td><?php echo $prediction->match_id;?></td>
                    <td><?php echo $teams[$prediction->match->hometeam_id]->name." - ".$teams[$prediction->match->awayteam_id]->name; ?></td>
                    <td align='center'><?php echo $prediction->pred_home_goals." - ".$prediction->pred_away_goals;?></td>
                    <td align='right'>
                      <?php echo lang('points_for_home_goals');?>: <?php echo ($prediction->points_for_home_goals!="") ? $prediction->points_for_home_goals : "&mdash;"; ?><br/>
                      <?php echo lang('points_for_away_goals');?>: <?php echo ($prediction->points_for_away_goals) ? $prediction->points_for_away_goals : "&mdash;"; ?><br/>
                      <?php echo lang('points_for_result');?>: <?php echo ($prediction->points_for_result) ? $prediction->points_for_result : "&mdash;"; ?><br/>
                      <?php echo lang('points_for_bonus');?>: <?php echo ($prediction->points_for_bonus) ? $prediction->points_for_bonus : "&mdash;"; ?><br/>
                      <span class='totalizer'><?php echo lang('points_total_for_this_match').": ".$prediction->points_total_for_this_match;?></span>
                    </td>
                    <td align='center'><?php echo $prediction->points_total_for_this_match;?></td>
                    <td align='center'><?php echo $prediction->points_after_this_match;?></td>
                  </tr>       
                <?php } ?>
                </tbody>
              </table>    
          </div>        
        </div>
      </div>

    </div>  <!-- #mainrow -->