<html>

	<head>
		<link rel="stylesheet" href="css/main.css">
	</head>
	
	
	<body>
		<div id="fadein" class="container">
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
 <div class="mail-box">
                  
                      

                          <table class="table table-inbox table-hover">
						  
						   <?php $conn = new mysqli('localhost','root','usbw','docdb');
						 
								$id = $_SESSION['userid'];

								$sql = "select * from notification where recepient = '$id' ";
								
								$res = $conn->query($sql);
								
								
								while($data = $res->fetch_assoc())
								{
									
									if($data['physical'] == true)
									{

						 ?>

                            <tbody>
							  <tr class="unread" onclick="location.href='receive.php'">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">Notification</td>
                                  <td class="view-message " ><?php echo $data['message']; ?></td>
                                  <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message  text-right"><?php echo $data['date']; ?></td>
                              </tr>
							</tbody>
							
						    <?php  } else if($data['electronic'] == true) {  ?>
							
							<tbody>
							  <tr class="unread" onclick="location.href='e_receive.php'">
                                  <td class="inbox-small-cells">
                                      <input type="checkbox" class="mail-checkbox">
                                  </td>
                                  <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                  <td class="view-message  dont-show">Notification</td>
                                  <td class="view-message " ><?php echo $data['message']; ?></td>
                                  <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                  <td class="view-message  text-right"><?php echo $data['date']; ?></td>
                              </tr>
							</tbody>
							
							
							
							<?php } } ?>
						  
                          </table>
                      </div>
                  </aside>
              </div>
</div>
	</body>

</html>