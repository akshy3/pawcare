<!-- Navigation -->



<?php 

include "loginredirect.php";

if (isset($_SESSION['r_name'])) {; ?>
	<nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-light ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<div class="col-xs-4 d-flex justify-content-between align-items-center flex-grow-1">
				<a class="navbar-brand" href="index.php"><span class="flaticon-pawprint-1 mr-2"></span>Pawcare</a>

			</div>



				<button class="navbar-toggler p-2" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span>
				</button>

				<div class="collapse navbar-collapse flex-grow-0" id="ftco-nav">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item <?php if (basename($_SERVER['SCRIPT_NAME']) == 'index.php') {
												echo 'active';
											} else {
												echo '';
											} ?>"><a href="index.php" class="nav-link">Dashboard</a></li>
						<li class="nav-item <?php if (basename($_SERVER['SCRIPT_NAME']) == 'products.php') {
												echo 'active';
											} else {
												echo '';
											} ?>"><a href="products.php" class="nav-link">Products</a></li>
						<li class="nav-item <?php if (basename($_SERVER['SCRIPT_NAME']) == 'users.php') {
												echo 'active';
											} else {
												echo '';
											} ?>"><a href="users.php" class="nav-link">Users</a></li>
					</ul>
				</div>
				<div class="dropdown avatar pull-right">

<a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	<!-- <span class="fa fa-user"></span> -->
	<span class="avatar-name">@<?php echo $_SESSION['r_name'] ?></span>
</a>
<div class="dropdown-menu divider avatar-drop" aria-labelledby="navbarDropdownMenuLink">
	<a class="dropdown-item" href="profile.php">Profile</a>
	<a class="dropdown-item" href="category.php">Pet Category</a>
	<a class="dropdown-item" href="productcategory.php">Product Category</a>
	<a class="dropdown-item" href="../logout.php">Log out</a>
</div>
</div>

		</div>
	</nav>
<?php } else { ?>
	<nav class="navbar navbar-expand-lg navbar-light ftco_navbar bg-light ftco-navbar-light" id="ftco-navbar">
		<div class="container">
			<div>

				<a class="navbar-brand" href="index.php"><span class="flaticon-pawprint-1 mr-2"></span>Pawcare</a>
			</div>
			<button class="navbar-toggler p-2" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="fa fa-bars"></span>
			</button>
			<div class="collapse navbar-collapse" id="ftco-nav">
				<ul class="navbar-nav ml-auto">
					<li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
					<li class="nav-item"><a href="login.php" class="nav-link">Log In</a></li>
				</ul>
			</div>

		</div>
	</nav>
<?php }; ?>

<!-- END nav -->