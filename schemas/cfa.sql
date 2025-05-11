CREATE TABLE `cfa` (
  `record_id` int unsigned not null auto_increment primary key,
  `created_at` timestamp not null default CURRENT_TIMESTAMP,
  `updated_at` timestamp not null default CURRENT_TIMESTAMP,
  `piece_id` INT not null,
  `piece_id_run` INT null,
  `piece_id_count` INT null,
  `print_company` varchar(255) null,
  `print_date_sent` varchar(255) null,
  `print_date_receipt` varchar(255) null,
  `print_medium` varchar(255) null,
  `print_cost` varchar(255) null,
  `print_notes` varchar(255) null,
  `buyer_name` varchar(255) null,
  `buyer_location` varchar(255) null,
  `buyer_date_purchase` varchar(255) null,
  `buyer_date_receipt` varchar(255) null,
  `notes` TEXT null
);