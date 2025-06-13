
<?php 
    error_reporting(0);
    include 'db.php';

    // Fetch product details based on the product_id from the URL
    $product_id = $_GET['id'];
    $product_query = mysqli_query($conn, "SELECT * FROM tb_product WHERE product_id = '$product_id' AND product_status = 1");
    $p = mysqli_fetch_object($product_query);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Joe Shop</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
</head>
<body>
    <!-- header -->
    <header>
        <div class="container">
            <h1><a href="index.php">Joe Shop</a></h1>
            <ul>
                <li><a href="produk.php">Produk</a></li>
            </ul>
        </div>
    </header>

    <!-- product detail -->
    <div class="section">
        <div class="container">
            <h3>Detail Produk</h3>
            <div class="box">
                <?php if ($p) { ?>
                <div class="col-2">
                    <img src="produk/<?php echo $p->product_image ?>" width="100%">
                </div>
                <div class="col-2">
                    <h3><?php echo $p->product_name ?></h3>
                    <h4>Rp. <?php echo number_format($p->product_price) ?></h4>
                    <p>Deskripsi :<br>
                        <?php echo $p->product_description ?>
                    </p>
                    <p>   Hubungi via Whatsapp
                        <a href="https://api.whatsapp.com/send?phone=<?php echo $a->admin_telp ?>&text=Hai, saya tertarik dengan produk Anda." target="_blank">
                         <br>
                            <img src="img/wa.png" width="50px">
                        </a>
                    </p>
                </div>
                <?php } else { ?>
                    <p>Produk tidak ditemukan.</p>
                <?php } ?>
            </div>
        </div>
    </div>
	<footer>
		<div class="container">
			<small>Copyright &copy; 2025 - Joshua Setiawan.</small>
		</div>
	</footer>
</body>
</html>