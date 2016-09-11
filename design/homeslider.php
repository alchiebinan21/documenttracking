<!-- if login is false -->
        <?php if(!isset($_SESSION['access'])) { ?>
		<br>
		<br>
		<!-- Homepage Slider -->
        <div id="fadein" class="homepage-slider">
        	<div id="sequence">
				<ul class="sequence-canvas">
					<!-- Slide 1 -->
					<li class="bg4">
						<!-- Slide Title -->
						<h2 class="title">Welcome!</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">This is a document tracking system that uses qr code</h3>
						<!-- Slide Image -->
						<!--<img class="slide-img" src="img/homepage-slider/slide1.png" alt="Slide 1" />-->
					</li>
					<!-- End Slide 1 -->
					<!-- Slide 2 -->
					<li class="bg3">
						<!-- Slide Title -->
						<h2 class="title">Reliable</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">Easy to track documents by knowing the last holder of the document!</h3>
						<!-- Slide Image -->
						
					</li>
					<!-- End Slide 2 -->
					<!-- Slide 3 -->
					<li class="bg1">
						<!-- Slide Title -->
						<h2 class="title">User-friendly UI</h2>
						<!-- Slide Text -->
						<h3 class="subtitle">Easy to use website for convenience</h3>
						<!-- Slide Image -->
						
					</li>
					<!-- End Slide 3 -->
				</ul>
				<div class="sequence-pagination-wrapper">
					<ul class="sequence-pagination">
						<li>1</li>
						<li>2</li>
						<li>3</li>
					</ul>
				</div>
			</div>
        </div>
        <!-- End Homepage Slider -->
		
		
		<?php } ?>