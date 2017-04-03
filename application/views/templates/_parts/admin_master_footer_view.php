<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
    <footer class="navbar-fixed-bottom">
         <div class="container">
         
            <div class="copy text-center">
               &copy; 2017 Hooplakay Inc - Version <?php echo $this->config->item('pool_version'); ?>
            </div>
            
         </div>
      </footer>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo site_url('assets/admin/bootstrap/js/bootstrap.min.js'); ?>"></script>
    <script type="text/javascript" src="<?php echo site_url('assets/admin/js/pwstrength-bootstrap.min.js');?>"></script>
    <script src="<?php echo site_url('assets/admin/js/bootstrap-notify.min.js'); ?>"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs/dt-1.10.13/r-2.1.1/datatables.min.js"></script>
    <script src="<?php echo site_url('assets/admin/js/custom.js'); ?>"></script>

<!-- Notification Messages -->
<?php if ($this->session->flashdata('errormessage') != "") { ?>
    <script>
    $.notify({
      // options
      icon: 'glyphicon glyphicon-info',
      message: '<?php echo $this->session->flashdata('errormessage'); ?>' ,
      title: 'Error'
      },{
      // settings
      type: 'danger',
      placement: {
        from: "top",
        align: "center"
      },
      animate: {
        enter: 'animated slideInDown',
        exit: 'animated slideOutUp'
      }      
    });
</script>
<?php } ?>
<?php if ($this->session->flashdata('infomessage') != "") { ?>
    <script>
    $.notify({
      // options
      icon: 'glyphicon glyphicon-info-sign',
      message: '<?php echo $this->session->flashdata('infomessage'); ?>',
      title: 'Information'
      },{
      // settings
      type: 'info',
      placement: {
        from: "top",
        align: "center"
      },
      animate: {
        enter: 'animated slideInDown',
        exit: 'animated slideOutUp'
      }      
    });
</script>
<?php } ?>
<?php if ($this->session->flashdata('successmessage') != "") { ?>
    <script>
    $.notify({
      // options
        icon: 'glyphicon glyphicon-ok-sign',
        message: '<?php echo $this->session->flashdata('successmessage'); ?>',
        title: 'Success' 
      },{
      // settings
      type: 'success',
      placement: {
        from: "top",
        align: "center"
      },
      animate: {
        enter: 'animated slideInDown',
        exit: 'animated slideOutUp'
      }      
    });
</script>
<?php } ?>
<script>
$(document).ready(function() {
        $('.dataTable').dataTable({
          responsive: true
        });
        $('[data-toggle="tooltip"]').tooltip();
} );
</script>
  </body>
</html>