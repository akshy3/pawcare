<?php
//Session & Database initialization
session_start();
include "includes/dbconn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pawcare | Home</title>
	<!-- Links to stylesheets -->
	<?php include "includes/links.php" ?>
</head>

<body>
	<!-- Navbar -->
	<?php include "includes/nav.php" ?>
	<div class="container-fluid min-vh-100">
		<!-- Body -->

		<!-- Hero section -->
		<div class="hero-wrap js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-center" data-scrollax-parent="true">
					<div class="col-md-11 ftco-animate text-center">
						<h1 class="mb-4">Highest Quality Care For Pets You'll Love </h1>
						<p><a href="login.php" class="btn btn-primary mr-md-4 py-3 px-4">Explore more <span class="ion-ios-arrow-forward"></span></a></p>
					</div>
				</div>
			</div>
		</div>


		<!-- Services -->

		<section class="ftco-section bg-light ftco-no-pt ftco-intro">
			<div class="container">
				<div class="row">
					<div class="col-md-6 d-flex align-self-stretch px-4 ftco-animate">
						<div class="d-block services active text-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<!-- <span class="flaticon-blind"></span> -->
								<span class="flaticon-pawprint-1"></span>
							</div>
							<div class="media-body">
								<h3 class="heading">Pet Essentials</h3>
								<p>Everything your pet need is here. Shop Now!</p>
								<a href="category_view.php" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
							</div>
						</div>
					</div>
					<div class="col-md-6 d-flex align-self-stretch px-4 ftco-animate">
						<div class="d-block services text-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="flaticon-veterinarian"></span>
							</div>
							<div class="media-body">
								<h3 class="heading">Pet Sitting</h3>
								<p>Want to sit your pet? Book your appointment!</p>
								<a href="petsit.php" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
							</div>
						</div>
					</div>
					<!-- <div class="col-md-4 d-flex align-self-stretch px-4 ftco-animate">
						<div class="d-block services text-center">
							<div class="icon d-flex align-items-center justify-content-center">
								<span class="flaticon-stethoscope"></span>
							</div>
							<div class="media-body">
								<h3 class="heading">Pet Grooming</h3>
								<p>Pet grooming service. Blah blah.</p>
								<a href="#" class="btn-custom d-flex align-items-center justify-content-center"><span class="fa fa-chevron-right"></span><i class="sr-only">Read more</i></a>
							</div>
						</div>
					</div> -->
				</div>
			</div>
		</section>



		<!-- Features -->

		<section class="ftco-section ftco-no-pt ftco-no-pb">
			<div class="container">
				<div class="row d-flex no-gutters">
					<div class="col-md-5 d-flex">
						<div class="img img-video d-flex align-self-stretch align-items-center justify-content-center justify-content-md-center mb-4 mb-sm-0" style="background-image:url(images/about-1.jpg);">
						</div>
					</div>
					<div class="col-md-7 pl-md-5 py-md-5">
						<div class="heading-section pt-md-5">
							<h2 class="mb-4">Why Choose Us?</h2>
						</div>
						<div class="row">
							<div class="col-md-6 services-2 w-100 d-flex">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-stethoscope"></span></div>
								<div class="text pl-3">
									<h4>Care Advices</h4>
									<p>Far far away, behind the word mountains, far from the countries.</p>
								</div>
							</div>
							<div class="col-md-6 services-2 w-100 d-flex">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-customer-service"></span></div>
								<div class="text pl-3">
									<h4>Customer Supports</h4>
									<p>Far far away, behind the word mountains, far from the countries.</p>
								</div>
							</div>
							<div class="col-md-6 services-2 w-100 d-flex">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-emergency-call"></span></div>
								<div class="text pl-3">
									<h4>Emergency Services</h4>
									<p>Far far away, behind the word mountains, far from the countries.</p>
								</div>
							</div>
							<div class="col-md-6 services-2 w-100 d-flex">
								<div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-veterinarian"></span></div>
								<div class="text pl-3">
									<h4>Veterinary Help</h4>
									<p>Far far away, behind the word mountains, far from the countries.</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>

		<!-- Contact Form -->

		<div class="row no-gutters">
			<div class="col-md-7">
				<div class="contact-wrap w-100 p-md-5 p-4">
					<h3 class="mb-4">Contact Us</h3>
					<form action="contact.php" method="POST" id="contactForm" name="contactForm" class="contactForm">
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label class="label" for="name">Full Name</label>
									<input type="text" class="form-control" name="name" id="name" placeholder="Name" required>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label class="label" for="email">Email Address</label>
									<input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="label" for="subject">Subject</label>
									<input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label class="label" for="#">Message</label>
									<textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Message" required></textarea>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<input type="submit" value="Send Message" class="btn btn-primary" name="submit">
									<div class="submitting"></div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col-md-5 d-flex align-items-stretch">
				<div class="info-wrap w-100 p-5 img" style="background-image: url(images/img.jpg);">
				</div>
			</div>
		</div>




		<!-- End of Body -->
	</div>

	<!-- Footer -->
	<?php include "includes/footer.php" ?>

	<!-- Scripts -->
	<?php include "includes/scripts.php" ?>
</body>

</html>