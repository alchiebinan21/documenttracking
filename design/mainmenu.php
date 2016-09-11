		<br>
		<br>
		<br>
		<br>
<!-- Menu -->
	    <div id="fadein" class="section">
	    	<div class="container">
	    		<h1>MAIN MENU</h1>
	        	<div class="row">
				<br>
	        		<div class="alert alert-info">
					<strong>WELCOME!</strong> Read the texts below the icon for description. hover you mouse to it to enlarge text size.
					</div>
	        		<div class="pricing-wrapper col-md-12">
					
        				<!-- Creation of Qr code -->
						<div style="right: -13%; width: 35%; height: 100px;"> </div>
						<div id="fadein" class="pricing-plan" style="right: -13%; width: 35%; height: 400px; background-color: #CCFFCC;">
							
							<h2 class="pricing-plan-title" style="color: black;">CREATE QR SECTION</h2>
							<p><img src="img/create.png"></p>
							
							<ul class="pricing-plan-features" style="color: black;">
								<p>This sections allows you to create qr codes for physical and electronic documents</p>
							</ul>
							<a href="createdoc.php" class="btn" style="width: 50%;">Create QR</a>
						</div>
						
						<!-- Physical and Electronic Files -->
					    <div id="fadein" class="pricing-plan" style="right: -18%; width: 35%; height: 400px; background-color: #17825E;">
							<h2 class="pricing-plan-title" style="color: black;">MY FILES SECTION</h2>
							<p> <img src="img/view.png"></p>
								<ul class="pricing-plan-features" style="color: black;">
									<p>This section contains your physical and <br> electronic files</p>
								</ul>
							<a href="myfiles.php" class="btn" style="width: 50%;">View my Files</a>
					    </div>
						
						<!-- Received files -->
					    <div id="fadein" class="pricing-plan" style="right: -13%; width: 35%; height: 400px; background-color: #7ec0ee;">
							<h2 class="pricing-plan-title" style="color: black;">RECEIVE FILES SECTION </h2>
							<p> <img src="img/receive.png"></p>
								<ul class="pricing-plan-features" style="color: black;">
									<p>Contains physical files that <br> were sent to you</p>
								</ul>
							<a href="receive.php" class="btn" style="width: 50%;">View Received Files</a>
					    </div>
						
						<!-- Shared Electronic Documents  -->
						<form method="post" action="e_receive.php">
					    <div id="fadein" class="pricing-plan" style="right: -18%; width: 35%; height: 400px; background-color: #79BEDB;">
							<h2 class="pricing-plan-title" style="color: black;">Electronic Docs shared with me</h2>
							<p> <img src="img/pdffind.png"></p>
								<ul class="pricing-plan-features" style="color: black;">
									<p>List of Electronic Documents that <br> is shared with me</p>
								</ul>
							<input type = 'submit' name='viewpdocs' class='btn' style="width: 50%;" value='View shared edocs'>
					    </div>
						</form>
						
						
						<!-- Create Flow -->
					    <div id="fadein" class="pricing-plan" style="right: -13%; width: 35%; height: 400px; background-color: #E6E6DC;">
							<h2 class="pricing-plan-title" style="color: black;">CREATE FLOW SECTION</h2>
							<p> <img src="img/receive.png"></p>
								<ul class="pricing-plan-features" style="color: black;">
									<p>This section will let you create flow for the passing of document</p>
								</ul>
							<a href="flows.php" class="btn" style="width: 50%;">Create Flow</a>
					    </div>
						
						
						<!-- SEARCH SECTION -->
						<div id="fadein" class="pricing-plan" style="right: -18%; width: 35%; height: 400px; background-color: #CCFFCC;">
							
							<h2 class="pricing-plan-title" style="color: black;">SEARCH DOCUMENT SECTION</h2>
							<p><img src="img/view.png"></p>
							
							<ul class="pricing-plan-features" style="color: black;">
								<p>This sections allows you to <br> search the documents</p>
							</ul>
							<a href="search_doc.php" class="btn" style="width: 50%;">Create QR</a>
						</div>

						

					    <!-- If Admin -->
					    <?php if(isset($_SESSION['position']))
						
						{

						$pos = $_SESSION['position'];
							
						$pos = strtolower($pos);
					
						if($pos == 'admin' || $pos == 'developer')
							{
						
						?>
						
							
			
						<!-- Register a user -->
					    <div id="fadein" class="pricing-plan" style="right: -13%; width: 35%; height: 400px; background-color: #81A594;">
							<h2 class="pricing-plan-title" style="color: black;">REGISTER USER</h2>
							<p> <img src="img/registericon.png"></p>
								<ul class="pricing-plan-features" style="color: black;">
									<p>Register a user that is eligible to use the system</p>
								</ul>
							<a href="page-register.php" class="btn" style="width: 50%;">Register</a>
					    </div>
					    

					    <!-- User Database -->
						<div id="fadein" class="pricing-plan" style="right: -18%; width: 35%; height: 400px; background-color: #999999;">
							
							<h2 class="pricing-plan-title" style="color: black;">USER DATABASE</h2>
							<p><img src="img/dbicon.jpg"></p>
							
							<ul class="pricing-plan-features" style="color: black;">
								<p>List of user that can use the system</p>
							</ul>
							<a href="userdblog.php" class="btn" style="width: 50%;">View Users</a>
						</div>

					   <?php
					   
							}
						}
					   
					   ?>
					   
					   
	        		</div>
	        		
	        	</div>
	    	</div>
	    </div>
	    <!-- End Menu -->