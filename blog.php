<?php include('./components/includes.php') ?>
<?php include('./components/header.php') ?>
<!-- breadcrumb area start -->
<section class="breadcrumb-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-area-content">
					<h1>Blog Page</h1>
				</div>
			</div>
		</div>
	</div>
</section><!-- breadcrumb area end -->
<!-- blog area start -->
<section class="blog-area">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="section-title pb-20">
					<h1><i class="icofont icofont-coffee-cup"></i> Latest News</h1>
				</div>
			</div>
		</div>
		<hr />
		<div class="row">
			<div class="col-lg-12">
				<?php
				$query = "SELECT * FROM blog ORDER BY id DESC LIMIT 5";
				$result = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($result)) {
					$id  = $row['id'];
					$topic  = $row['topic'];
					$content  = $row['content'];
					$image  = $row['image'];
					$created_at  = $row['created_at'];
					$newDate = date("d-M-Y", strtotime($created_at));
					$year = substr($newDate, 7, 4);
					$day = substr($created_at, 5, -3);
					$month = substr($newDate, 3, -5);
					echo "<a href='blog_details.php?blog_id=$id'>
					<div class='single-news'>
				<div class='col-md-12'><img src='$image'></div>
				<div class='news-date'>
					<h2><span>$month</span> $day</h2>
					<h1>$year</h1>
				</div>
				<div class='news-content'>
					<h2>$topic</h2>
					<p>$content</p>
				</div>
			</div></a>";
				}
				?>
			</div>
		</div>
	</div>
</section>
<!-- blog area end -->
<?php include('./components/footer.php') ?>