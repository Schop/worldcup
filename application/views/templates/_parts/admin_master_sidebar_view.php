              <div class="sidebar content-box" style="display: block;">
                <ul class="nav">
                    <!-- Main menu -->
                    <?php $url = $this->uri->segment(2, 0); ?>
                    <li <?php if($url=='0') echo 'class="current"'; ?> ><a href="<?php echo site_url('admin'); ?>">Dashboard</a></li>
                    <li <?php if($url==='users') echo 'class="current"'; ?> ><a href="<?php echo site_url('admin/users'); ?>"><?php echo lang('users');?></a></li>
                    <li <?php if($url==='groups') echo 'class="current"'; ?> ><a href="<?php echo site_url('admin/groups'); ?>"><?php echo lang('groups');?></a></li>
                    <li <?php if($url==='teams') echo 'class="current"'; ?> ><a href="<?php echo site_url('admin/teams'); ?>"><?php echo lang('teams');?></a></li>
                    <li <?php if($url==='venues') echo 'class="current"'; ?> ><a href="<?php echo site_url('admin/venues'); ?>"><?php echo lang('venues');?></a></li>
                    <li <?php if($url==='matches') echo 'class="current"'; ?> ><a href="<?php echo site_url('admin/matches'); ?>"><?php echo lang('matches');?></a></li>
                    <li><a href="buttons.html"><i class="glyphicon glyphicon-record"></i> Buttons</a></li>
                    <li><a href="editors.html"><i class="glyphicon glyphicon-pencil"></i> Editors</a></li>
                    <li><a href="forms.html"><i class="glyphicon glyphicon-tasks"></i> Forms</a></li>
                    <li class="submenu">
                         <a href="#">
                            <i class="glyphicon glyphicon-list"></i> Pages
                            <span class="caret pull-right"></span>
                         </a>
                         <!-- Sub menu -->
                         <ul>
                            <li><a href="login.html">Login</a></li>
                            <li><a href="signup.html">Signup</a></li>
                        </ul>
                    </li>
                </ul>
              </div>