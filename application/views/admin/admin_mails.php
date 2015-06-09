<div class="container top-bottom-space">  
    <h1>Emails</h1>
    <hr>
    <div class="well">
    	<div class="row ">
	    	<div class="col-md-12">            
	    		<form class='form-inline' method="post" action= <?php echo site_url('admin/mails') ?> >
                    <div class="form-group">
                        <?php echo $this->load->view('view_email') ?>
                        <label>Type </label>                        
                        <select class="form-control" name="mail_type">
                            <option value="activate"> Activate </option>
                            <option value="subscribe"> Subscribe </option>
                            <option value="order"> Order </option>
                            <option value="first_order"> First Order </option>
                        </select>
                        <button type="submit" class="btn btn-primary">Send mail</button>
                    </div>
                </form>
			</div>
            <div class="col-md-12">
                <p>Newsletter</p>
                <form class='form-inline' method="post" action= <?php echo site_url('admin/mails') ?> >
                    <div class="form-group">
                        <input type="text" class="form-control" name="subject" placeholder="Subject">
                        <input type="text" class="form-control" name="secret_text" placeholder="Type 'Secret text' to ">
                    </div>
                    <button type="submit" class="btn btn-primary">Send Newsletter</button>
                </form>
            </div>
		</div>        
	</div>
</div>
