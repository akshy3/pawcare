<?php
//Session & Database initialization
session_start();
include "includes/loginredirect.php";

include "includes/dbconn.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Pawcare | Cart</title>
	<!-- Links to stylesheets -->
	<?php include "includes/links.php" ?>
</head>

<body>
	<!-- Navbar -->
	<?php include "includes/nav.php" ?>
	<div class="container-fluid min-vh-100">
		<!-- Body -->


		<?php
		if (isset($_POST["add_to_cart"])) {
			if (isset($_SESSION["shopping_cart"])) {
				$item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
				if (!in_array($_GET["id"], $item_array_id)) {
					$count = count($_SESSION["shopping_cart"]);
					$item_array = array(
						'item_id'			=>	$_GET["id"],
						'item_name'			=>	$_POST["hidden_name"],
						'item_price'		=>	$_POST["hidden_price"],
						'item_quantity'		=>	$_POST["quantity"]
					);
					$_SESSION["shopping_cart"][$count] = $item_array;
				} else {
					echo '<script>swal("Item Already Added")</script>';
				}
			} else {
				$item_array = array(
					'item_id'			=>	$_GET["id"],
					'item_name'			=>	$_POST["hidden_name"],
					'item_price'		=>	$_POST["hidden_price"],
					'item_quantity'		=>	$_POST["quantity"]
				);
				$_SESSION["shopping_cart"][0] = $item_array;
			}
		}

		if (isset($_GET["action"])) {
			if ($_GET["action"] == "delete") {
				foreach ($_SESSION["shopping_cart"] as $keys => $values) {
					if ($values["item_id"] == $_GET["id"]) {
						unset($_SESSION["shopping_cart"][$keys]);
						echo '<script>swal("Item Removed").then(()=>window.location="cart.php")</script>';
					}
				}
			}
		}

		?>

		<br />
		<div class="container">

			<div style="clear:both"></div>
			<br />
			<h3>Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if (!empty($_SESSION["shopping_cart"])) {
						$total = 0;
						foreach ($_SESSION["shopping_cart"] as $keys => $values) {
					?>
							<tr>
								<td><?php echo $values["item_name"]; ?></td>
								<td><?php echo $values["item_quantity"]; ?></td>
								<td>Rs <?php echo $values["item_price"]; ?></td>
								<td>Rs <?php echo number_format($values["item_quantity"] * $values["item_price"], 2); ?></td>
								<td><a href="cart.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
							</tr>
						<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
						?>
						<tr>
							<td colspan="3" align="right">Total</td>
							<td align="right">Rs <?php echo number_format($total, 2); ?></td>
							<td></td>
						</tr>
					<?php
					}
					?>

				</table>
				<?php if (isset($total)) { ?>

					<form action="order.php" method="post">
						<input type="hidden" name="totalprice" value="<?php echo $total; ?>" />
						<button type="submit" class="btn btn-primary">Proceed to Payment</button>
					</form>
					
				<?php } ?>

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