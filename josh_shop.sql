SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


-- Table structure for table `tb_admin`
CREATE TABLE `tb_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `admin_telp` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




-- Table structure for table `tb_category`
CREATE TABLE `tb_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- Table structure for table `tb_product`
CREATE TABLE `tb_product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` int(11) NOT NULL,
  `product_description` text NOT NULL,
  `product_image` varchar(100) NOT NULL,
  `product_status` tinyint(1) NOT NULL,
  `data_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE `tb_cart_items` (
  `cart_item_id` INT(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `user_id` INT(11) NOT NULL, -- Ini akan mengacu ke ID pengguna (misalnya dari tb_admin atau tb_customer)
  `product_id` INT(11) NOT NULL,
  `quantity` INT(11) NOT NULL DEFAULT 1,
  `date_added` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
  `last_updated` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() ON UPDATE CURRENT_TIMESTAMP(),
  CONSTRAINT fk_cart_product FOREIGN KEY (`product_id`) REFERENCES `tb_product`(`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Indeks tambahan untuk performa (opsional, tapi disarankan)
CREATE INDEX idx_cart_user_id ON `tb_cart_items` (`user_id`);
CREATE INDEX idx_cart_product_id ON `tb_cart_items` (`product_id`);

ALTER TABLE `tb_admin`
  ADD PRIMARY KEY (`admin_id`);

ALTER TABLE `tb_category`
  ADD PRIMARY KEY (`category_id`);

ALTER TABLE `tb_product`
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `category_id` (`category_id`);


-- AUTO_INCREMENT for table `tb_admin`
ALTER TABLE `tb_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


-- AUTO_INCREMENT for table `tb_category`
ALTER TABLE `tb_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;


-- AUTO_INCREMENT for table `tb_product`
ALTER TABLE `tb_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;
