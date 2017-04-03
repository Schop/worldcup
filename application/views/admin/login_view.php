


    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <h1 class="text-center login-title">Sign in</h1>
            <?php echo $this->session->flashdata('message');?>
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <?php echo form_open('',array('class'=>'form-signin'));?>
	                <input type="text" name="identity" class="form-control" placeholder="Email" required autofocus>
	                <?php echo form_error('identity');?>
	                <input type="password" name="password" class="form-control" placeholder="Password" >
	                <?php echo form_error('password');?>
	                <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">
	                    Sign in</button>
	                <label class="checkbox pull-left">
	                    <input type="checkbox" value="1" name="remember">
	                    Remember me
	                </label>
	                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                <?php echo form_close();?>
            </div>
            <a href="#" class="text-center new-account">Create an account </a>
        </div>
    </div>
