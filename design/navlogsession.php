<!-- Navigation & Logo-->
        <div class="mainmenu-wrapper" style="position: fixed; width: 100%;">
	        <div class="container">
	        	<div class="menuextras">
					<div class="extras">
						<ul>
							<!--<li class="shopping-cart-items" ><i class="glyphicon glyphicon-shopping-cart icon-white"></i> <a href="page-shopping-cart.html"><b>3 items</b></a></li>
							<li>
								<div class="dropdown choose-country">
									<a class="#" data-toggle="dropdown" href="#"><img src="img/flags/us.png" alt="United States"> US</a>
									<ul class="dropdown-menu" role="menu">
										<li role="menuitem"><a href="#"><img src="img/flags/gb.png" alt="Great Britain"> UK</a></li>
										<li role="menuitem"><a href="#"><img src="img/flags/de.png" alt="Germany"> DE</a></li>
										<li role="menuitem"><a href="#"><img src="img/flags/es.png" alt="Spain"> ES</a></li>
									</ul>
								</div>
							</li>-->
							
							
			        		
							
							<?php if(!isset($_SESSION['access'])) { ?>
							
							<a href="page-login.php">Login</a>
							
							
							<?php } ?>
							
							
							
							
			        	</ul>
					</div>
		        </div>
		        <nav id="mainmenu" class="mainmenu">
					<ul>
						<li class="logo-wrapper"><a href="index.php"><img style="width: 50px;" src="img/home.png" alt="Multipurpose Twitter Bootstrap Template"></a></li>
						
						<?php if(isset($_SESSION['access']) && $_SESSION['access'] == true) { ?>

						
						
						<!--login session -->
							<?php if(isset($_SESSION['access']) && $_SESSION['access'] == true) {
							
							if(time() - $_SESSION['time'] > 5000)
							{ 
							
								$_SESSION = array();
								session_destroy();
								echo "<script> alert('Session Timeout!'); window.location='index.php'; </script>";
							
							} ?>
							<li style="float: right;">
							
							
							<button onclick="myFunction()"  class="dropbtn"  style = "height: 50px; color: black;">Profile</button>
							<div id="myDropdown" class="dropdown-content">
								<a href="#"><?php echo $_SESSION['name'];?></a>
								<a href="#"><?php echo $_SESSION['position'];?></a>
								<a href="#"><?php echo $_SESSION['email'];?></a>
								
								<form method="post" action="success.php">
								<button type="submit"  style = "height: 50px; width: 100%; color: #999" name="lo"  value="Logout">Logout</button>
								</form>
							</div>
							
							
								
								
							
							</li>
							
							
							
							<?php } ?>
							
							
						<!-- messages -->
						<li >
						
							<?php 
									$notif = 0;
									$rm = 0;
									
									$conn = new mysqli('localhost','root','usbw','docdb');
									
									$idd = $_SESSION['userid'];
									
									$sql = "select * from notification where recepient = '$idd' ";
									
									$res = $conn->query($sql);
									
									while($data = $res->fetch_assoc())
									{
										if($data['readmsg'] == false)
										{
											$rm++;
											$notif++;
										}
										
										
									}
									
									if($notif > 0 &&  $rm > 0 )
									{
										
										echo '<div class="badge">';
										echo '<div class="message-count">'.$notif.'</div>';
										echo '</div>';
										echo '<button onclick="myFunctionNotif()"  class="dropbtn" style = "background: url(img/icon_mail.png) no-repeat center;  margin-right: 50px; width: 50px;  "></button>';
									}
										
										
									else if($notif <= 0 || $rm <= 0)
									{
										echo '<button onclick="myFunctionNotif()"  class="dropbtn" style = "background: url(img/icon_mail.png) no-repeat center;  margin-right: 50px; width: 50px;  "></button>';
									}
							?>
							
							
							<div id="myDropdownNotif" class="dropdown-content">
							
								<?php 
								
										$sql = "select * from notification where recepient = '$idd'";
										
										$res = $conn->query($sql);
										
										while($data = $res->fetch_assoc())
										{
											
										
								?>
										<form method="post" action="messages.php">
										<input type="hidden" name="msg_id" value="<?php echo $data['msg_id']; ?>">
										
										<?php if($data['readmsg'] == true) { ?>
										<button type="submit" value="readmessage" name="readmessage"  style = "height: 50px; width: 100%; color: black; "> <?php echo $data['message']; ?> </button>
										<?php } else if($data['readmsg'] == false) { ?>
										<button type="submit" value="readmessage" name="readmessage"  style = "height: 50px; width: 100%; color: black; "><b> <?php echo $data['message']; ?></b> </button>
										<?php }?>
										
										</form>
								
								<?php   } ?>
								<br>
								<br>
								<br>
								<a href="messages.php"  style = "height: 50px; width: 100%; color: #999; ">See all messages</a>
								
								
							</div>
							
								
						</li>
						
						
						
						<?php } ?>
					    
						
					</ul>
					
					
					
				</nav>
			</div>
		</div>
		
		