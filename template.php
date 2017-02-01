<div class="main-content contact">
    <div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="<?php echo $change; ?>">
				<h2><?php echo $show; ?></h2>
			</div>
			<div class="return">
				<h3><a href="http://chrisganeymedia.com" class="btn btn-default">Main Page</a></h3>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<form name="form1" method="post" action="contact">
				<div>
					<h3>Name</h3>
					<input type="text" class="input form-control" name="name" value="<?php echo "$imputs[0]"; ?>" />
				</div>
				<div>
					<h3>Phone Number</h3>
					<input type="text" class="input form-control" name="phone" value="<?php echo "$imputs[1]"; ?>" />
				</div>
				<div>
					<h3>email Address</h3>
					<input type="text" class="input form-control" name="email" value="<?php echo "$imputs[2]"; ?>" />
				</div>
				<div class="radio">
					<h3>Preferred Method for Contacting You</h3>
					<label class="radio-inline">
						<input type="radio" name="method" value="telephone" <?php echo "$methods[0]"; ?> /><h4>Telephone</h4>
					</label>
					<label class="radio-inline">
						<input type="radio" name="method" value="email" <?php echo "$methods[1]"; ?> /><h4>email</h4>
					</label>
				</div>
				<div>
					<h3>Your Comment or Question</h3>
					<textarea class="form-control" name="text" rows="5"><?php echo "$imputs[3]"; ?></textarea>
				</div>
				<div>
					<button type="submit" class="btn btn-primary" name="submit">Submit</button>
				</div>
			</form>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="more_contact text-center">
				<h1>You can also contact us at:</h1>
				<h2>(573) 880-3894</h2>
				<h2>chrisganeymedia@gmail.com</h2>
			</div>
				<img class="monstrato img-responsive center-block" alt="Website Screenshot"\
					src="images/monstrato4.png" />
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="return">
				<h3><a href="http://chrisganeymedia.com" class="btn btn-default">Main Page</a></h3>
			</div>
			<div class="copy">
				<h6>All Rights Reserved 2015 Christopher Ganey</h6>
			</div>
		</div>
	</div>
</div><!-- close content -->
