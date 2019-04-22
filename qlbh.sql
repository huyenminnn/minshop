/*
 Navicat Premium Data Transfer

 Source Server         : server
 Source Server Type    : MySQL
 Source Server Version : 100136
 Source Host           : localhost:3306
 Source Schema         : qlbh

 Target Server Type    : MySQL
 Target Server Version : 100136
 File Encoding         : 65001

 Date: 22/04/2019 17:50:54
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for address_customers
-- ----------------------------
DROP TABLE IF EXISTS `address_customers`;
CREATE TABLE `address_customers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `customer_id` int(11) NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for branches
-- ----------------------------
DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `manager_id` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of branches
-- ----------------------------
INSERT INTO `branches` VALUES (1, 'Chi nhánh Giải Phóng', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', 1, '2019-04-05 09:23:35', '2019-04-05 09:23:35');
INSERT INTO `branches` VALUES (2, 'Chi nhánh Trương Định', 'Số 325, đường Trương Định, Hai Bà Trưng, Hà Nội', 2, '2019-04-05 09:28:24', '2019-04-05 09:28:24');

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 12 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES (1, 'Áo mùa đông', 'ao-mua-dong', '<p>&Aacute;o lạnh</p>', NULL, '2019-04-04 14:10:35', 0);
INSERT INTO `categories` VALUES (2, 'Quần dài', 'quan-dai', '<p>Quần d&agrave;i</p>', NULL, '2019-04-04 14:11:34', 0);
INSERT INTO `categories` VALUES (3, 'Váy', 'vay', 'q', '2019-04-03 10:37:12', '2019-04-03 10:37:12', 0);
INSERT INTO `categories` VALUES (4, 'Chân váy', 'chan-vay', 'q', '2019-04-04 09:09:21', '2019-04-04 09:09:21', 0);
INSERT INTO `categories` VALUES (5, 'Khăn', 'khan', 'ooo', '2019-04-04 09:11:07', '2019-04-04 09:11:07', 0);
INSERT INTO `categories` VALUES (10, 'Áo khoác đại hàn', 'ao-khoac-dai-han', '<p>&Aacute;o kho&aacute;c cho m&ugrave;a đ&ocirc;ng</p>', '2019-04-04 13:55:39', '2019-04-04 13:55:39', 1);
INSERT INTO `categories` VALUES (11, 'Áo len', 'ao-len', '<p>&Aacute;o&nbsp;len cho m&ugrave;a đ&ocirc;ngvvv</p>', '2019-04-04 13:56:00', '2019-04-05 03:32:32', 1);

-- ----------------------------
-- Table structure for coupons
-- ----------------------------
DROP TABLE IF EXISTS `coupons`;
CREATE TABLE `coupons`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_time` datetime(0) NULL DEFAULT NULL,
  `end_time` datetime(0) NULL DEFAULT NULL,
  `code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `money` double NULL DEFAULT NULL,
  `percent` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of coupons
-- ----------------------------
INSERT INTO `coupons` VALUES (1, 'Ngày quốc tế nói dối', '2019-03-31 00:00:00', '2019-04-07 00:00:00', 'ND14', 100000, 0, '2019-04-04 18:14:36', '2019-04-05 04:01:58');
INSERT INTO `coupons` VALUES (3, 'Giỗ tổ Hùng Vương', '2019-04-06 00:00:00', '2019-04-13 00:00:00', 'GIOTO', 0, 40, '2019-04-05 08:24:59', '2019-04-05 08:24:59');

-- ----------------------------
-- Table structure for customers
-- ----------------------------
DROP TABLE IF EXISTS `customers`;
CREATE TABLE `customers`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `level` int(11) NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `customers_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of customers
-- ----------------------------
INSERT INTO `customers` VALUES (1, 'Minh Huyền', 'huyen@gmail.com', NULL, '$2y$10$QnQiL/LCE/Z6BfAGpaenn.sN7EAyGo/RTq6gzBBxVAMdem.GJhst2', 'pZCyrfyyVZfW3zzsA6G43HF7oJ31UxJoyhQJvzkpmbd1rBfAqJL1lWAkuFwK', NULL, '2019-04-12 10:47:58', '0963326470', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', 'Nam', 0, 'avatars/huyen.jpg');
INSERT INTO `customers` VALUES (7, 'Hoài Thương', 'thuong@gmail.com', NULL, '$2y$10$bqx5d.vlEKO6WXdAv0OE3uhsCYpJZPsBShcONSTk36iwpRpuu9aP6', NULL, '2019-04-12 10:35:06', '2019-04-12 10:35:06', '0326545622', 'aaaa', 'Nam', 0, 'avatars//20171224_181642.jpg');

-- ----------------------------
-- Table structure for employees
-- ----------------------------
DROP TABLE IF EXISTS `employees`;
CREATE TABLE `employees`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `salary` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `branch` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `employees_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of employees
-- ----------------------------
INSERT INTO `employees` VALUES (3, 'Huyền', 'huyen@gmail.com', 'Nu', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', '0326545622', '5000000', 2, '2019-04-05 12:24:18', '2019-04-05 13:03:58', 'avatar/48373208_629101354159696_4431857584579805184_n.jpg');
INSERT INTO `employees` VALUES (5, 'Minh Huyền', 'huyenhuyen@gmail.com', 'Nam', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', '0326545622', '5000000', 1, '2019-04-12 10:25:21', '2019-04-12 10:25:21', 'avatars/default-profile.png');

-- ----------------------------
-- Table structure for images
-- ----------------------------
DROP TABLE IF EXISTS `images`;
CREATE TABLE `images`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `image` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 25 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of images
-- ----------------------------
INSERT INTO `images` VALUES (14, 2, 'images/3-1.jpg', '2019-04-07 17:11:39', '2019-04-07 17:11:39');
INSERT INTO `images` VALUES (16, 3, 'images/15894339_686763944816512_8948747360093527762_n.jpg', '2019-04-07 17:11:39', '2019-04-07 17:11:39');
INSERT INTO `images` VALUES (17, 4, 'images/20171224_181802.jpg', '2019-04-08 11:56:24', '2019-04-08 11:56:24');
INSERT INTO `images` VALUES (19, 5, 'images/20171224_181817.jpg', '2019-04-18 19:09:19', '2019-04-18 19:09:19');
INSERT INTO `images` VALUES (20, 5, 'images/20171111_233318.jpg', '2019-04-18 19:09:36', '2019-04-18 19:09:36');
INSERT INTO `images` VALUES (22, 5, 'images/15894339_686763944816512_8948747360093527762_n.jpg', '2019-04-19 18:44:14', '2019-04-19 18:44:14');
INSERT INTO `images` VALUES (23, 5, 'images/20170901_204228.jpg', '2019-04-19 18:44:14', '2019-04-19 18:44:14');
INSERT INTO `images` VALUES (24, 5, 'images/20171111_233318.jpg', '2019-04-19 18:44:14', '2019-04-19 18:44:14');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2014_10_12_100000_create_password_resets_table', 1);
INSERT INTO `migrations` VALUES (3, '2019_03_24_124026_create_products_table', 1);
INSERT INTO `migrations` VALUES (4, '2019_03_24_124157_create_employees_table', 1);
INSERT INTO `migrations` VALUES (6, '2019_03_25_084138_create_customers_table', 1);
INSERT INTO `migrations` VALUES (7, '2019_03_25_085504_create_branches_table', 1);
INSERT INTO `migrations` VALUES (8, '2019_03_25_090426_create_product_details_table', 1);
INSERT INTO `migrations` VALUES (9, '2019_03_25_114844_create_categories_table', 1);
INSERT INTO `migrations` VALUES (10, '2019_03_25_122317_create_address_customers_table', 1);
INSERT INTO `migrations` VALUES (11, '2019_03_25_124413_create_order_details_table', 1);
INSERT INTO `migrations` VALUES (12, '2019_03_25_124810_create_coupons_table', 1);
INSERT INTO `migrations` VALUES (13, '2019_03_25_132229_create_images_table', 2);
INSERT INTO `migrations` VALUES (15, '2019_03_28_161948_add_column_to_users_table', 4);
INSERT INTO `migrations` VALUES (17, '2019_03_24_124250_create_orders_table', 5);
INSERT INTO `migrations` VALUES (18, '2019_03_29_133242_add_column_to_categories_table', 6);
INSERT INTO `migrations` VALUES (19, '2019_04_01_040101_create_options_table', 7);
INSERT INTO `migrations` VALUES (20, '2019_04_01_040238_create_option_values_table', 7);
INSERT INTO `migrations` VALUES (21, '2019_04_01_130451_create_table_customers_table', 8);
INSERT INTO `migrations` VALUES (22, '2019_04_01_133831_add_column_to_customers_table', 9);
INSERT INTO `migrations` VALUES (24, '2019_04_08_084841_add_column_to_customers_table', 10);
INSERT INTO `migrations` VALUES (25, '2019_04_08_091133_add_column_to_customers_table', 11);
INSERT INTO `migrations` VALUES (26, '2019_04_12_113541_add_column_to_users_table', 12);
INSERT INTO `migrations` VALUES (27, '2019_04_12_140258_create_shoppingcart_table', 13);
INSERT INTO `migrations` VALUES (28, '2019_04_07_125631_entrust_setup_tables', 14);
INSERT INTO `migrations` VALUES (29, '2019_04_21_094251_add_column_to_products_table', 15);
INSERT INTO `migrations` VALUES (30, '2019_04_21_152029_add_column_to_order_details_table', 16);

-- ----------------------------
-- Table structure for option_values
-- ----------------------------
DROP TABLE IF EXISTS `option_values`;
CREATE TABLE `option_values`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `option_id` int(11) NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of option_values
-- ----------------------------
INSERT INTO `option_values` VALUES (1, 1, 'XS', NULL, NULL);
INSERT INTO `option_values` VALUES (2, 1, 'S', NULL, NULL);
INSERT INTO `option_values` VALUES (3, 1, 'M', NULL, NULL);
INSERT INTO `option_values` VALUES (4, 1, 'L', NULL, NULL);
INSERT INTO `option_values` VALUES (5, 1, 'XL', NULL, NULL);
INSERT INTO `option_values` VALUES (6, 1, 'XXL', NULL, NULL);
INSERT INTO `option_values` VALUES (7, 1, 'Freesize', NULL, NULL);

-- ----------------------------
-- Table structure for options
-- ----------------------------
DROP TABLE IF EXISTS `options`;
CREATE TABLE `options`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `options_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of options
-- ----------------------------
INSERT INTO `options` VALUES (1, 'size', NULL, NULL);
INSERT INTO `options` VALUES (2, 'color', NULL, NULL);

-- ----------------------------
-- Table structure for order_details
-- ----------------------------
DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_id` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `product_detail_id` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 7 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of order_details
-- ----------------------------
INSERT INTO `order_details` VALUES (1, 'online15558368961', 1, 425000, '2019-04-21 15:54:56', '2019-04-21 15:54:56', 5, 2);
INSERT INTO `order_details` VALUES (2, 'online15558374561', 1, 425000, '2019-04-21 16:04:16', '2019-04-21 16:04:16', 5, 2);
INSERT INTO `order_details` VALUES (3, 'online15558378451', 5, 2250000, '2019-04-21 16:10:45', '2019-04-21 16:10:45', 2, 1);
INSERT INTO `order_details` VALUES (4, 'online15558379611', 1, 425000, '2019-04-21 16:12:41', '2019-04-21 16:12:41', 5, 3);
INSERT INTO `order_details` VALUES (5, 'online15558379611', 10, 4500000, '2019-04-21 16:12:41', '2019-04-21 16:12:41', 2, 1);
INSERT INTO `order_details` VALUES (6, 'online15558398291', 2, 850000, '2019-04-21 16:43:49', '2019-04-21 16:43:49', 5, 2);

-- ----------------------------
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `customer_mobile` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `delivery_unit` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `coupon_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `reason_reject` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `user_id` int(11) NULL DEFAULT NULL,
  `total` double NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `tax` double NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES (1, '', 0, '', '', '', 'confirmed', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `orders` VALUES (2, '', 0, '', '', '', 'canceled', NULL, NULL, NULL, '<p>i like!!!</p>', NULL, 0, NULL, '2019-04-21 22:26:20', 0);
INSERT INTO `orders` VALUES (3, '', 0, '', '', '', 'delivered', NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 0);
INSERT INTO `orders` VALUES (6, 'online15558368961', 1, 'Minh Huyền', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', '0963326470', 'confirmed', NULL, 'GHN', NULL, NULL, NULL, 467500, '2019-04-21 15:54:56', '2019-04-21 22:01:14', 42500);
INSERT INTO `orders` VALUES (7, 'online15558374561', 1, 'Minh Huyền', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', '0963326470', 'confirmed', NULL, 'GHTK', NULL, NULL, NULL, 467500, '2019-04-21 16:04:16', '2019-04-21 22:03:16', 42500);
INSERT INTO `orders` VALUES (8, 'online15558378451', 1, 'Minh Huyền', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', '0963326470', 'notconfirmed', NULL, 'VP', NULL, NULL, NULL, 2475000, '2019-04-21 16:10:45', '2019-04-21 16:10:45', 225000);
INSERT INTO `orders` VALUES (9, 'online15558379611', 1, 'Minh Huyền', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', '0963326470', 'notconfirmed', NULL, 'GHN', NULL, NULL, NULL, 5417500, '2019-04-21 16:12:41', '2019-04-21 16:12:41', 492500);
INSERT INTO `orders` VALUES (10, 'online15558398291', 1, 'Minh Huyền', 'Số 601, đường Giải Phóng, Hoàng Mai, Hà Nội', '0963326470', 'notconfirmed', NULL, 'GHN', NULL, NULL, NULL, 935000, '2019-04-21 16:43:49', '2019-04-21 16:43:49', 85000);

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets`  (
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  INDEX `password_resets_email_index`(`email`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for permission_role
-- ----------------------------
DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role`  (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`, `role_id`) USING BTREE,
  INDEX `permission_role_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permission_role
-- ----------------------------
INSERT INTO `permission_role` VALUES (1, 1);
INSERT INTO `permission_role` VALUES (1, 2);
INSERT INTO `permission_role` VALUES (1, 4);
INSERT INTO `permission_role` VALUES (2, 1);
INSERT INTO `permission_role` VALUES (2, 2);
INSERT INTO `permission_role` VALUES (2, 4);
INSERT INTO `permission_role` VALUES (3, 1);
INSERT INTO `permission_role` VALUES (3, 2);
INSERT INTO `permission_role` VALUES (3, 3);
INSERT INTO `permission_role` VALUES (3, 4);
INSERT INTO `permission_role` VALUES (4, 1);
INSERT INTO `permission_role` VALUES (4, 2);
INSERT INTO `permission_role` VALUES (4, 4);
INSERT INTO `permission_role` VALUES (5, 1);
INSERT INTO `permission_role` VALUES (5, 2);
INSERT INTO `permission_role` VALUES (5, 3);
INSERT INTO `permission_role` VALUES (7, 1);
INSERT INTO `permission_role` VALUES (7, 2);
INSERT INTO `permission_role` VALUES (7, 3);
INSERT INTO `permission_role` VALUES (8, 1);
INSERT INTO `permission_role` VALUES (8, 2);
INSERT INTO `permission_role` VALUES (8, 3);
INSERT INTO `permission_role` VALUES (9, 1);
INSERT INTO `permission_role` VALUES (9, 2);
INSERT INTO `permission_role` VALUES (9, 3);
INSERT INTO `permission_role` VALUES (10, 1);
INSERT INTO `permission_role` VALUES (10, 4);
INSERT INTO `permission_role` VALUES (10, 5);
INSERT INTO `permission_role` VALUES (12, 1);
INSERT INTO `permission_role` VALUES (12, 4);
INSERT INTO `permission_role` VALUES (13, 1);
INSERT INTO `permission_role` VALUES (13, 4);
INSERT INTO `permission_role` VALUES (14, 1);
INSERT INTO `permission_role` VALUES (14, 2);
INSERT INTO `permission_role` VALUES (14, 3);
INSERT INTO `permission_role` VALUES (15, 1);
INSERT INTO `permission_role` VALUES (15, 2);
INSERT INTO `permission_role` VALUES (15, 3);
INSERT INTO `permission_role` VALUES (16, 1);
INSERT INTO `permission_role` VALUES (16, 2);
INSERT INTO `permission_role` VALUES (16, 3);
INSERT INTO `permission_role` VALUES (17, 1);
INSERT INTO `permission_role` VALUES (17, 2);
INSERT INTO `permission_role` VALUES (17, 3);
INSERT INTO `permission_role` VALUES (18, 1);
INSERT INTO `permission_role` VALUES (18, 2);
INSERT INTO `permission_role` VALUES (19, 1);
INSERT INTO `permission_role` VALUES (19, 2);
INSERT INTO `permission_role` VALUES (20, 1);
INSERT INTO `permission_role` VALUES (20, 2);
INSERT INTO `permission_role` VALUES (20, 3);
INSERT INTO `permission_role` VALUES (21, 1);
INSERT INTO `permission_role` VALUES (21, 2);
INSERT INTO `permission_role` VALUES (22, 1);
INSERT INTO `permission_role` VALUES (22, 4);
INSERT INTO `permission_role` VALUES (23, 1);
INSERT INTO `permission_role` VALUES (23, 4);
INSERT INTO `permission_role` VALUES (24, 1);
INSERT INTO `permission_role` VALUES (24, 2);
INSERT INTO `permission_role` VALUES (24, 4);
INSERT INTO `permission_role` VALUES (25, 1);
INSERT INTO `permission_role` VALUES (25, 2);
INSERT INTO `permission_role` VALUES (26, 1);
INSERT INTO `permission_role` VALUES (26, 2);
INSERT INTO `permission_role` VALUES (27, 1);
INSERT INTO `permission_role` VALUES (27, 4);
INSERT INTO `permission_role` VALUES (27, 5);

-- ----------------------------
-- Table structure for permissions
-- ----------------------------
DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `permissions_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 28 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of permissions
-- ----------------------------
INSERT INTO `permissions` VALUES (1, 'add-product', 'Add new product', NULL, '2019-04-16 01:09:38', '2019-04-16 01:09:38');
INSERT INTO `permissions` VALUES (2, 'edit-product', 'Edit product', NULL, '2019-04-16 01:10:33', '2019-04-16 01:10:33');
INSERT INTO `permissions` VALUES (3, 'see-detail-product', 'See detail product', NULL, '2019-04-16 01:11:20', '2019-04-16 01:11:20');
INSERT INTO `permissions` VALUES (4, 'delete-product', 'Delete product', NULL, '2019-04-16 01:11:47', '2019-04-16 01:11:47');
INSERT INTO `permissions` VALUES (5, 'add-employee', 'Add new employee', NULL, '2019-04-16 01:11:47', '2019-04-16 01:11:47');
INSERT INTO `permissions` VALUES (7, 'edit-employee', 'Edit employee', NULL, '2019-04-18 16:56:17', '2019-04-18 16:56:17');
INSERT INTO `permissions` VALUES (8, 'see-employee', 'See employee', NULL, '2019-04-18 16:56:29', '2019-04-18 16:56:29');
INSERT INTO `permissions` VALUES (9, 'delete-employee', 'Delete employee', NULL, '2019-04-18 16:56:45', '2019-04-18 16:56:45');
INSERT INTO `permissions` VALUES (10, 'delete-order', 'Delete order', NULL, '2019-04-18 16:57:03', '2019-04-18 16:57:03');
INSERT INTO `permissions` VALUES (12, 'edit-order', 'Edit order', NULL, '2019-04-18 16:57:23', '2019-04-18 16:57:23');
INSERT INTO `permissions` VALUES (13, 'see-order', 'See order', NULL, '2019-04-18 16:57:35', '2019-04-18 16:57:35');
INSERT INTO `permissions` VALUES (14, 'see-customer', 'See customer', NULL, '2019-04-18 16:58:29', '2019-04-18 16:58:29');
INSERT INTO `permissions` VALUES (15, 'add-customer', 'Add customer', NULL, '2019-04-18 16:58:55', '2019-04-18 16:58:55');
INSERT INTO `permissions` VALUES (16, 'edit-customer', 'Edit customer', NULL, '2019-04-18 16:59:42', '2019-04-18 16:59:42');
INSERT INTO `permissions` VALUES (17, 'delete-customer', 'Delete customer', NULL, '2019-04-18 17:00:41', '2019-04-18 17:00:41');
INSERT INTO `permissions` VALUES (18, 'add-category', 'Add category', NULL, '2019-04-18 17:03:02', '2019-04-18 17:03:02');
INSERT INTO `permissions` VALUES (19, 'edit-category', 'Edit category', NULL, '2019-04-18 17:08:15', '2019-04-18 17:08:15');
INSERT INTO `permissions` VALUES (20, 'see-category', 'See category', NULL, '2019-04-18 17:09:01', '2019-04-18 17:09:01');
INSERT INTO `permissions` VALUES (21, 'delete-category', 'Delete category', NULL, '2019-04-18 17:09:11', '2019-04-18 17:09:11');
INSERT INTO `permissions` VALUES (22, 'comfirm-order', 'Comfirm order', NULL, '2019-04-18 17:25:24', '2019-04-18 17:25:24');
INSERT INTO `permissions` VALUES (23, 'delivery', 'Delivery', NULL, '2019-04-18 17:25:55', '2019-04-18 17:25:55');
INSERT INTO `permissions` VALUES (24, 'add-detail-product', 'Add detail product', NULL, '2019-04-18 18:35:45', '2019-04-18 18:35:45');
INSERT INTO `permissions` VALUES (25, 'edit-detail-product', 'Edit detail product', NULL, '2019-04-18 18:36:36', '2019-04-18 18:36:36');
INSERT INTO `permissions` VALUES (26, 'delete-detail-product', 'Delete detail product', NULL, '2019-04-18 18:36:47', '2019-04-18 18:36:47');
INSERT INTO `permissions` VALUES (27, 'add-order', 'Add order', '<p>Th&ecirc;m đơn h&agrave;ng offline</p>', '2019-04-18 18:45:46', '2019-04-18 18:45:46');

-- ----------------------------
-- Table structure for product_details
-- ----------------------------
DROP TABLE IF EXISTS `product_details`;
CREATE TABLE `product_details`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `color_id` varchar(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `size` int(11) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of product_details
-- ----------------------------
INSERT INTO `product_details` VALUES (1, 2, 100, 'Trắng', 1, NULL, '2019-04-08 06:53:02');
INSERT INTO `product_details` VALUES (2, 5, 4, 'Đen', 1, '2019-04-19 18:44:49', '2019-04-21 16:43:49');
INSERT INTO `product_details` VALUES (3, 5, 10, 'Trắng', 2, NULL, NULL);

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `brand` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `product_info` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `price` double NOT NULL,
  `discount_price` double(8, 2) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `thumbnail` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES (2, 'Áo phao Hàn Quốc', 'AP01', 1, '<p>&Aacute;o kho&aacute;c phao, cực ấm.</p>', 10, 'ao-phao-han-quoc', 'ZARA', '<p>aawwww</p>', 500000, 450000.00, '2019-04-06 16:50:26', '2019-04-08 13:43:44', 'images/default-thumbnail.jpg');
INSERT INTO `products` VALUES (3, 'Áo len trơn', 'AL01', 1, NULL, 11, 'ao-len-tron', 'ZARA', NULL, 300000, 250000.00, '2019-04-08 12:29:13', '2019-04-08 12:29:46', 'images/default-thumbnail.jpg');
INSERT INTO `products` VALUES (4, 'Khăn lông cừu', 'KH01', 1, NULL, 5, 'khan-long-cuu', 'ZARA', NULL, 200000, 150000.00, '2019-04-08 12:31:39', '2019-04-08 12:37:47', 'images/default-thumbnail.jpg');
INSERT INTO `products` VALUES (5, 'Quần Jean cạp chun', 'QJ01', 1, '<p>&Aacute;o kho&aacute;c phao, cực ấm.</p>', 2, 'quan-jean-cap-chun', 'ZARA', '<p>aawwww</p>', 500000, 425000.00, '2019-04-08 13:32:46', '2019-04-21 10:46:58', 'images/29177425_890037377845774_2855462518019588096_o.jpg');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user`  (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`user_id`, `role_id`) USING BTREE,
  INDEX `role_user_role_id_foreign`(`role_id`) USING BTREE,
  CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES (1, 1);
INSERT INTO `role_user` VALUES (2, 3);
INSERT INTO `role_user` VALUES (4, 1);
INSERT INTO `role_user` VALUES (6, 1);
INSERT INTO `role_user` VALUES (7, 2);
INSERT INTO `role_user` VALUES (8, 1);
INSERT INTO `role_user` VALUES (10, 2);

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `roles_name_unique`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES (1, 'super-admin', 'Super Admin', '<p>Full quyền</p>', '2019-04-16 01:01:51', '2019-04-16 01:01:51');
INSERT INTO `roles` VALUES (2, 'editor', 'Editor', '<p>Tất cả quyền th&ecirc;m sửa xo&aacute;, trừ role v&agrave; permission</p>', '2019-04-16 01:03:02', '2019-04-16 01:03:02');
INSERT INTO `roles` VALUES (3, 'manage', 'Manager', '<p>Quản l&yacute; nh&acirc;n vi&ecirc;n v&agrave; kh&aacute;ch h&agrave;ng</p>', '2019-04-16 01:04:38', '2019-04-16 01:04:38');
INSERT INTO `roles` VALUES (4, 'sale-manage', 'Sale manager', '<p>Quản l&yacute; đơn h&agrave;ng v&agrave; sản phẩm</p>', '2019-04-16 01:07:46', '2019-04-16 01:07:46');
INSERT INTO `roles` VALUES (5, 'cashier', 'Cashier', '<p>Thu ng&acirc;n tại cửa h&agrave;ng (chỉ được tạo đơn)</p>', '2019-04-18 18:44:29', '2019-04-18 18:44:29');

-- ----------------------------
-- Table structure for shoppingcart
-- ----------------------------
DROP TABLE IF EXISTS `shoppingcart`;
CREATE TABLE `shoppingcart`  (
  `identifier` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `instance` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`identifier`, `instance`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp(0) NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users_email_unique`(`email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'Minh Huyen', 'huyenttm.13@gmail.com', NULL, '$2y$10$QnQiL/LCE/Z6BfAGpaenn.sN7EAyGo/RTq6gzBBxVAMdem.GJhst2', 'MnWjMx7RskBc6vVG52OsYZfvsf4STUZO2r6jpKoz62vlRkExTSzdHTAAvVLt', '2019-03-28 15:47:52', '2019-03-28 15:47:52', 'avatars/huyen.jpg');
INSERT INTO `users` VALUES (2, 'Huyền', 'huyemttm.13@gmail.com', NULL, '$2y$10$CUjiB9hog6Ztap7DXMdztuLUiF5BV4iDm5O4J40h507ltSna9XMnS', 'cOzsk54ZyOWovPXcugc6iqGP0gEDNjEZ2hDYwOPBowmSBwPFy1C4ko9sp2L1', '2019-03-28 16:03:43', '2019-03-28 16:03:43', 'avatars/huyen.jpg');
INSERT INTO `users` VALUES (4, 'Trần Huy', 'huy@gmail.com', NULL, '$2y$10$/VShTsQmbj9OzApa5OqXgOAJwnj4njNB.caP2vhnz18eghkYthoVa', NULL, '2019-04-12 12:14:15', '2019-04-12 12:35:00', 'avatar/20180123_211008.jpg');
INSERT INTO `users` VALUES (6, 'Hoài Thương', 'thuong@gmail.com', NULL, '$2y$10$8ZOkDdRNu6DPFbHUuxJrPOu56cOs0X6xnbn1Yvy3nCRyaoSIS8pUC', NULL, '2019-04-16 16:00:01', '2019-04-16 16:00:01', 'avatars/default-profile.png');
INSERT INTO `users` VALUES (7, 'Trần Huy Hoàng', 'hoang@gmail.com', NULL, '$2y$10$DdocMAJRdbHLgvos.nyieOIaMaPnx78MD0NCVYjvMOzsZn54SPazG', NULL, '2019-04-16 16:02:20', '2019-04-16 16:02:20', 'avatars/default-profile.png');
INSERT INTO `users` VALUES (8, 'Nguyễn Quốc Thái', 'thai@gmail.com', NULL, '$2y$10$33erMSIIDR1cApD9jHobQuSGB1UgiVblqdQGJD3WdYHCaY.ucgttK', NULL, '2019-04-16 16:04:44', '2019-04-16 16:04:44', 'avatars/default-profile.png');
INSERT INTO `users` VALUES (10, 'Phạm Thu Thuỷ', 'thuy@gmail.com', NULL, '$2y$10$fheCSbIWfhdIjO9/H6HzteMZlG6r6shingIgYMzhuF489bF8QDYA6', NULL, '2019-04-16 16:09:40', '2019-04-16 16:09:40', 'avatars/default-profile.png');

SET FOREIGN_KEY_CHECKS = 1;
