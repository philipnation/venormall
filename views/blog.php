<?php
include("inc/header.php");
?>
<br><br>
<!------------------------------------------
HEADER
------------------------------------------->
<!--
<div class="jumbotron jumbotron-lg jumbotron-fluid mb-3 bg-primary position-relative" style="background-color: #0D0E52;">
	<div class="container text-white h-100 tofront">
		<div class="row align-items-center justify-content-center text-center">
			<div class="col-md-10">
				<h1 class="display-3">Get marketing updates to help you grow your Business.</h1>
			</div>
		</div>
	</div>
</div>
-->
<!-- End Header -->
    
<section class="pt-5 pb-5" data-aos="fade-down">
<div class="container">
    
    <!-- Blog Cards -->
	<div class="row gap-y">
	<?php
		include("handlers/conn.php");
		$blog_result = mysqli_query($conn,"SELECT * FROM blogs WHERE status = 'sent'");
		if (mysqli_num_rows($blog_result)>0){
			while ($row_blog = mysqli_fetch_assoc($blog_result)) {
				echo "
					<div class='col-md-6 col-lg-4'>
						<div class='card'>
							<img class='img-card-top' src='../assets/img/blogimages/$row_blog[image]'>
							<strong class='d-inline-block mb-2 text-success' style='text-align:center;'>$row_blog[category]</strong>
							<div class='card-body'>
								<a href='#'>
								<h5 class='card-title text-dark'>$row_blog[title]</h5>
								<span class='card-text text-muted'>
								Posted on $row_blog[date] </span>
								</a>
							</div>
						</div>
					</div>
				";
			}
		}
		else{
			echo "<span class='card-text text-muted'>No Blog Posted yet</span>";
		}
		?>
	</div>
    <!-- End Blog Cards -->
    
</div>
</section>
<?php
include("inc/footer.php");
?>