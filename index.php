<?php 

$package =  $_GET['package'];

$category = array('mj'=>'Mystery Junkies', 'la'=>'Laser Adda','combo'=>'Combo');
$time_slot = array('mj'=>'1 Hour 30 Minutes','la'=>'30 Minutes','combo'=>'1 Hour 30 Minutes');

$timeing = array('mj'=>array('10:00 - 11:30', '11:30 - 01:00','01:00 - 02:30','02:30 - 04:00','04:00 - 05:30','05:30 - 07:00','07:00 - 08:30'), 
				 'la'=>array('10:00 - 10:30','10:30 - 11:00','11:00 - 11:30','11:30 - 12:00 ','12:00 - 12:30','12:30 - 01:00','01:00 - 01:30','01:30 - 02:00','02:00 - 02:30','02:30 - 03:00','03:00 - 03:30','03:30 - 04:00','04:00 - 04:30','04:30 - 05:00','05:00 - 05:30','05:30 - 06:00','06:00 - 06:30','06:30 - 07:00','07:00 - 07:30','07:30 - 08:00','08:00 - 08:30'));

?>
<html>
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<style type="text/css">
	
body{
		background-color: #0b0a08;
	}                                                                                                                                     
	.contact{
		padding: 4%;
		height: auto;
	}
	.col-md-3{
		background: #89252a;
		padding: 4%;
		border-top-left-radius: 0.5rem;
		border-bottom-left-radius: 0.5rem;
	}
	.contact-info{
		margin-top:10%;
	}
	.contact-info img{
		margin-bottom: 15%;
	}
	.contact-info h2{
		margin-bottom: 10%;
	}
	.col-md-9{
		background: #fff;
		padding: 3%;
		border-top-right-radius: 0.5rem;
		border-bottom-right-radius: 0.5rem;
	}
	.contact-form label{
		font-weight:600;
	}
	.contact-form button{
		background: #25274d;
		color: #fff;
		font-weight: 600;
		width: 25%;
	}
	.contact-form button:focus{
		box-shadow:none;
	}
footer {
  text-align: center;
  padding: 3px;
  background-color: #341310;
  color: white;
}
</style>
<nav class="navbar navbar-expand-sm" style="background-color: #263747!important;">
  <ul class="navbar-nav">
    <li class="nav-item active">
      <a class="nav-link" href="#"><img src="logo.png" style="max-height: 5em; width: auto;"></a>
    </li>
  </ul>
</nav>

<body>
	<form method="post" action="submit_form.php">
<div class="container contact">
	<div class="row">
		<div class="col-md-3">
			<div class="contact-info">
				<!--<img src="https://image.ibb.co/kUASdV/contact-image.png" alt="image"/>-->
				<h2 style="color: white;">Booking</h2>
				<h4 style="color: white;">Book your game here</h4>
			</div>
		</div>

		<div class="col-md-9">
			<div class="contact-form">
				<div class="form-group">
				  <label class="control-label col-sm-2" for="name">Game:</label>
				  <div class="col-sm-10"> 
				  <h5><?php echo $category[$package]; ?></h5>         
				  </div>
				</div>
			</div>
			<div class="contact-form row">
				<div class="form-group col-sm-6">
				  <label class="control-label col-sm-2" for="name">Name*:</label>
				  <div class="col-sm-10">          
					<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
				  </div>
				</div>
				<div class="form-group col-sm-6">
				  <label class="control-label col-sm-2" for="email">Email*:</label>
				  <div class="col-sm-10 col-sm-6">
					<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required>
				  </div>
				</div>
				<div class="form-group col-sm-6">
				  <label class="control-label col-sm-2" for="phone">Phone*:</label>
				  <div class="col-sm-10">
					<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" required>
				  </div>
				</div>
				<div class="form-group col-sm-6">
				  <label class="control-label col-sm-2" for="date_slot">Date*:</label>
				  <div class="col-sm-10">
					<input type="date"  class="form-control" id="date_slot" name="date_slot"  min="<?php echo date("Y-m-d"); ?>" max="<?php echo  date("Y-m-d", strtotime("+30 days")); ?>" required>
				  </div>
				</div>
				<div class="form-group col-sm-6">
				  <label class="control-label col-sm-6" for="time_slot">Time*:</label>
				  <div class="col-sm-10">
					<select class="form-control" name="time_slot" id="time_slot" required>
							<option value="">Select</option>
							<?php foreach($timeing[$package] as $key=>$val) { ?>
							<option value="<?php echo $val; ?>"><?php echo $val; ?></option>
							<?php } ?>
							
					</select>
				  </div>
				</div>
				<div class="form-group col-sm-6">
				  <label class="control-label col-sm-6" for="book_type">Type of Booking*:</label>
				  <div class="col-sm-10">
					<select class="form-control" name="book_type" id="book_type" onchange="checktype(this.value)" required>
							<option value="">Select</option>
							<option value="Regular">Regular</option>
							<option value="Student">Student</option>
							<option value="Corporate">Corporate</option>
					</select>
				  </div>
				</div>
				<div class="form-group col-sm-6 reg_hs" style="display: none;">
				  <label class="control-label col-sm-6" for="reg_val">Regular:</label>
				  <div class="col-sm-10">
					<select class="form-control" name="reg_val" id="reg_val">
							<option value="">Select</option>
							<option value="age 6-20 yrs">Age 6-20 yrs</option>
							<option value="Adults">Adults</option>
					</select>
				  </div>
				</div>
				<input type="hidden" name="package" value="<?php echo $package; ?>">
				<div class="form-group col-sm-6">
				  <label class="control-label col-sm-2" for="persons">Persons*:</label>
				  <div class="col-sm-10">
					<select class="form-control" name="persons" id="persons" required>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
							<option value="5">5</option>
							<option value="6">6</option>
					</select>
				  </div>
				</div>
				</div>
				<div class="contact-form">
					<div class="form-group">
					<div class="col-sm-10">
						<input type="checkbox" id="myCheck"  required>
						<label for="myCheck"> I agree to <a href="#" data-toggle="modal" data-target="#myModal"> T&C</a></label> 
					</div>
				</div>

				<div class="form-group">        
				  <div class="col-sm-offset-2 col-sm-10">
					<button type="submit" class="btn btn-default">Submit</button>
				  </div>
				</div>
			</div>
		</div>
	</div>
</div>
</form>
  <!-- The Modal -->
  <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h5 class="modal-title">Terms & Conditions</h5>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
         Terms and conditions
        </div>
      </div>
    </div>
  </div>
</body>
<footer>
	<div class="container">
		<p style="text-align: center;">Gaming Galaxy <span style="color: #6c1f19;">© 2020. All rights reserved.</span></p>
	</div>
</footer>

<script>
		function checktype(type_book)
		{
				if(type_book == 'Regular')
				{ 
						$(".reg_hs").show();
				}
		}
</script>
</html>