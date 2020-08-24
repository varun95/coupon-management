CREATE TABLE `discount_coupons` (
  `id` int NOT NULL AUTO_INCREMENT,
  `adddate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `moddate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `name` varchar(255) NOT NULL,
  `description` varchar(1024) NOT NULL,
  `start_date` datetime NOT NULL,
  `expiry_date` datetime NOT NULL,
  `flag` int NOT NULL DEFAULT '100',
  `discount_amount` int NOT NULL,
  `max_redeem` int NOT NULL,
  `max_redeem_per_user` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `CPN_DISC_CAA1D4379021E29CA` (`name`),
  CONSTRAINT `coupons_chk_expiry_date_gt_end_date` CHECK ((`expiry_date` > `start_date`)),
  CONSTRAINT `coupons_chk_max_redeem_gt_max_redeem_per_user` CHECK ((`max_redeem` > `max_redeem_per_user`))
) ENGINE=InnoDB;