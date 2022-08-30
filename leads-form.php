git reset --hard HEAD<?php
/*
   Plugin Name: Leads Form Manager
   Plugin URI: http://wordpress.org/extend/plugins/offer-form/
   Version: 1.0
   Author: JC Vela
   Description: Inserts a Leads car formulaire in the content of a blog post.
   Text Domain: leadsform
   License: GPLv3
  */



register_activation_hook( __FILE__, 'create_db' );


function create_db() {

	global $wpdb;
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;

	$charset_collate = $wpdb->get_charset_collate();
	//$table_name = $wpdb->prefix . 'forms';

	$wpdb->forms = "wcar_forms";
	$wpdb->forms_templates = "wcar_forms_templates";
	$wpdb->templates = "wcar_templates";

	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";

	$wpdb->dealers_submissions = "wcar_car_dealers_submissions";
	$wpdb->submissions = "wcar_car_submissions";


	$wpdb->settings = "wcar_settings";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

	/**************************** DROP DOWN GROUPS **********************************/
	$sql = "CREATE TABLE $wpdb->dropdown_groups ( "
	."`id` int(11) NOT NULL, "
 	."`title` varchar(100) NOT NULL, "
 	."`type` int(11) NOT NULL "
	.") ENGINE=InnoDB DEFAULT CHARSET=latin1";

	dbDelta( $sql );



	$sql = "INSERT INTO $wpdb->dropdown_groups (`id`, `title`, `type`) VALUES "
	."(1, 'ABARTH', 0),"
	."(2, 'ALFAROMEO', 0),"
	."(3, 'FIAT', 0),"
	."(4, 'JEEP', 0),"
	."(5, 'LEXUS', 0),"
	."(6, 'Purchase Intent 1', 1)";

	$wpdb->query($sql);

 	$sql = "ALTER TABLE $wpdb->dropdown_groups ADD PRIMARY KEY (`id`), ADD KEY `type` (`type`); ";
 	$wpdb->query($sql);

	$sql = "ALTER TABLE $wpdb->dropdown_groups MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98 ";
  	$wpdb->query($sql);

  	/******************************* DROP DOWN ITEMS GROUPS *********************************/


  	$sql = "CREATE TABLE $wpdb->dropdown_items_groups ( "
		."`id` int(11) NOT NULL, "
		."`item_id` int(11) NOT NULL, "
		."`group_id` int(11) NOT NULL, "
		."`position` int(11) DEFAULT NULL, "
		."`type` int(11) NOT NULL "
		.") ENGINE=InnoDB DEFAULT CHARSET=latin1";

	dbDelta( $sql );

	$sql = "INSERT INTO $wpdb->dropdown_items_groups (`id`, `item_id`, `group_id`, `position`, `type`) VALUES "
		."(514, 1001, 6, 0, 1),"
		."(515, 1002, 6, 1, 1),"
		."(516, 1003, 6, 2, 1),"
		."(726, 36, 1, 0, 0),"
		."(727, 47, 1, 1, 0),"
		."(728, 24, 1, 2, 0),"
		."(729, 19, 1, 3, 0),"
		."(730, 17, 1, 4, 0),"
		."(731, 15, 1, 5, 0),"
		."(732, 26, 1, 6, 0),"
		."(733, 25, 1, 7, 0),"
		."(734, 28, 1, 8, 0),"
		."(735, 6, 1, 9, 0),"
		."(736, 8, 1, 10, 0),"
		."(737, 9, 1, 11, 0),"
		."(738, 21, 1, 12, 0),"
		."(739, 42, 1, 13, 0),"
		."(740, 27, 1, 14, 0),"
		."(741, 18, 1, 15, 0),"
		."(742, 29, 1, 16, 0),"
		."(743, 40, 1, 17, 0),"
		."(744, 22, 1, 18, 0),"
		."(745, 20, 1, 19, 0),"
		."(746, 43, 1, 20, 0),"
		."(747, 39, 1, 21, 0),"
		."(748, 41, 1, 22, 0),"
		."(749, 34, 1, 23, 0),"
		."(750, 30, 1, 24, 0),"
		."(751, 5, 1, 25, 0),"
		."(752, 32, 1, 26, 0),"
		."(753, 45, 1, 27, 0),"
		."(754, 47, 2, 0, 0),"
		."(755, 36, 2, 1, 0),"
		."(756, 24, 2, 2, 0),"
		."(757, 38, 2, 3, 0),"
		."(758, 19, 2, 4, 0),"
		."(759, 17, 2, 5, 0),"
		."(760, 26, 2, 6, 0),"
		."(761, 28, 2, 7, 0),"
		."(762, 7, 2, 8, 0),"
		."(763, 8, 2, 9, 0),"
		."(764, 21, 2, 10, 0),"
		."(765, 42, 2, 11, 0),"
		."(766, 27, 2, 12, 0),"
		."(767, 18, 2, 13, 0),"
		."(768, 46, 2, 14, 0),"
		."(769, 10, 2, 15, 0),"
		."(770, 40, 2, 16, 0),"
		."(771, 22, 2, 17, 0),"
		."(772, 16, 2, 18, 0),"
		."(773, 20, 2, 19, 0),"
		."(774, 43, 2, 20, 0),"
		."(775, 14, 2, 21, 0),"
		."(776, 39, 2, 22, 0),"
		."(777, 30, 2, 23, 0),"
		."(778, 32, 2, 24, 0),"
		."(779, 45, 2, 25, 0),"
		."(780, 47, 3, 0, 0),"
		."(781, 24, 3, 1, 0),"
		."(782, 36, 3, 2, 0),"
		."(783, 19, 3, 3, 0),"
		."(784, 17, 3, 4, 0),"
		."(785, 15, 3, 5, 0),"
		."(786, 26, 3, 6, 0),"
		."(787, 25, 3, 7, 0),"
		."(788, 28, 3, 8, 0),"
		."(789, 8, 3, 9, 0),"
		."(790, 9, 3, 10, 0),"
		."(791, 42, 3, 11, 0),"
		."(792, 18, 3, 12, 0),"
		."(793, 46, 3, 13, 0),"
		."(794, 29, 3, 14, 0),"
		."(795, 10, 3, 15, 0),"
		."(796, 40, 3, 16, 0),"
		."(797, 22, 3, 17, 0),"
		."(798, 30, 3, 18, 0),"
		."(799, 33, 3, 19, 0),"
		."(800, 35, 3, 20, 0),"
		."(801, 34, 3, 21, 0),"
		."(802, 16, 3, 22, 0),"
		."(803, 21, 3, 23, 0),"
		."(804, 48, 3, 24, 0),"
		."(805, 20, 3, 25, 0),"
		."(806, 43, 3, 26, 0),"
		."(807, 44, 3, 27, 0),"
		."(808, 14, 3, 28, 0),"
		."(809, 39, 3, 29, 0),"
		."(810, 49, 3, 30, 0),"
		."(811, 7, 3, 31, 0),"
		."(812, 6, 3, 32, 0),"
		."(813, 37, 3, 33, 0),"
		."(814, 41, 3, 34, 0),"
		."(815, 11, 3, 35, 0),"
		."(816, 31, 3, 36, 0),"
		."(817, 32, 3, 37, 0),"
		."(818, 23, 3, 38, 0),"
		."(819, 45, 3, 39, 0),"
		."(820, 47, 4, 0, 0),"
		."(821, 19, 4, 1, 0),"
		."(822, 17, 4, 2, 0),"
		."(823, 25, 4, 3, 0),"
		."(824, 28, 4, 4, 0),"
		."(825, 8, 4, 5, 0),"
		."(826, 42, 4, 6, 0),"
		."(827, 18, 4, 7, 0),"
		."(828, 29, 4, 8, 0),"
		."(829, 40, 4, 9, 0),"
		."(830, 22, 4, 10, 0),"
		."(831, 33, 4, 11, 0),"
		."(832, 21, 4, 12, 0),"
		."(833, 48, 4, 13, 0),"
		."(834, 20, 4, 14, 0),"
		."(835, 12, 4, 15, 0),"
		."(836, 49, 4, 16, 0),"
		."(837, 6, 4, 17, 0),"
		."(838, 37, 4, 18, 0),"
		."(839, 41, 4, 19, 0),"
		."(840, 11, 4, 20, 0),"
		."(841, 31, 4, 21, 0),"
		."(842, 23, 4, 22, 0),"
		."(843, 45, 4, 23, 0),"
		."(844, 49, 5, 0, 0),"
		."(845, 50, 5, 1, 0),"
		."(846, 51, 5, 2, 0)";

	$wpdb->query($sql);


	$sql = "ALTER TABLE $wpdb->dropdown_items_groups "
			. "ADD PRIMARY KEY (`id`), "
			. "ADD KEY `type` (`type`) USING BTREE";

	$wpdb->query($sql);

	$sql = "ALTER TABLE $wpdb->dropdown_items_groups "
  			. "MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=847";

  	$wpdb->query($sql);	


  	/******************************* DROP DOWN ITEMS *********************************/

	
	$sql = "CREATE TABLE $wpdb->dropdown_items ( "
		."`id` int(20) NOT NULL, "
		."`type` int(11) DEFAULT NULL, "
		."`tag_value` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL, "
		."`name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL, "
		."`zip` int(20) DEFAULT NULL, "
		."`city` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL, "
		."`active` int(11) NOT NULL "
		.") ENGINE=InnoDB DEFAULT CHARSET=latin1 ";

	dbDelta( $sql );

	$sql = "INSERT INTO $wpdb->dropdown_items (`id`, `type`, `tag_value`, `name`, `zip`, `city`, `active`) VALUES "
	. "(1, 0, '0002289-005', 'Motor Village Delta', 1160, 'Auderghem', 1), "
	. "(2, 0, '0002289-006', 'Motor Village Drogenbos  ', 1620, 'Drogenbos', 1), "
	. "(3, 0, '0002706-002', 'Garage Pagnotta', 3630, 'Maasmechelen', 1), "
	. "(4, 0, '0002969-002', 'Garage Picard', 6700, 'Bonnert', 1), "
	. "(5, 0, '0002533-001', 'Sprl Renga ', 7100, 'La Louvière', 1), "
	. "(6, 0, '0711289-000', 'Motor Village Meiser ', 1030, 'Bruxelles', 1), "
	. "(7, 0, '0001289-005', 'Motor Village Delta', 1160, 'Bruxelles', 1), "
	. "(8, 0, '0711225-001', 'FJA Automobile', 1301, 'Bierges', 1), "
	. "(9, 0, '0002225-002', 'FJA Automobiles', 1400, 'Nivelles', 1), "
	. "(10, 0, '0711238-000', 'Garage Lebeau ', 1652, 'Alsemberg', 1), "
	. "(11, 0, '0711376-000', 'RC Cars ', 1853, 'Grimbergen (Strombeek-bever)', 1), "
	. "(12, 0, '0002120-003', 'Geel ', 2110, 'Wijnegem', 1), "
	. "(13, 0, '0001120-003', 'Buga Auto Wijnegem ', 2110, 'Wijnegem', 1), "
	. "(14, 0, '0002136-000', 'Kegels  ', 2300, 'Turnhout', 1), "
	. "(15, 0, '0001120-004', 'Buga Auto Kempen-Geel ', 2440, 'Geel', 1), "
	. "(16, 0, '0710828-000', 'Garage Van Brempt ', 2500, 'Lier', 1), "
	. "(17, 0, '0001120-000', 'Buga Auto Antwerpen  ', 2600, 'Berchem', 1), "
	. "(18, 0, '0711102-000', 'Garage De Linde ', 2630, 'Aartselaar', 1), "
	. "(19, 0, '0711226-000', 'Autostad Haasrode ', 3001, 'Heverlee', 1), "
	. "(20, 0, '0711232-000', 'Gebroeders Merckx ', 3090, 'Overijse', 1), "
	. "(21, 0, '0001712-000', 'Garage Van Mossel Bruyninx  ', 3500, 'Hasselt', 1), "
	. "(22, 0, '0002706-000', 'Garage Pagnotta', 3600, 'Genk', 1), "
	. "(23, 0, '0001712-003', 'Van Mossel Bruyninx ', 3900, 'Pelt', 1), "
	. "(24, 0, '0002647-000', 'Auto Lana ', 4040, 'Herstal', 1), "
	. "(25, 0, '0002991-001', 'Constant Waremme', 4300, 'Waremme', 1), "
	. "(26, 0, '0711453-000', 'Constant Liège ', 4430, 'Ans', 1), "
	. "(27, 0, '0001625-000', 'Garage Dave & Fils ', 4520, 'Long-pre (wanze)', 1), "
	. "(28, 0, '0711657-000', 'Didi Motors ', 4650, 'Chaineux', 1), "
	. "(29, 0, '0001609-000', 'Garage Jonas  ', 4710, 'Lontzen', 1), "
	. "(30, 0, '0002969-001', 'Garage Picard ', 5100, 'Namur (Naninne)', 1), "
	. "(31, 0, '0001533-003', 'Renga - Maudoux  ', 5600, 'Neuville', 1), "
	. "(32, 0, '0711533-000', 'Sprl Renga', 6060, 'Gilly', 1), "
	. "(33, 0, '0002969-003', 'Garage Picard', 6600, 'Bastogne', 1), "
	. "(34, 0, '0001969-002', 'Garage Picard  ', 6700, 'Arlon', 1), "
	. "(35, 0, '0001969-000', 'Garage Picard', 6900, 'Marche-en-Famenne', 1), "
	. "(36, 0, '0001567-000', 'Auto.it', 7033, 'Cuesmes', 1), "
	. "(37, 0, '0001567-001', 'New Binche Automobiles  ', 7130, 'Binche', 1), "
	. "(38, 0, '0711304-000', 'Autobedrijf Deboo ', 8000, 'Brugge', 1), "
	. "(39, 0, '0711346-000', 'Kortrijk Motors ', 8500, 'Kortrijk', 1), "
	. "(40, 0, '0711342-000', 'Garage Marrannes ', 8670, 'Koksijde - Wulpen', 1), "
	. "(41, 0, '0002346-000', 'Novoto Roeselare  ', 8830, 'Hooglede', 1), "
	. "(42, 0, '0001322-000', 'Garage Carrosserie Claus  ', 8980, 'Geluveld', 1), "
	. "(43, 0, '0001452-000', 'Gent Motors ', 9000, 'Gent', 1), "
	. "(44, 0, '0001452-003', 'Gent Motors Noord Drongen ', 9031, 'Drongen', 1), "
	. "(45, 0, '0711404-000', 'Waasland Motor ', 9140, 'Temse', 1), "
	. "(46, 0, '0711432-000', 'Garage De Rocker ', 9230, 'Wetteren', 1), "
	. "(47, 0, '0001434-001', 'Aalst Motors ', 9300, 'Aalst', 1), "
	. "(48, 0, '0002452-003', 'Garage Viane ', 9971, 'Lembeke', 1), "
	. "(49, 0, '0002549-000', 'Lexus Anderlecht', 1070, 'Anderlecht', 1), "
	. "(50, 0, '0002434-001', 'Lexus Brussels', 1780, 'Wemmel', 1), "
	. "(51, 0, '0002549-001', 'Lexus Waterloo', 1420, 'Waterloo', 1), "
	. "(1001, 1, '0-3month', 'Entre 0 et 3 mois', NULL, NULL, 1), "
	. "(1002, 1, '3-6month', 'Entre 3 et 6 mois', NULL, NULL, 1), "
	. "(1003, 1, '6moremonth', 'Dans plus de 6 mois', NULL, NULL, 1)";

	$wpdb->query($sql);

  	$sql = "ALTER TABLE $wpdb->dropdown_items "
  			. "ADD PRIMARY KEY (`id`) USING BTREE, "
  			. "ADD KEY `type` (`type`)";

  	$wpdb->query($sql);

	$sql = "ALTER TABLE $wpdb->dropdown_items "
  			."MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1005";

  	$wpdb->query($sql);

/******************************* FORMS *********************************/

  	$sql = "CREATE TABLE $wpdb->forms ( "
		. "`id` int(11) NOT NULL, "
		. "`form_name` varchar(50) NOT NULL, "
		. "`brand` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL, "
		. "`model` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL, "
		. "`style` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL, "
		. "`lang` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL, "
		. "`fleet` int(11) DEFAULT NULL, "
		. "`template_id` int(11) DEFAULT NULL "
		. ") ENGINE=InnoDB DEFAULT CHARSET=latin1";

	dbDelta( $sql );

	$sql = "ALTER TABLE $wpdb->forms ADD PRIMARY KEY (`id`)";

  	$wpdb->query($sql);

	$sql = "INSERT INTO $wpdb->forms (`id`, `form_name`, `brand`, `model`, `style`, `lang`, `fleet`, `template_id`) VALUES "
		. "(1, 'ABARTH-595-RP-FR', 'ABARTH', '595', 'RP', 'FR', 1, 1), "
		. "(2, 'ABARTH-595-RP-FR2', 'ABARTH', '595', 'RP', 'FR2', 0, 1), "
		. "(3, 'ABARTH-595-RP-NL', 'ABARTH', '595', 'RP', 'NL', 0, 2), "
		. "(4, 'ALFAROMEO-GIULIA-RP-FR-FLEET', 'ALFAROMEO', 'GIULIA', 'RP', 'FR', 1, 1), "
		. "(5, 'ALFAROMEO-GIULIA-RP-FR', 'ALFAROMEO', 'GIULIA', 'RP', 'FR', 0, 1), "
		. "(6, 'ALFAROMEO-GIULIA-RP-FR2', 'ALFAROMEO', 'GIULIA', 'RP', 'FR2', 0, 1), "
		. "(7, 'ALFAROMEO-GIULIA-RP-NL-FLEET', 'ALFAROMEO', 'GIULIA', 'RP', 'NL', 1, 2), "
		. "(8, 'ALFAROMEO-GIULIA-RP-NL', 'ALFAROMEO', 'GIULIA', 'RP', 'NL', 0, 2), "
		. "(9, 'ALFAROMEO-GIULIA-TD-FR-FLEET', 'ALFAROMEO', 'GIULIA', 'TD', 'FR', 1, 1), "
		. "(10, 'ALFAROMEO-GIULIA-TD-FR', 'ALFAROMEO', 'GIULIA', 'TD', 'FR', 0, 1), "
		. "(11, 'ALFAROMEO-GIULIA-TD-NL', 'ALFAROMEO', 'GIULIA', 'TD', 'NL', 0, 2), "
		. "(12, 'ALFAROMEO-GIULIA-TD-NL', 'ALFAROMEO', 'GIULIA', 'TD', 'NL', 0, 2), "
		. "(13, 'ALFAROMEO-STELVIO-RP-FR-FLEET', 'ALFAROMEO', 'STELVIO', 'RP', 'FR', 1, 1), "
		. "(14, 'ALFAROMEO-STELVIO-RP-FR', 'ALFAROMEO', 'STELVIO', 'RP', 'FR', 0, 1), "
		. "(15, 'ALFAROMEO-STELVIO-RP-NL-FLEET', 'ALFAROMEO', 'STELVIO', 'RP', 'NL', 1, 2), "
		. "(16, 'ALFAROMEO-STELVIO-RP-NL', 'ALFAROMEO', 'STELVIO', 'RP', 'NL', 0, 1), "
		. "(17, 'ALFAROMEO-STELVIO-TD-FR-FLEET', 'ALFAROMEO', 'STELVIO', 'TD', 'FR', 1, 1), "
		. "(18, 'ALFAROMEO-STELVIO-TD-FR', 'ALFAROMEO', 'STELVIO', 'TD', 'FR', 0, 1), "
		. "(19, 'ALFAROMEO-STELVIO-TD-NL-FLEET', 'ALFAROMEO', 'STELVIO', 'TD', 'NL', 1, 2), "
		. "(20, 'ALFAROMEO-STELVIO-TD-NL', 'ALFAROMEO', 'STELVIO', 'TD', 'NL', 0, 2), "
		. "(21, 'FIAT-500-RP-FR-FLEET', 'FIAT', '500', 'RP', 'FR', 1, 1), "
		. "(22, 'FIAT-500-RP-FR', 'FIAT', '500', 'RP', 'FR', 0, 1), "
		. "(23, 'FIAT-500-RP-NL-FLEET', 'FIAT', '500', 'RP', 'NL', 1, 2), "
		. "(24, 'FIAT-500-RP-NL', 'FIAT', '500', 'RP', 'NL', 0, 2), "
		. "(25, 'FIAT-500-TD-FR-FLEET', 'FIAT', '500', 'TD', 'FR', 1, 1), "
		. "(26, 'FIAT-500-TD-FR', 'FIAT', '500', 'TD', 'FR', 0, 1), "
		. "(27, 'FIAT-500-TD-NL-FLEET', 'FIAT', '500', 'TD', 'NL', 1, 2), "
		. "(28, 'FIAT-500-TD-NL', 'FIAT', '500', 'TD', 'NL', 0, 2), "
		. "(29, 'FIAT-500X-RP-FR-FLEET', 'FIAT', '500X', 'RP', 'FR', 1, 1), "
		. "(30, 'FIAT-500X-RP-FR', 'FIAT', '500X', 'RP', 'FR', 0, 1), "
		. "(31, 'FIAT-500X-RP-NL-FLEET', 'FIAT', '500X', 'RP', 'NL', 1, 2), "
		. "(32, 'FIAT-500X-RP-NL', 'FIAT', '500X', 'RP', 'NL', 0, 2), "
		. "(33, 'FIAT-500X-TD-FR-FLEET', 'FIAT', '500X', 'TD', 'FR', 1, 1), "
		. "(34, 'FIAT-500X-TD-FR', 'FIAT', '500X', 'TD', 'FR', 0, 1), "
		. "(35, 'FIAT-500X-TD-NL-FLEET', 'FIAT', '500X', 'TD', 'NL', 1, 2), "
		. "(36, 'FIAT-500X-TD-NL', 'FIAT', '500X', 'TD', 'NL', 0, 2), "
		. "(37, 'FIAT-TIPO-5D-RP-FR-FLEET', 'FIAT', 'TIPO 5D', 'RP', 'FR', 1, 1), "
		. "(38, 'FIAT-TIPO-5D-RP-FR', 'FIAT', 'TIPO 5D', 'RP', 'FR', 0, 1), "
		. "(39, 'FIAT-TIPO-5D-RP-NL-FLEET', 'FIAT', 'TIPO 5D', 'RP', 'NL', 1, 2), "
		. "(40, 'FIAT-TIPO-5D-RP-NL', 'FIAT', 'TIPO 5D', 'RP', 'NL', 0, 2), "
		. "(41, 'FIAT-TIPO-5D-TD-FR-FLEET', 'FIAT', 'TIPO 5D', 'TD', 'FR', 1, 1), "
		. "(42, 'FIAT-TIPO-5D-TD-FR', 'FIAT', 'TIPO 5D', 'TD', 'FR', 0, 1), "
		. "(43, 'FIAT-TIPO-5D-TD-NL-FLEET', 'FIAT', 'TIPO 5D', 'TD', 'NL', 1, 2), "
		. "(44, 'FIAT-TIPO-5D-TD-NL', 'FIAT', 'TIPO 5D', 'TD', 'NL', 0, 2), "
		. "(45, 'FIAT-TIPO-SEDAN-RP-FR-FLEET', 'FIAT', 'TIPO SEDAN', 'RP', 'FR', 1, 1), "
		. "(46, 'FIAT-TIPO-SEDAN-RP-FR', 'FIAT', 'TIPO SEDAN', 'RP', 'FR', 0, 1), "
		. "(47, 'FIAT-TIPO-SEDAN-RP-NL-FLEET', 'FIAT', 'TIPO SEDAN', 'RP', 'NL', 1, 2), "
		. "(48, 'FIAT-TIPO-SEDAN-RP-NL', 'FIAT', 'TIPO SEDAN', 'RP', 'NL', 0, 2), "
		. "(49, 'FIAT-TIPO-SEDAN-TD-FR-FLEET', 'FIAT', 'TIPO SEDAN', 'TD', 'FR', 1, 1), "
		. "(50, 'FIAT-TIPO-SEDAN-TD-FR', 'FIAT', 'TIPO SEDAN', 'TD', 'FR', 0, 1), "
		. "(51, 'FIAT-TIPO-SEDAN-TD-NL-FLEET', 'FIAT', 'TIPO SEDAN', 'TD', 'NL', 1, 2), "
		. "(52, 'FIAT-TIPO-SEDAN-TD-NL', 'FIAT', 'TIPO SEDAN', 'TD', 'NL', 0, 2), "
		. "(53, 'FIAT-TIPO-SW-RP-FR-FLEET', 'FIAT', 'TIPO SW', 'RP', 'FR', 1, 1), "
		. "(54, 'FIAT-TIPO-SW-RP-FR', 'FIAT', 'TIPO SW', 'RP', 'FR', 0, 1), "
		. "(55, 'FIAT-TIPO-SW-RP-NL-FLEET', 'FIAT', 'TIPO SW', 'RP', 'NL', 1, 2), "
		. "(56, 'FIAT-TIPO-SW-RP-NL', 'FIAT', 'TIPO SW', 'RP', 'NL', 0, 2), "
		. "(57, 'FIAT-TIPO-SW-TD-FR-FLEET', 'FIAT', 'TIPO SW', 'TD', 'FR', 1, 1), "
		. "(58, 'FIAT-TIPO-SW-TD-FR', 'FIAT', 'TIPO SW', 'TD', 'FR', 0, 1), "
		. "(59, 'FIAT-TIPO-SW-TD-NL-FLEET', 'FIAT', 'TIPO SW', 'TD', 'NL', 1, 2), "
		. "(60, 'FIAT-TIPO-SW-TD-NL', 'FIAT', 'TIPO SW', 'TD', 'NL', 0, 2), "
		. "(61, 'JEEP-COMPASS-RP-FR-FLEET', 'JEEP', 'COMPASS', 'RP', 'FR', 1, 1), "
		. "(62, 'JEEP-COMPASS-RP-FR', 'JEEP', 'COMPASS', 'RP', 'FR', 0, 1), "
		. "(63, 'JEEP-COMPASS-RP-NL-FLEET', 'JEEP', 'COMPASS', 'RP', 'NL', 1, 2), "
		. "(64, 'JEEP-COMPASS-RP-NL', 'JEEP', 'COMPASS', 'RP', 'NL', 0, 2), "
		. "(65, 'JEEP-COMPASS-TD-FR-FLEET', 'JEEP', 'COMPASS', 'TD', 'FR', 1, 1), "
		. "(66, 'JEEP-COMPASS-TD-FR', 'JEEP', 'COMPASS', 'TD', 'FR', 0, 1), "
		. "(67, 'JEEP-COMPASS-TD-NL-FLEET', 'JEEP', 'COMPASS', 'TD', 'NL', 1, 2), "
		. "(68, 'JEEP-COMPASS-TD-NL', 'JEEP', 'COMPASS', 'TD', 'NL', 0, 2), "
		. "(69, 'JEEP-RENEGADE-RP-FR-FLEET', 'JEEP', 'RENEGADE', 'RP', 'FR', 1, 1), "
		. "(70, 'JEEP-RENEGADE-RP-FR', 'JEEP', 'RENEGADE', 'RP', 'FR', 0, 1), "
		. "(71, 'JEEP-RENEGADE-RP-NL-FLEET', 'JEEP', 'RENEGADE', 'RP', 'NL', 1, 2), "
		. "(72, 'JEEP-RENEGADE-RP-NL', 'JEEP', 'RENEGADE', 'RP', 'NL', 0, 2), "
		. "(73, 'JEEP-RENEGADE-TD-FR-FLEET', 'JEEP', 'RENEGADE', 'TD', 'FR', 1, 1), "
		. "(74, 'JEEP-RENEGADE-TD-FR', 'JEEP', 'RENEGADE', 'TD', 'FR', 0, 1), "
		. "(75, 'JEEP-RENEGADE-TD-NL-FLEET', 'JEEP', 'RENEGADE', 'TD', 'NL', 1, 2), "
		. "(76, 'JEEP-RENEGADE-TD-NL', 'JEEP', 'RENEGADE', 'TD', 'NL', 0, 2), "
		. "(77, 'LEXUS-CT200H-RP-FR', 'LEXUS', 'CT200H', 'RP', 'FR', 0, 1), "
		. "(78, 'LEXUS-CT200H-RP-NL', 'LEXUS', 'CT200H', 'RP', 'NL', 0, 2), "
		. "(79, 'LEXUS-CT200H-TD-FR', 'LEXUS', 'CT200H', 'TD', 'FR', 0, 1), "
		. "(80, 'LEXUS-CT200H-TD-NL', 'LEXUS', 'CT200H', 'TD', 'NL', 0, 2), "
		. "(81, 'LEXUS-ES300H-RP-FR', 'LEXUS', 'ES300H', 'RP', 'FR', 0, 1), "
		. "(82, 'LEXUS-ES300H-RP-NL', 'LEXUS', 'ES300H', 'RP', 'NL', 0, 2), "
		. "(83, 'LEXUS-ES300H-TD-FR', 'LEXUS', 'ES300H', 'TD', 'FR', 0, 1), "
		. "(84, 'LEXUS-ES300H-TD-NL', 'LEXUS', 'ES300H', 'TD', 'NL', 0, 2), "
		. "(85, 'LEXUS-NX300H-RP-FR', 'LEXUS', 'NX300H', 'RP', 'FR', 0, 1), "
		. "(86, 'LEXUS-NX300H-RP-NL', 'LEXUS', 'NX300H', 'RP', 'NL', 0, 2), "
		. "(87, 'LEXUS-NX300H-TD-FR', 'LEXUS', 'NX300H', 'TD', 'FR', 0, 1), "
		. "(88, 'LEXUS-NX300H-TD-NL', 'LEXUS', 'NX300H', 'TD', 'NL', 0, 2), "
		. "(89, 'LEXUS-RX450H-RP-FR', 'LEXUS', 'RX450H', 'RP', 'FR', 0, 1), "
		. "(90, 'LEXUS-RX450H-RP-NL', 'LEXUS', 'RX450H', 'RP', 'NL', 0, 2), "
		. "(91, 'LEXUS-RX450H-TD-FR', 'LEXUS', 'RX450H', 'TD', 'FR', 0, 1), "
		. "(92, 'LEXUS-RX450H-TD-NL', 'LEXUS', 'RX450H', 'TD', 'NL', 0, 2), "
		. "(93, 'LEXUS-UX250H-RP-FR', 'LEXUS', 'UX250H', 'RP', 'FR', 0, 1), "
		. "(94, 'LEXUS-UX250H-RP-NL', 'LEXUS', 'UX250H', 'RP', 'NL', 0, 2), "
		. "(95, 'LEXUS-UX250H-TD-FR', 'LEXUS', 'UX250H', 'TD', 'FR', 0, 1), "
		. "(96, 'LEXUS-UX250H-TD-NL', 'LEXUS', 'UX250H', 'TD', 'NL', 0, 2)";

		dbDelta( $sql );

		$sql = "ALTER TABLE $wpdb->forms MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97";
	
		$wpdb->query($sql);




/******************************* TEMPLATES *********************************/

		$sql = "CREATE TABLE `wcar_templates` ( "
              . "`id` int(11) NOT NULL, "
              . "`title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL, "
              . "`lang` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL, "
              . "`form_id` int(11) DEFAULT NULL, "
              . "`source_code` text CHARACTER SET utf8 COLLATE utf8_unicode_ci "
            . ") ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

		dbDelta( $sql );


 		$french_template = '[open_form name=&quot;leadsform&quot;]

[headline value=&quot;Int&eacute;ress&eacute; par la nouvelle &lt;br&gt;{{carmodel}}&quot; class=&quot;title&quot; model=&quot;&quot; var=&quot;carmodel&quot; style=&quot;font-size:18;&quot; name=&quot;template_title&quot; var=&quot;carmodel&quot;]  

[headline value=&quot;&lt;em&gt;Recevez d&egrave;s &agrave; pr&eacute;sent une offre &lt;u&gt;gratuite&lt;/u&gt;  de l&rsquo;un des vendeurs!&lt;em&gt;&quot; class=&quot;teaser&quot;]



[input name=&quot;firstname&quot; placeholder=&quot;Pr&eacute;nom&quot; invalid_text = &quot;Le champ n&#39;a pas &eacute;t&eacute; compl&eacute;t&eacute;&quot;]
[input name=&quot;lastname&quot; placeholder=&quot;Nom&quot; invalid_text = &quot;Le champ n&#39;a pas &eacute;t&eacute; compl&eacute;t&eacute;&quot;]
[input name=&quot;email&quot; placeholder=&quot;Email&quot; invalid_text = &quot;Le champ n&#39;a pas &eacute;t&eacute; compl&eacute;t&eacute;&quot;]
[phone name=&quot;phone&quot; placeholder=&quot;Phone&quot; invalid_text = &quot;Le champ n&#39;a pas &eacute;t&eacute; compl&eacute;t&eacute;&quot;]

[dynamic_dealers name=&quot;dealer&quot; label=&quot;Choisissez votre concession&quot;]
&lt;br&gt;
[dropdown id=&quot;6&quot; name=&quot;purchaseintent&quot; label=&quot;Dans combien de temps souhaitez-vous changer de v&eacute;hicule ?&quot;]

[label value=&quot;J&#39;accepte&quot;]

[checkbox data_content=&quot;Que mes donn&eacute;es personnelles soient trait&eacute;es par FCA Italy S.p.A. pour les finalit&eacute;s de marketing reprises au point c) de la politique de confidentialit&eacute;, sur support papier, par des moyens automatis&eacute;s ou &eacute;lectroniques, y compris par courrier ou e-mail, t&eacute;l&eacute;phone (par exemple, via appels t&eacute;l&eacute;phoniques automatis&eacute;s, SMS, MMS), fax et tout autre moyen (sites Web, applications mobiles, etc.).&quot; name=&quot;check1&quot; value=&quot;De recevoir des communications marketing&quot; class=&quot;&quot;]

[checkbox data_content=&quot;Que mes donn&eacute;es personnelles soient trait&eacute;es par FCA Italy S.p.A. pour analyser mes pr&eacute;f&eacute;rences et pour recevoir des communications commerciales personnalis&eacute;es, reprises au point d) de la politique de confidentialit&eacute;.&quot; name=&quot;check2&quot;  value=&quot;Que mes donn&eacute;es soient utilis&eacute;es &agrave; des fins de profilage&quot; class=&quot;&quot;]

[checkbox data_content=&quot;Que mes donn&eacute;es personnelles soient trait&eacute;es par FCA Italy S.p.A. pour les finalit&eacute;s de marketing reprises au point c) de la politique de confidentialit&eacute;, sur support papier, par des moyens automatis&eacute;s ou &eacute;lectroniques, y compris par courrier ou e-mail, t&eacute;l&eacute;phone (par exemple, via appels t&eacute;l&eacute;phoniques automatis&eacute;s, SMS, MMS), fax et tout autre moyen (sites Web, applications mobiles, etc.).&quot; name=&quot;check3&quot; value=&quot;Que les donn&eacute;es soient communiqu&eacute;es &agrave; des tiers pour leurs op&eacute;rations de marketing&quot; class=&quot;&quot;]


[result value=&quot;Vous serez tr&egrave;s prochainement contact&eacute; par un revendeur Abarth afin de prendre rendez-vous pour discuter de la meilleure offre possible pour une {{carmodel}} !&quot;]

[button name=&quot;btn_submit&quot; type=&quot;submit&quot; value=&quot;Envoi&quot;]


[dynamic_images]

[close_form]



[p class=&quot;test&quot; value=&#39;Consentement &amp; Politique de confidentialit&eacute; voir  &lt;a href=&quot;https://gocar.be/fr/information/consentement-et-politique-de-confidentialite-fca?_ga=2.73318609.336858744.1556572153-132853666.1556269389&quot;&gt;ici&lt;/a&gt;&#39;]';

 	$dutch_template = '
[headline value=&quot;Interesse in de nieuwe &lt;br&gt;{{carmodel}}&quot; class=&quot;title&quot; model=&quot;&quot; var=&quot;carmodel&quot; style=&quot;font-size:18;&quot; name=&quot;template_title&quot;]

[headline value=&quot;&lt;em&gt;&lt;b&gt;Ontvang een compleet &lt;u&gt;gratis&lt;/u&gt; offerte van een verkoper !&lt;/b&gt;&lt;/em&gt;&quot; class=&quot;teaser&quot;]

[open_form name=&quot;leadsform&quot;]

[input name=&quot;firstname&quot;placeholder=&quot;Naam&quot; class=&quot;&quot; invalid_text = &quot;De Email is verplicht&quot;]
[input name=&quot;lastname&quot; placeholder=&quot;Voornam&quot; class=&quot;&quot; invalid_text = &quot;De Email is verplicht&quot;]
[input name=&quot;email&quot; placeholder=&quot;Email&quot; class=&quot;&quot; invalid_text = &quot;De Email is verplicht&quot;]
[input name=&quot;phone&quot; placeholder=&quot;Phone&quot; class=&quot;&quot; invalid_text = &quot;De Email is verplicht&quot;]

[dynamic_dealers name=&quot;dealer&quot; label=&quot;Kies een Abarth verdeler*&quot;]
&lt;br&gt;
[dropdown id=&quot;6&quot; name=&quot;purchaseintent&quot; label=&quot;Kies een Abarth verdeler is verplicht&quot;]

[label value=&quot;Ik aanvaard&quot;]

[checkbox data_content=&quot;Voor de verwerking van mijn persoonsgegevens door FCA Italy S.p.A voor marketing doeleinden zoals uiteengezet in punt c) van de privacy kennisgeving, op papier, op geautomatiseerde of elektronische wijze, waaronder via post of e-mail, telefoon (bijvoorbeeld geautomatiseerde telefoonoproepen, SMS, MMS), fax en elk ander middel (bijvoorbeeld websites, mobiele apps).&quot; name=&quot;check1&quot; value=&quot;Om marketingberichten te ontvangen&quot; class=&quot;&quot;]

[checkbox data_content=&quot;Voor de verwerking van mijn persoonsgegevens door FCA Italy S.p.A om mijn voorkeuren te analyseren en aangepaste commerci&euml;le communicatie te ontvangen zoals uiteengezet in punt d) van de privacy kennisgeving.&quot; name=&quot;check2&quot;  value=&quot;Mijn gegevens gebruikt worden voor profilerings-doeleinden&quot; class=&quot;&quot;]

[checkbox data_content=&quot;Voor het communiceren van mijn persoonsgegevens aan dochterondernemingen en gelieerde ondernemingen van FCA Italy S.p.A evenals hun partners in de automobiel-, financi&euml;le, verzekerings- en telecommunicatiesector, die deze zullen verwerken voor de marketing doeleinden uiteengezet in punt e) van de privacy kennisgeving, op papier, op geautomatiseerde of elektronische wijze, waaronder via post of e-mail, telefoon (bijvoorbeeld geautomatiseerde telefoonoproepen, SMS, MMS), fax en elk ander middel (bijvoorbeeld websites, mobiele apps).&quot; name=&quot;check3&quot; value=&quot;Mijn gegevens met derden worden gedeeld voor marketingdoeleinden&quot; class=&quot;&quot;]

[button value=&quot;Versturen&quot;]

[close_form]

[result value=&quot;Binnenkort ontvangt u een offerte voor de {{carmodel}} in uw mailbox!&quot;]

[p value=&#39;Toestemming &amp; Privacybeleid zie &lt;a href=&quot;https://gocar.be/nl/informatie/fca-toestemming-en-privacy-policy&quot; target=&quot;_blank&quot;&gt;hier&lt;/a&gt;&#39;]
 	
 	';


		$sql = "ALTER TABLE $wpdb->templates "
  		. "ADD PRIMARY KEY (`id`) USING BTREE";

  		$wpdb->query($sql);

		$sql = "ALTER TABLE $wpdb->templates "
  			. "MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5";

  		$wpdb->query($sql);

		$sql = "INSERT INTO $wpdb->templates  (`id`, `title`, `lang`, `form_id`, `source_code`) VALUES "
		 		."(1, 'Template FR', '1', 1, '". html_entity_decode($french_template)."'), "
		 		."(2, 'Template NL', '2', 1, '".html_entity_decode($dutch_template).")'), "
		 		."(3, 'Test FR', '1', 2, ''), "
		 		."(4, 'Test NL', '2', 2, '')";


		$wpdb->query($sql);


/******************************* SETTINGS *********************************/

	$sql = "CREATE TABLE $wpdb->settings ( "
  	. " `id` int(11) NOT NULL, "
  	. " `name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL, "
  	. " `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL "
	. " ) ENGINE=InnoDB DEFAULT CHARSET=latin1";

	dbDelta( $sql );

	$sql = "INSERT INTO $wpdb->settings (`id`, `name`, `value`) VALUES "
        . "(1, 'preview_page', '128662'), "
        . "(2, 'ajax_url', 'https://news.gocarsolutions.be/wp-admin/admin-ajax.php')";

	$wpdb->query($sql);

	$sql = "ALTER TABLE $wpdb->settings "
  			. "ADD PRIMARY KEY (`id`) USING BTREE";

  	$wpdb->query($sql);

  	$sql = "ALTER TABLE $wpdb->settings "
	  	. "MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3";

	$wpdb->query($sql);


/******************************* DEALERS SUBMISSIONS *********************************/


	$sql = "CREATE TABLE $wpdb->dealers_submissions ( "
            . " `id` int(11) NOT NULL, "
            . " `field_name` varchar(20) NOT NULL, "
            . " `field_value` varchar(50) NOT NULL, "
            . " `submission_id` int(11) NOT NULL "
            . " ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";


    dbDelta( $sql );
    
    $sql = "ALTER TABLE $wpdb->dealers_submissions ADD PRIMARY KEY (`id`);";

    $wpdb->query($sql);
    

    $sql = "ALTER TABLE $wpdb->dealers_submissions MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;";

    $wpdb->query($sql);



/******************************* SUBMISSIONS *********************************/


	$sql = "CREATE TABLE $wpdb->submissions ( "
      . "`datetime` datetime NOT NULL, "
      . "`cardealer_code` varchar(11) NOT NULL, "
      . "`submission_id` int(11) NOT NULL "
      . ") ENGINE=InnoDB DEFAULT CHARSET=latin1;";


    dbDelta( $sql );

    $sql = "ALTER TABLE $wpdb->submissions "
           . "ADD PRIMARY KEY (`submission_id`), "
           . "ADD KEY `id` (`submission_id`) USING BTREE;";

    $wpdb->query($sql);


    $sql = "ALTER TABLE $wpdb->submissions MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT; ";


    $wpdb->query($sql);




}






function wptp_add_tags_to_attachments() {
        register_taxonomy_for_object_type( 'post_tag', 'attachment' );

    }
    add_action( 'init' , 'wptp_add_tags_to_attachments' );
    add_action('plugins_loaded','wptp_add_tags_to_attachments');


add_action( 'wp_enqueue_scripts', 'custom_load_bootstrap' );
/**
 * Enqueue Bootstrap.
 */
function custom_load_bootstrap() {
    wp_enqueue_style( 'bootstrap-css', '//maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' );

    wp_enqueue_script( 'bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.js', array(), rand(111,9999), 'all' );

}

function wcar_forms_load_custom_styles() {
 		wp_register_style('wcar_forms_styles.css',  plugin_dir_url( __FILE__ ) . 'css/wcar_forms_styles.css', array(), rand(111,9999), 'all' );
		wp_register_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.1/themes/smoothness/jquery-ui.css', true);

        wp_enqueue_style('wcar_forms_styles.css');

        wp_enqueue_style( 'jquery-style' );

   // }
}
add_action( 'admin_menu', 'wcar_forms_load_custom_styles');
add_action( 'wp_enqueue_scripts', 'wcar_forms_load_custom_styles');
add_action( 'wp_print_styles', 'wcar_forms_load_custom_styles');

function wcar_forms_enqueue_scripts(){
  
	wp_register_script( 'wcar_forms_ajax_script', plugins_url( 'js/wcar_forms_ajax.js', __FILE__ ), array(), rand(111,9999), 'all' );

	wp_enqueue_script( 'wcar_forms_ajax_script' );

	wp_localize_script( 'wcar_forms_ajax_script', 'myAjax', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );


}

add_action( 'wp_enqueue_scripts', 'wcar_forms_enqueue_scripts' );
add_action( 'admin_enqueue_scripts', 'wcar_forms_enqueue_scripts' );


wp_add_inline_script( 'jquery-ui-tabs', 'window.$ = jQuery;' );

wp_enqueue_script('jquery-ui-tabs');




  

function submit_form(){

    $fields = stripslashes($_POST["values"]);
    $origfields = $_POST["values"];

    $vars = array();

    $arr = json_decode($fields);


    foreach($arr as $key=>$value){
        if ($key!=='' and $key!=='btn_submit') {

            //$output = $output . $key . "=>" . $value . "\n";

            if ($key=='dealer') {
                $cardealer_code = $value ;
            }
            //eval ('return $' . $key . "= '" . $value . "'");

        }
    }

    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->car_submissions = "wcar_car_submissions";
	$wpdb->car_dealers_submissions = "wcar_car_dealers_submissions";

	$todaysdate = date("Y-m-d");
	$todaysdate = date("Y-m-d H:i:s");

    $query = "INSERT INTO $wpdb->car_submissions (datetime, cardealer_code)  "
        . "VALUES ('$todaysdate', '$cardealer_code')";

    $wpdb->query($query);

    $last_id = $wpdb->insert_id;


    foreach($arr as $key=>$value){
        if ($key!=='' and $key!=='btn_submit') {

            //$output = $output . $key . "=>" . $value . "\n";
//            if ($value=='false') {$value = '0';}
//            elseif ($value=='true') {$value = '1';}
            //eval ('return $' . $key . "= '" . $value . "'");

            $query = "INSERT INTO $wpdb->car_dealers_submissions (field_name, field_value, submission_id)  "
            . "VALUES ('$key', '$value', $last_id)";

            $wpdb->query($query);

        }
    }



	 if ($wpdb->last_error !== '') {
	 	$wpdb->last_error;

	 }
	 else {
    	echo "Submitted";
    }






	wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_submit_form", "submit_form" );
add_action( "wp_ajax_nopriv_submit_form", "submit_form" );

function get_form_details(){
	
 	$form_id = $_POST['id'];
    

    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->forms = "wcar_forms";
	$wpdb->forms_templates = "wcar_forms_templates";
	$wpdb->templates = "wcar_templates";

	$form_details = $wpdb->get_row ( "SELECT f.id,f.form_name,f.brand, f.model,f.style, f.lang, f.fleet, f.template_id FROM $wpdb->forms f "
	. "INNER JOIN $wpdb->templates t ON t.id = f.template_id "
	. "WHERE f.id = " . $form_id);

	

	if (count($form_details)==0) {

		$form_details = $wpdb->get_row ( "SELECT * FROM $wpdb->forms WHERE id=$form_id");


	}

	echo json_encode($form_details);

	wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_formdetails", "get_form_details" );
add_action( "wp_ajax_nopriv_formdetails", "get_form_details" );



function get_dropdown_data(){
	
 	$entry_id = $_POST['id'];
    

    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_items = "wcar_dropdown_items";


	$dropdown_row = $wpdb->get_row ( "SELECT * FROM $wpdb->dropdown_items where id=$entry_id");
	echo json_encode($dropdown_row);

	wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_dropdown_data", "get_dropdown_data" );
add_action( "wp_ajax_nopriv_dropdown_data", "get_dropdown_data" );

function get_template_details(){
	
 	$template_id = $_POST['id'];
    


    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->templates_objects = "wcar_templates_objects";

	$template_objects = $wpdb->get_results( "SELECT * FROM $wpdb->templates_objects where template_id=$template_id");
	echo json_encode($template_objects);

	wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_templatedetails", "get_template_details" );
add_action( "wp_ajax_nopriv_templatedetails", "get_template_details" );



function get_template_shortcodes(){
	
 	$template_id = $_POST['id'];
    

    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->templates = "wcar_templates";

		
	$templates_sourcecode = $wpdb->get_row( "SELECT * FROM $wpdb->templates where id=$template_id");

	$source_code = $templates_sourcecode->source_code; 
	$template_name = $templates_sourcecode->title; 


	$output_render = '';

	$output_array = [];


	$sc_render = '';
	$sc_render = $sc_render . '<div class="form row"><div class="col-md-12">';
	$sc_render = $sc_render . do_shortcode($source_code);
	$sc_render = $sc_render . '</div></div>';
	
	$output_render = $output_render . $sc_render;

	$output_array["render"] = $output_render;
	$output_array["sourcecode"] = $source_code;
	$output_array["template_name"] = $template_name;

	echo json_encode($output_array);

	wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_templateshortcodes", "get_template_shortcodes" );
add_action( "wp_ajax_nopriv_templateshortcodes", "get_template_shortcodes" );

function get_forms_list (){

	
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->forms = "wcar_forms";
		
	$result = $wpdb->get_results ( "SELECT * FROM $wpdb->forms ORDER by form_name" );
	
	$output ='';

  	foreach( $result as $value ) { 

		$output = $output . '<option value="'. $value->id . '">' . $value->form_name .'</option>';
	
	}

 	echo $output;

	wp_die(); // ajax call must die to avoid trailing 0 in your response


}

add_action( "wp_ajax_forms_list", "get_forms_list" );
add_action( "wp_ajax_nopriv_forms_list", "get_forms_list" );

function get_templates_list (){

	
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->templates = "wcar_templates";
		
	$result = $wpdb->get_results ( "SELECT * FROM $wpdb->templates ORDER by title" );
	
	$output ='';

  	foreach( $result as $value ) { 

		$output = $output . '<option value="'. $value->id . '">' . $value->title .'</option>';
	
	}

 	echo $output;

	wp_die(); // ajax call must die to avoid trailing 0 in your response


}

add_action( "wp_ajax_templates_list", "get_templates_list" );
add_action( "wp_ajax_nopriv_templates_list", "get_templates_list" );


function get_dropdowns_groups (){

	$type = $_POST['type'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdowns = "wcar_dropdown_groups";
		
	$result = $wpdb->get_results ( "SELECT * FROM $wpdb->dropdowns WHERE type=" . $type .  " ORDER by title" );
	
	$output ='';

  	foreach( $result as $value ) { 

		$output = $output . '<option value="'. $value->id . '">' . $value->title .'</option>';
	
	}

 	echo $output;

	wp_die(); // ajax call must die to avoid trailing 0 in your response


}

add_action( "wp_ajax_dropdowns_groups", "get_dropdowns_groups" );
add_action( "wp_ajax_nopriv_dropdowns_groups", "get_dropdowns_groups" );

function get_cardealers_list (){

	

	$type = $_POST['type'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_items = "wcar_dropdown_items";
		
	$result = $wpdb->get_results ( "SELECT * FROM $wpdb->dropdown_items WHERE active=1 AND type=0 ORDER BY name");
	
	$output ='';

  	foreach( $result as $value ) { 

		$output = $output . '<option tag_value="'.  $value->tag_value . '" title="'.  $value->name . '" city="'.  $value->city . '" zip="'.  $value->zip . '" value="'. $value->id . '">' . $value->name . " (" .$value->city . ")" .'</option>';
	
	}

 	echo $output;

	wp_die(); // ajax call must die to avoid trailing 0 in your response


}

add_action( "wp_ajax_cardealers_list", "get_cardealers_list" );
add_action( "wp_ajax_nopriv_cardealers_list", "get_cardealers_list" );



/***************************** SHORTCODES **************************************/

function shortcode_gallery(){
	
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;


	$query_images_args = array(
	    'post_type'      => 'attachment',
	    'post_mime_type' => 'image',
	    'post_status'    => 'inherit',
	    'tag'    => 'cars',
	    'posts_per_page' => - 1,
	);

	$query_images = new WP_Query( $query_images_args );

	$images = array();
	$count = 0;

	foreach ( $query_images->posts as $image ) {

 		//if ($count==20) {break;}

	    $url = wp_get_attachment_url( $image->ID );
	    $filename = basename($url);

	    $output = $output . '<div style="border-bottom:1px solid #ccc;padding-bottom:10px;margin-bottom:10px;">'
	    . '<div style="float:left;margin-right:15px;"><img src="' . $url . '" height="30" width="30" >' . '</div>'
	    . '<div> <b>ID:</b>  ' . $image->ID . '<br>' . $filename. '</div></div>';

	    $count++;


	}


	


    return $output;
}

add_shortcode('carsgallery', 'shortcode_gallery');

 function shortcode_input($atts) {

	extract(shortcode_atts(array(
      'value' => '',
      'placeholder' => '',
      'class' => '',
      'name' => '',
      'invalid_text' => '',
   ), $atts));

	if ($class == '') {
		$class = "form-control mb-1";
	}

	$Content = '<input autocomplete="off" data-validator="required|min:4|max:10" data-error="'.$invalid_text.'" type="text" id="'.$name.'" name="'.$name.'" class="'.$class.'" placeholder = "' . $placeholder. '" required="">';

    return $Content;
}

add_shortcode('input', 'shortcode_input');


function shortcode_headline($atts) {

	extract(shortcode_atts(array(
		'name' => '',
      'value' => '',
      'var' => '',
      'style' => '',
		'class' => '',
		'invalid_text' => ''

   ), $atts));

	if ($class == '') {
		$class = "custom-control-input";
	}

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";
	$wpdb->forms_templates = "wcar_forms_templates";
	$wpdb->templates = "wcar_templates";


	$query2 = "SELECT * FROM  $wpdb->forms WHERE form_id = " . $form_id;

	$Content = '<h2 style="text-align: center;" form_id="' . $fid .'" class="'.$class.'">' . $value. "</h2>";




    return $Content;
}

add_shortcode('headline', 'shortcode_headline');


function shortcode_phone($atts) {

	extract(shortcode_atts(array(
	'name' => '',
    'value' => '',
    'var' => '',
    'style' => '',
	'class' => ''

   ), $atts));

	if ($class == '') {
		$class = "custom-control-input";
	}

	//$Content = '<div class="col-md-12"><h2 style="text-align: center;" class="'.$class.'">' . $value. "</h2></div>";

	$Content = '<div class="input-group mb-3">'
	. '<div class="input-group-prepend">'
	. '<span class="input-group-text" id="phoneLabel">+32</span></div>'
	. '<input type="text" id="phone" class="form-control" pattern="d{9}" placeholder="GSM ex: 486268590" aria-label="Telefoonnummer" aria-describedby="Telefoonnummer" required="">'
	. '</div>'
	. '<div class="invalid-feedback phone" >'
	. '</div>';



    return $Content;
}

add_shortcode('phone', 'shortcode_phone');

add_action( 'after_setup_theme', 'wpdocs_theme_setup' );
function wpdocs_theme_setup() {
    add_image_size( 'category-thumb', 300 ); // 300 pixels wide (and unlimited height)
    add_image_size( 'homepage-thumb', 250, 250, true ); // (cropped)
}


function shortcode_image($atts) {

	extract(shortcode_atts(array(
	'name' => '',
    'value' => '',
    'var' => '',
    'style' => '',
	'class' => '',
	'id' => ''

   ), $atts));

	if ($class == '') {
		$class = "img-fluid";
	}

	$imageSize = 'medium';


	$image = wp_get_attachment_image_src($id, $imageSize);

	$Content = '<div style="margin-top:20px;"><img class="' . $class . '" src="' . $image[0] . '" /></div>';



    return $Content;
}

add_shortcode('image', 'shortcode_image');

function shortcode_dynamic_images($atts) {

	extract(shortcode_atts(array(
	'name' => '',
    'value' => '',
    'brand' => '',
    'var' => '',
    'style' => '',
    'group_id' => '',
	'class' => '',
	'id' => ''

   ), $atts));


	$query_images_args = array(
	    'post_type'      => 'attachment',
	    //'tag_in' => 'cars, lexus',
	    'post_mime_type' => 'image',
	    'post_status'    => 'inherit',
	    //'post_tag'    => array('"cars", "' . strtolower($brand).''),
	    'posts_per_page' => 1,
	    'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'terms' => strtolower($brand),
                'field' => 'slug',
            )
        )


	);

	$query_images = new WP_Query( $query_images_args );

	$images = array();
	$count = 0;

	if ($class == '') {
		$class = "img-fluid";
	}



	foreach ( $query_images->posts as $image ) {


		$url = wp_get_attachment_url( $image->ID );
	    $filename = basename($url);


	    $Content = '<div style="margin-top:20px;"><img class="' . $class . '" src="' . $url . '" /></div>';


	}


    return $Content;
}

add_shortcode('dynamic_images', 'shortcode_dynamic_images');

function shortcode_label($atts) {

	extract(shortcode_atts(array(
        'name' => '',
        'value' => '',
        'var' => '',
        'style' => '',
        'class' => ''

   ), $atts));

	if ($class == '') {
		$class = "form_label";
	}

	$Content = '<p><br><label class="'.$class.'" >' . $value.'</label></p>';



    return $Content;
}

add_shortcode('label', 'shortcode_label');

function shortcode_p($atts) {

	extract(shortcode_atts(array(
            'value' => '',
            'class' => '',
            'style' => '',
            'name' => ''

   ), $atts));



	$Content = '<p class="'.$class.'" ><br>' . $value.'</p>';



    return $Content;
}

add_shortcode('p', 'shortcode_p');

function shortcode_result($atts) {

	extract(shortcode_atts(array(
      'value' => '',
		'class' => '',
		'style' => '',
		'name' => ''

   ), $atts));



	$Content = '<div id="resultWrapper">'
	            . ' <div id="resultSection" text="' . $value . '" >'
				. '</div></div>';



    return $Content;
}

add_shortcode('result', 'shortcode_result');

function shortcode_checkbox($atts) {

	extract(shortcode_atts(array(
      'value' => '',
		'class' => '',
		'style' => '',
		'data_content' => '',
		'name' => ''

   ), $atts));

	if ($class == '') {
		$class = "custom-control-label";
	}

	$Content = "<div class='custom-control custom-checkbox mb-1'>"

				. "<input type='checkbox' name='".$name. "' class='checkbox custom-control-input' id='".$name. "' value='false'>"
				. "<label data-toggle='popover-hover'  data-content='".$data_content. "' class='".$class."'  for='".$name."'>"

				 . $value
				. "</label>"

				. "</div>";


    return $Content;
}

add_shortcode('checkbox', 'shortcode_checkbox');

function shortcode_open_form($atts) {

	extract(shortcode_atts(array(
		'name' => '',
      'value' => '',
		'class' => '',
		'name' => ''

   ), $atts));

	if ($class == '') {
		$class = "was-validated border-light p-3";
	}



	$Content = '<form role="form" novalidate="true" class="'.$class.'" novalidate name="'.$name. '" id="'.$name. '" >'
	. '<input type="hidden" id="form_name" class="form-control mb-1" value="{{form_name}}" >';

    return $Content;
}

add_shortcode('open_form', 'shortcode_open_form');

function shortcode_close_form() {


	$Content = '</form>';

    return $Content;
}

add_shortcode('close_form', 'shortcode_close_form');

function shortcode_button($atts) {

	extract(shortcode_atts(array(
        'value' => '',
        'class' => '',
        'name' => '',
        'style' => '',
        'type' => ''



   ), $atts));

	if ($class == '') {
		$class = "btn btn-info btn-block form_button mt-4";
	}



	$Content = "<button name='".$name."' id='".$name."' class='".$class."' style='".$style."' type='".$type."' > " . $value . "</button>";


    return $Content;
}

add_shortcode('button', 'shortcode_button');

function shortcode_form($atts) {

	extract(shortcode_atts(array(
      'id' => ''



   ), $atts));

	if ($class == '') {
		$class = "btn btn-info btn-block";
	}


	$form_id = $id;

	global $post;
	global $wpdb;
	$wpdb->forms = "wcar_forms";
	$wpdb->templates = "wcar_templates";
	$wpdb->settings = "wcar_settings";
	global $car_form_id;
    global $entry_point;


    $settings_results = $wpdb->get_row( "SELECT * FROM $wpdb->settings where name='ajax_url'");



	$templates_form_details = $wpdb->get_row( "SELECT * FROM $wpdb->forms f "
						. "INNER JOIN $wpdb->templates t "
						. "ON t.id = f.template_id "
						. "WHERE f.id= $form_id"
						);


	$source_code = $templates_form_details->source_code;
	$brand = $templates_form_details->brand;

	$group_results = $wpdb->get_row("SELECT * FROM $wpdb->dropdown_groups WHERE lower(`title`) = lower('". $brand . "') ");

	$group_id = $group_results->id;

	$settings_results = $wpdb->get_row( "SELECT * FROM $wpdb->settings where name='ajax_url'");

	$AJAX_FULL_URL = $settings_results->value;

	if ($AJAX_FULL_URL=='') {
	    $AJAX_FULL_URL = 'https://news.gocarsolutions.be/wp-admin/admin-ajax.php';
	}


	$brand = ucfirst(strtolower($templates_form_details->brand));
	$model = ucfirst(strtolower($templates_form_details->model));
	$model = ucfirst(strtolower($model));

	$car_model = $brand . " " . $model ;


    $bootstrap_js = '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.js"></script>';
	$bootstrap_css = '<link rel="stylesheet" type="text/css" href="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';


    $validation = "<script>
var $ = jQuery.noConflict();
$( document ).ready(function() { 

    $(function () {
        //var selection = $('[data-toggle=\"popover-hover\"]').text();
        if ($('[data-toggle=\"popover-hover\"]').length) {
            $('[data-toggle=\"popover-hover\"]').popover({
                trigger : 'hover'
            });
        }

    });


if ($(\"#leadsform\").length) {
        var inputs = $(\"#leadsform :input[required]\");

        var empty = '';

        inputs.each(function () {
            if ($(this).val() == '') {
                empty = true;
            }
            else {
                empty = false;
            }
        });

        if (empty) {
            $('#btn_submit').prop('disabled', true); //
        } else {
            $('#btn_submit').removeAttr('disabled'); //
        }


        inputs.on(\"keyup\", function(e) {

            var empty = '';

            if ($(this).val() == '') {
                empty = true;
            }
            else {
                empty = false;
            }

            if (empty) {
                $('#btn_submit').prop('disabled', true);
            } else {
                $('#btn_submit').removeAttr('disabled');
            }

        });


    }

    $(\"#leadsform\").submit(function( e ) {
    //$(\"#btn_submit\").submit(function (e) {
            e.preventDefault();




            var inputs = $(\"#leadsform :input, #leadsform input[type='text'],  input[type=checkbox]\");



            var values = {};
            inputs.each(function() {
                if ($(this).attr('type')!=='submit' && this.name!=='') {
                    values[this.name] = $(this).val();
                }
                if ($(this).attr('type')==='checkbox') {
                    if ($(this).is(\":checked\")) {
                        values[this.name] = '1';
                    }
                    else {
                        values[this.name] = '0';
                    }
                }
            });

            values = JSON.stringify(values);


            $.ajax({

                type: 'POST',
                data: JSON,
                url: '$AJAX_FULL_URL' ,
                data: { action: 'submit_form', values: values },
                success: function(response) {

                    //alert(response);
                    $('#btn_submit').prop('disabled', true);
                    var text = $('#resultSection').attr(\"text\");
                    $('#resultSection').html(text);
                    $('#resultSection').fadeIn().delay(8000).fadeOut();




                }
            });

            return false;
        });


});
</script>";

	$sc_render = $sc_render . $bootstrap_js;
	$sc_render = $sc_render . $bootstrap_css;
    $sc_render = $sc_render . $validation;


	$sc_render = $sc_render . '<div id="form_wrapper"><div class="form row"><div class="col-md-12">';
//$sc_render = $sc_render . "<div>" . $car_model . "</div>";

	$source_code = str_replace ( "dynamic_dealers" ,'dynamic_dealers group_id="'.$group_id.'" ', $source_code  ) ;
	$source_code = str_replace ( "dynamic_images" ,'dynamic_images brand="'.$brand.'" ', $source_code  ) ;

	$render_content = do_shortcode($source_code);

	$render_content = str_replace ( "{{carmodel}}" ,$car_model, $render_content  ) ;
	$render_content = str_replace ( "{{form_name}}" ,$form_id, $render_content  ) ;


	$sc_render = $sc_render . $render_content;


	$sc_render = $sc_render . '</div></div></div>';

	return $sc_render;




}

add_shortcode('form', 'shortcode_form');

function shortcode_dropdown($atts) {

	extract(shortcode_atts(array(
      'id' => '',
		'class' => '',
		'name' => '',
		'label' => '',
		'invalid_text' => ''

   ), $atts));

	$dropdown_id = $_POST['id'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";
	//$wpdb->templates = "wcar_templates";

	$query = "SELECT * FROM $wpdb->dropdown_items_groups ig "
			. "INNER JOIN $wpdb->dropdown_items i ON i.id=ig.item_id "
			. "INNER JOIN $wpdb->dropdown_groups g ON g.id = ig.group_id "
			. "WHERE ig.group_id=$id "
			. "ORDER BY i.name";

	$dropdown_options = $wpdb->get_results( $query );

	$options = '';

	foreach( $dropdown_options as $value ) {
		  		$options = $options . "<option value='" . $value->tag_value . "' >" . $value ->name . "</option>";
		  	}

	if ($class == '') {
		$class = "browser-default custom-select mb-1";
	}


	$Content = "<label for='".$name."'>". $label. "</label><br>"
	. "<select name='".$name."' id='".$name."' class='".$class."' >" . $options. "</select><br>";



    return $Content;

}

add_shortcode('dropdown', 'shortcode_dropdown');



function shortcode_dynamic_dealers($atts) {

	extract(shortcode_atts(array(
      'value' => '',
		'class' => '',
		'name' => '',
		'group_id' => '',
		'label' => '',
		'invalid_text' => ''

   ), $atts));



	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";
	//$wpdb->templates = "wcar_templates";

	$query = "SELECT * FROM $wpdb->dropdown_items_groups ig "
			. "INNER JOIN $wpdb->dropdown_items i ON i.id=ig.item_id "
			. "INNER JOIN $wpdb->dropdown_groups g ON g.id = ig.group_id "
			. "WHERE ig.group_id=" . $group_id . " "
 			. "ORDER BY i.name";

	$dropdown_options = $wpdb->get_results( $query );

	$options = '';

	foreach( $dropdown_options as $value ) {
		  		$options = $options . "<option value='" . $value->tag_value . "' >" . $value ->name . "</option>";
		  	}

	if ($class == '') {
		$class = "browser-default custom-select mb-1";
	}


	$Content = "<label for='".$name."'>". $label. "</label><br>"
	. "<select name='".$name."' id='".$name."' class='".$class."' >" . $options. "</select><br>";

	if ($invalid_text = '') {
		$invalid_text = 'Le champ n\'a pas été complété';
	}



    return $Content;

}

add_shortcode('dynamic_dealers', 'shortcode_dynamic_dealers');



function get_dropdown_items () {




	$group_id = $_POST['id'];
	$type = $_POST['type'];


	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";



		$query = "SELECT * FROM $wpdb->dropdown_items_groups ig " 
			. "INNER JOIN $wpdb->dropdown_items i ON i.id=ig.item_id "
			. "WHERE ig.group_id = $group_id AND active=1 "
			. "ORDER BY ig.position";
		



	$dropdown_items = $wpdb->get_results( $query );


	$options = '';

	foreach( $dropdown_items as $value ) { 

				$tag_value = $value->tag_value;
				$zip = $value->zip;
				$city = $value->city;

				if ($type==0) {
					$options = $options . "<option city='". $city . "' zip='". $zip . "' tag_value='". $tag_value . "' value='" . $value->id . "' >" . $value ->name . " (" . $value ->city  . ") </option>\n";
		  		
				}
				else {
		  			$options = $options . "<option city='". $city . "' zip='". $zip . "' tag_value='". $tag_value . "' value='" . $value->id . "' >" . $value ->name . "</option>\n";
		  		}
		  	}
 	
	$Content = $options;


    echo $Content;

    wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_dropdownitems", "get_dropdown_items" );
add_action( "wp_ajax_nopriv_dropdownitems", "get_dropdown_items" );




function get_custom_dropdown_items () {


	$group_id = $_POST['id'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;

	$wpdb->custom_dropdown_groups = "wcar_dropdown_groups";
	$wpdb->custom_dropdown_items = "wcar_dropdown_items";
	$wpdb->custom_dropdown_items_groups = "wcar_dropdown_items_groups";

	$query = "SELECT * FROM $wpdb->custom_dropdown_items_groups ig " 
			. "INNER JOIN $wpdb->custom_dropdown_items i ON i.id=ig.item_id "
			. "WHERE ig.group_id = $group_id AND ig.type=1 "
			. "ORDER BY ig.position";

	$custom_dropdown_items = $wpdb->get_results( $query );

	$options = '';

	foreach( $custom_dropdown_items as $value ) { 
		  		$options = $options . "<option tag_value=".$value->tag_value." value='" . $value->id . "' >" . $value ->name . "</option>\n";
		  	}
 	
	$Content = $options;


    echo $Content;

    wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_customdropdownitems", "get_custom_dropdown_items" );
add_action( "wp_ajax_nopriv_customdropdownitems", "get_custom_dropdown_items" );



function new_form () {


 	$form_name = $_POST['form_name'];

    

    //echo $form_id;

    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->forms = "wcar_forms";

	$query = "INSERT INTO $wpdb->forms (form_name) VALUES ('" . $form_name  . "')";
	

	$wpdb->query($query);

	$last_id = $wpdb->insert_id;

    echo $last_id;

    wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_new_form", "new_form" );
add_action( "wp_ajax_nopriv_new_form", "new_form" );





function form_save () {


 	$form_id = $_POST['form_id'];
 	$name = urldecode($_POST['name']);
 	$brand = urldecode($_POST['brand']);
 	$model = urldecode($_POST['model']);
 	$style = urldecode($_POST['style']);
 	$lang = urldecode($_POST['lang']);
 	$fleet = $_POST['fleet'];
 	$template_id = $_POST['t_id'];
    

    //echo $form_id;

    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";
	//$wpdb->templates = "wcar_templates";
	
		
	//$wpdb->update( $wpdb->templates, $data, "id=".$template_id", $format, $where_format );

	$query = "UPDATE $wpdb->forms SET "
		. "form_name = '" . $name  . "',"
		. "brand = '" . $brand  . "',"
		. "model = '" . $model  . "',"
		. "style = '" . $style  . "',"
		. "lang = '" . $lang  . "',"
		. "fleet = '" . $fleet  . "',"
		. "template_id = " . $template_id . " "
		. "WHERE id = " . $form_id;

	$wpdb->query($query);

	 if ($wpdb->last_error !== '') {
	 	echo "Error.<br>" . $query ;
	 } 
	 else {
    	echo "Form Saved";
    }
    //return $query;

    wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_form_save", "form_save" );
add_action( "wp_ajax_nopriv_form_save", "form_save" );


function form_delete () {


 	$form_id = $_POST['form_id'];
 

    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->forms = "wcar_forms";

	$query = "DELETE FROM $wpdb->forms WHERE id = " . $form_id;

	$wpdb->query($query);

	 if ($wpdb->last_error !== '') {
	 	echo "Error.<br>" . $query ;
	 } 
	 else {
    	echo "Form Deleted";
    }

    wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_form_delete", "form_delete" );
add_action( "wp_ajax_nopriv_form_delete", "form_delete" );


function template_new () {



  $template_name = urldecode($_POST['tn']);
  $lang = urldecode($_POST['lang']);

    if (!isset($lang)) {$lang = ' ';}

   global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->templates = "wcar_templates";


    $query = "INSERT INTO $wpdb->templates (title, lang) VALUES ('$template_name', '$lang')";

    $wpdb->query($query);

    $last_id = $wpdb->insert_id;


    echo $last_id;


    wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_template_new", "template_new" );
add_action( "wp_ajax_nopriv_template_new", "template_new" );

function template_save () {


 	$template_id = $_POST['id'];
 	$source_code = urldecode($_POST['sc']);
 	$template_name = urldecode($_POST['tn']);
    

    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->templates = "wcar_templates";

	$query = "UPDATE $wpdb->templates SET source_code = '" . $source_code . "', title = '". $template_name ."' WHERE id = " . $template_id;
		
	$wpdb->query($query);

	if ($wpdb->last_error !== '') {
	 	echo "Error while Saving";
	 }
	 else {
    	echo 'Template Saved';
    }

    wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_template_save", "template_save" );
add_action( "wp_ajax_nopriv_template_save", "template_save" );




function dropdown_save () {

	$type = $_POST['type'];
	$group_id = $_POST['dropdown_id'];
	$options = $_POST['options'];
	$json_data = json_encode($options);

	$output = '';


    global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";


	$query = "DELETE FROM $wpdb->dropdown_items_groups WHERE group_id = " . $group_id;

	$wpdb->query($query);


	foreach ($options as $item) {

		$item_id = $item["id"];
		$position = $item["position"];
		$tag_value = $item["tag_value"];
		$name = $item["title"];
		$city = $item["city"];
		$zip = $item["zip"];

		if ($item_id!='') { 
			


			$query = "INSERT INTO $wpdb->dropdown_items_groups (item_id, group_id, position, type) VALUES ($item_id, $group_id, $position, $type)";

			$wpdb->query($query);

		
	


		}
		else { // no id, new item

			if ($type==0) {
				$query = "INSERT INTO $wpdb->dropdown_items (type, tag_value, name, zip, city, active) VALUES ($type, '$tag_value', '$name', $zip, '$city', 1)";
			}
			else {
				$query = "INSERT INTO $wpdb->dropdown_items (type, tag_value, name, active) VALUES ($type, '$tag_value', '$name', 1)";
			
			}

			$wpdb->query($query);

			$last_id = $wpdb->insert_id;

			$query = "INSERT INTO $wpdb->dropdown_items_groups (item_id, group_id, position, type) VALUES ($last_id, $group_id, $position, $type)";

			$wpdb->query($query);

		}		


	
	}





	 if ($wpdb->last_error !== '') {
	 	$wpdb->last_error;

	 }
	 else {
    	echo 'Dropdown Saved';
    }
	

    wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_dropdown_save", "dropdown_save" );
add_action( "wp_ajax_nopriv_dropdown_save", "dropdown_save" );

function dropdown_rename () {

	$new_name = urldecode($_POST['new_name']);
	$group_id = $_POST['id'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$wpdb->dropdown_groups = "wcar_dropdown_groups";

	$query = "UPDATE $wpdb->dropdown_groups SET title = '" . $new_name . "' WHERE id = " . $group_id;

	$wpdb->query($query);



	if ($wpdb->last_error !== '') {

	 	$wpdb->last_error;
	 	//echo $query ;
	 } 
	 else {
    	echo "Dropdown Renamed";
    }

  	wp_die(); // ajax call must die to avoid trailing 0 in your response

}

add_action( "wp_ajax_dropdown_rename", "dropdown_rename" );
add_action( "wp_ajax_nopriv_dropdown_rename", "dropdown_rename" );



function template_delete () {

	
	$template_id = $_POST['tid'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";
	$wpdb->forms_templates = "wcar_forms_templates";
	$wpdb->templates = "wcar_templates";


	// check whether there are items in the other tables, if so delete them too

	$query2 = "SELECT count(*) FROM  $wpdb->templates t"
		. "INNER JOIN $wpdb->forms_templates ft ON ft.template_id = t.id "
		. "WHERE ft.template_id = " . $template_id;

	$result = $wpdb->get_var ($query2);

	if ($result>0) {

		$query = "DELETE $wpdb->templates, $wpdb->forms_templates "
		. "FROM $wpdb->templates"
		. "INNER JOIN $wpdb->forms_templates ON $wpdb->templates.id = $wpdb->forms_templates.template_id "
		. "WHERE $wpdb->forms_templates.template_id = " . $template_id;

		$wpdb->query($query);
	
	}
	else {
		$query = "DELETE FROM $wpdb->templates WHERE id = " . $template_id;
		$wpdb->query($query);
	}
	//echo $query;

	if ($wpdb->last_error !== '') {

	 	echo $wpdb->last_error;
	 	//echo $query ;
	 } 
	 else {
    	echo "Template Deleted";
    	//echo $query;
    }

  	wp_die(); // ajax call must die to avoid trailing 0 in your response

}



add_action( "wp_ajax_template_delete", "template_delete" );
add_action( "wp_ajax_nopriv_template_delete", "template_delete" );


function dropdown_delete () {

	
	$group_id = $_POST['id'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;

	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";

	$wpdb->delete( $wpdb->dropdown_groups, array( 'id' => $group_id ) );

	// check whether there are items in the other tables, if so delet them too
	$query2 = "SELECT count(*) FROM $wpdb->dropdown_items_groups WHERE group_id = " . $group_id;
	$result = $wpdb->get_var ($query2);

	if ($result>0) {

		$query = "DELETE $wpdb->dropdown_items, $wpdb->dropdown_items_groups "
		. "FROM $wpdb->dropdown_items "
		. "INNER JOIN $wpdb->dropdown_items_groups ON $wpdb->dropdown_items_groups.item_id = $wpdb->dropdown_items.id "
		. "WHERE $wpdb->dropdown_items_groups.group_id = " . $group_id;

		$wpdb->query($query);
	
	}


	if ($wpdb->last_error !== '') {

	 	echo $wpdb->last_error;
	 }
	 else {
    	echo "Dropdown Deleted";
    	//echo $query;
    }

  	wp_die(); // ajax call must die to avoid trailing 0 in your response

}



add_action( "wp_ajax_dropdown_delete", "dropdown_delete" );
add_action( "wp_ajax_nopriv_dropdown_delete", "dropdown_delete" );


function dropdown_copy () {

	
	$new_name = urldecode($_POST['new_name'])." copy";
	$type = $_POST['type'];
	$group_id = $_POST['id'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";

	$query = "INSERT INTO $wpdb->dropdown_groups (title, type) "
	. "SELECT '$new_name', type "
	. "FROM $wpdb->dropdown_groups "
	. "WHERE id = " . $group_id;




	$wpdb->query($query);
	$new_group_id = $wpdb->insert_id;


	$query = "SELECT i.id, i.type, i.tag_value, i.name, i.zip, i.city, item_id, i.active, group_id, position "
		. "FROM $wpdb->dropdown_items i "
		. "INNER JOIN $wpdb->dropdown_items_groups ig " 
		. "ON ig.item_id = i.id "
		. "WHERE ig.group_id = " . $group_id . " ";

	$results = $wpdb->get_results($query);


	foreach ($results as $value) {

			$type = $value->type;
			$tag_value = $value->tag_value;
			$name = $value->name;
			$zip = $value->zip;
			$city = $value->city;
			$active = $value->active;


			$item_id = $value->type;
			$group_id = $value->group_id;
			$position = $value->position;
	
			if ($type==1) {
				$query = "INSERT INTO $wpdb->dropdown_items (type, tag_value, name, active)  "
				. "VALUES ($type, '$tag_value', '$name', 1)";
			}
			else {
				$query = "INSERT INTO $wpdb->dropdown_items (type, tag_value, name, zip, city, active)  "
				. "VALUES ($type, $tag_value, $name, $zip, $city, $active)";	
			}

			$wpdb->query($query);

			$last_id = $wpdb->insert_id;


			$query = "INSERT INTO $wpdb->dropdown_items_groups (item_id, group_id, position, type)  "
			. "VALUES ($last_id, $new_group_id, $position, $type)";

			$wpdb->query($query);


	}


	if ($wpdb->last_error !== '') {


	 	echo $wpdb->last_error."<br>";
	 	//echo $query;

	 } 
	 else {
    	echo "Dropdown Copied";
    	//echo json_encode($results);
    }

  	wp_die(); // ajax call must die to avoid trailing 0 in your response

}



add_action( "wp_ajax_dropdown_copy", "dropdown_copy" );
add_action( "wp_ajax_nopriv_dropdown_copy", "dropdown_copy" );



function dropdown_create () {

	
	$name = urldecode($_POST['name']);
	$type = $_POST['type'];

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";

	$query = "INSERT INTO $wpdb->dropdown_groups (title, type) VALUES ('$name',$type)";

	$wpdb->query($query);

	$last_id = $wpdb->insert_id;


	if ($wpdb->last_error !== '') {

	 	$wpdb->last_error;
	 	//echo $query ;
	 } 
	 else {
    	echo $last_id;
    }

  	wp_die(); // ajax call must die to avoid trailing 0 in your response

}



add_action( "wp_ajax_dropdown_create", "dropdown_create" );
add_action( "wp_ajax_nopriv_dropdown_create", "dropdown_create" );


function form_preview() {

	$form_id = $_POST["form_id"];
	$template_id = $_POST["template_id"];


	
	global $wpdb;
	$wpdb->templates = "wcar_templates";

	

	

	$templates_sourcecode = $wpdb->get_row( "SELECT * FROM $wpdb->templates where id=$template_id");

	$source_code = $templates_sourcecode->source_code; 


	$sc_render = '<link href="https://s3-eu-west-1.amazonaws.com/itcl/gocar/lead/css/bootstrap.min.css" rel="stylesheet">';
	$sc_render = $sc_render . '<div style="border:2px solid #ddd;padding:20px;"><div class="form row"><div class="col-md-12">';
	$sc_render = $sc_render . do_shortcode($source_code);
	$sc_render = $sc_render . '</div></div></div></div>';


	

	$content = $sc_render;


	file_put_contents('_tmp_form.html', ob_get_contents());
    
	echo $content;


    wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_form_preview", "form_preview" );
add_action( "wp_ajax_nopriv_form_preview", "form_preview" );

function encode_utf8($data)
{
    if ($data === null || $data === '') {
        return $data;
    }
    if (!mb_check_encoding($data, 'UTF-8')) {
        return mb_convert_encoding($data, 'UTF-8');
    } else {
        return $data;
    }
}

function file_get_contents_utf8($fn) {
     $content = file_get_contents($fn);
      return mb_convert_encoding($content, 'UTF-8',
          mb_detect_encoding($content, 'UTF-8, Windows-1252', true));
}


function import_csv() {

	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";

if ( ! function_exists( 'wp_handle_upload' ) ) require_once( ABSPATH . 'wp-admin/includes/file.php' );

$uploadedfile = $_FILES['file'];  

$upload_overrides = array( 'test_form' => false);

 $movefile  = wp_handle_upload($uploadedfile, $upload_overrides);

 
	if ($movefile && !isset($movefile['error'])) {

		$fileName = $movefile["file"];

			}
		
	$file = file_get_contents_utf8($fileName);

	$file = preg_replace("/\r\n|\n\r|\n|\r/", "\n", $file);
	$file = str_replace("?", "è", $file);

	$row = str_getcsv($file, "\n");

	$count = count($row);

	$query = "DELETE FROM $wpdb->dropdown_items WHERE id BETWEEN 1 AND 53"; 
	$wpdb->query($query);	

	//iconv_set_encoding("internal_encoding", "UTF-8");

	for($i=1 ; $i < $count ; $i++ ) {
	
			$data = str_getcsv($row[$i], ";");
				 
			if ($data) {
					 $id = $data[0];
					 $type = $data[1];
					 $tag_value = $data[2];
					 $name = $data[3];


					 $zip = $data[4];
					 $city = $data[5];

					 $active = $data[6];

					if ($i == 5) {
					 	$out = $city;
					 }

					$query = "INSERT INTO $wpdb->dropdown_items (id, type, tag_value, name, zip, city, active) "
							. "VALUES ($id, $type, '$tag_value', '$name', $zip, '$city', $active); "; 
					$wpdb->query($query);

			}

		

	}


	echo 'Car Dealers List Updated';
	//echo $out;

    wp_die(); // ajax call must die to avoid trailing 0 in your response
}

add_action( "wp_ajax_import_csv", "import_csv" );
add_action( "wp_ajax_nopriv_import_csv", "import_csv" );

 function list_forms () {     
            
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";


    
    $search = $wpdb->esc_like(stripslashes($_POST['searchtext'])).'%'; //escape for use in LIKE statement

    $results =   $wpdb->get_results("SELECT * from $wpdb->forms" );   


	$sql = "select * 
		from $wpdb->forms 
		where form_name like %s ";

	$sql = $wpdb->prepare($sql, $search);
    
  	$results = $wpdb->get_results($sql);

    //$results =   $wpdb->get_results("SELECT * from $wpdb->forms" );   
    
    $out = [];
    $forms = array();

    $output = '<ul>';

    foreach($results as $value)
    {
      $forms[] = addslashes($value->form_name);

    }

    $output = $output . '</ul>';    
    
    echo json_encode($forms);

wp_die();
            

}

add_action( "wp_ajax_list_forms", "list_forms" );
add_action( "wp_ajax_nopriv_list_forms", "list_forms" );

 function search_forms () {     
            
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";


    
    $search = $wpdb->esc_like(stripslashes($_POST['searchtext'])).'%'; //escape for use in LIKE statement

    $results =   $wpdb->get_results("SELECT * from $wpdb->forms WHERE form_name like %s " );   


	$sql = "select * 
		from $wpdb->forms 
		where form_name like %s ";

	$sql = $wpdb->prepare($sql, $search);
    
  	$results = $wpdb->get_results($sql);


    $out = [];
    $forms = array();

    $output = '<ul>';

    foreach($results as $value)
    {

      $forms[] = array (

      	'id' => $value->id,
      	'value' => $value->form_name

      );
    }

    $output = $output . '</ul>';    
    
    echo json_encode($forms);

wp_die();
            

}

add_action( "wp_ajax_search_forms", "search_forms" );
add_action( "wp_ajax_nopriv_search_forms", "search_forms" );






 function get_models () {     
            

    $brand_id = $_POST["brand_id"];
            
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	$wpdb->forms = "wcar_forms";


    
   $results =   $wpdb->get_results("SELECT DISTINCT model from $wpdb->forms WHERE brand='$brand_id'" );   

   $output = ''; 
   
   foreach ($results as $value) {
   		$output = $output . "<option value='". $value->model . "'>" . $value->model . "</option>";
	}
   
    echo $output;

	wp_die();
            

}

add_action( "wp_ajax_get_models", "get_models" );
add_action( "wp_ajax_nopriv_get_models", "get_models" );


function get_styles () {     
            

    $brand_id = $_POST["brand_id"];
    $model_id = $_POST["model_id"];
            
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";


    
   $results =   $wpdb->get_results("SELECT DISTINCT style from $wpdb->forms WHERE brand='$brand_id' AND model='$model_id'");   

   $output = ''; 
   
   foreach ($results as $value) {
   		$output = $output . "<option value='". $value->style . "'>" . $value->style . "</option>";
	}
   
    echo $output;

	wp_die();
            

}

add_action( "wp_ajax_get_styles", "get_styles" );
add_action( "wp_ajax_nopriv_get_styles", "get_styles" );


 function get_langs () {     
            

    $brand_id = $_POST["brand_id"];
    $model_id = $_POST["model_id"];
    $style_id = $_POST["style_id"];
            
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";


    
   $results =   $wpdb->get_results("SELECT DISTINCT lang from $wpdb->forms WHERE brand='$brand_id' AND model='$model_id'  AND style='$style_id'" );   

   $output = ''; 
   
   foreach ($results as $value) {
   		$output = $output . "<option value='". $value->lang . "'>" . $value->lang . "</option>";
	}
   
    echo $output;

	wp_die();
            

}

add_action( "wp_ajax_get_langs", "get_langs" );
add_action( "wp_ajax_nopriv_get_langs", "get_langs" );


 function get_fleet () {     
            

    $brand_id = $_POST["brand_id"];
    $model_id = $_POST["model_id"];
    $style_id = $_POST["style_id"];
    $lang_id  = $_POST["lang_id"];
            
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";


    
    $results =   $wpdb->get_row("SELECT * from $wpdb->forms WHERE brand='$brand_id' AND model='$model_id'  AND style='$style_id'  AND lang='$lang_id'" );

   
   	$output = $results->fleet;
	
   
    echo $output;

	wp_die();
            

}

add_action( "wp_ajax_get_fleet", "get_fleet" );
add_action( "wp_ajax_nopriv_get_fleet", "get_fleet" );


 function get_form_id () {     
            

    $brand_id = $_POST["brand_id"];
    $model_id = $_POST["model_id"];
    $style_id = $_POST["style_id"];
    $lang_id  = $_POST["lang_id"];
    $fleet_id = $_POST["fleet_id"];
            
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";


    
   $results =   $wpdb->get_row("SELECT * from $wpdb->forms WHERE brand='$brand_id' AND model='$model_id'  AND style='$style_id'  AND lang='$lang_id' AND fleet='$fleet_id'" );   

    
   	$output = $results->id;
	
   
   
   
    echo $output;

	wp_die();
            

}

add_action( "wp_ajax_get_form_id", "get_form_id" );
add_action( "wp_ajax_nopriv_get_form_id", "get_form_id" );


function save_settings () {     
            

    $preview_page_id = $_POST["pid"];
    $ajax_url = $_POST["ajax_url"];


	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->settings = "wcar_settings";



	$query = "UPDATE $wpdb->settings SET value = '" . $preview_page_id  . "' WHERE name = 'preview_page' ";

	$wpdb->query($query);

	$query = "UPDATE $wpdb->settings SET value = '" . $ajax_url  . "' WHERE name = 'ajax_url' ";

	$wpdb->query($query);

	 if ($wpdb->last_error !== '') {
	 	echo "Error.<br>" . $query ;
	 } 
	 else {
    	echo "Settings Saved";
    }

    wp_die(); // ajax call must die to avoid trailing 0 in your response
            

}

add_action( "wp_ajax_save_settings", "save_settings" );
add_action( "wp_ajax_nopriv_save_settings", "save_settings" );

function download_csv() {


	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->dropdown_items = "wcar_dropdown_items";
	$wpdb->dropdown_items_groups = "wcar_dropdown_items_groups";

	$query = "SELECT * FROM $wpdb->dropdown_items WHERE type=0";


	$rows = $wpdb->get_results($query, 'ARRAY_A');

    if ($rows) {

        $csv_fields = array();
        $csv_fields[] = "first_column";
        $csv_fields[] = 'second_column';

        $output_filename = 'car_dealerships' .'.csv';
        $output_handle = @fopen('php://output', 'w');

        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Content-Description: File Transfer');
        header('Content-type: text/csv');
        header('Content-Disposition: attachment; filename=' . $output_filename);
        header('Expires: 0');
        header('Pragma: public');

        $first = true;
       // Parse results to csv format
        foreach ($rows as $row) {

 		$delimiter = ';';

       // Add table headers
            if ($first) {

               $titles = array();

                foreach ($row as $key => $val) {

                    $titles[] = $key;

                }

                fputcsv($output_handle, $titles, $delimiter);

                $first = false;
            }

           

            $leadArray = (array) $row; // Cast the Object to an array

            $leadArray = array_map("utf8_decode", $leadArray);
            // Add row to file
            fputcsv($output_handle, $leadArray, $delimiter);
        }

        //echo '<a href="'.$output_handle.'">test</a>';

        // Close output file stream
        fclose($output_handle);

        die();
        
   }
	

   // wp_die();


}

add_action( 'admin_post_download_csv', 'download_csv' );
add_action( 'admin_post_nopriv_download_csv', 'download_csv' );


/************************* END OF AJAX INIT ************************************/



add_action('admin_menu', 'test_plugin_setup_menu');


/******************************** PLUGIN STARTS HERE *************************************/

function test_plugin_setup_menu(){
	
    $page_title = 'Leads Form Settings';
    $menu_title = 'Leads Form Manager';
    $capability = 'manage_options';
    $slug = 'leadsform';
    $callback = 'plugin_settings_page_content';
    $icon = plugins_url( 'images/icon.png?'.rand(111,9999), __FILE__ );
    $position = 100;

    add_menu_page( $page_title, $menu_title, $capability, $slug, $callback, $icon);
}


	
function plugin_settings_page_content() {
?>
        <?php  
        if( isset( $_GET[ 'tab' ] ) ) {  
            $active_tab = $_GET[ 'tab' ];  
        } else {
            $active_tab = 'tab_one';
        }
        ?>  
        <div class="wrap">
            <h2>Leads Form Manager</h2>
            <div class="description"></div>
            <?php settings_errors(); ?> 

            <h2 class="nav-tab-wrapper">  
                <a href="?page=leadsform&tab=tab_one" id="tab_forms" class="nav-tab <?php echo $active_tab == 'tab_one' ? 'nav-tab-active' : ''; ?>">Forms</a>  
                <a href="?page=leadsform&tab=tab_two" id="tab_templates" class="nav-tab <?php echo $active_tab == 'tab_two' ? 'nav-tab-active' : ''; ?>">Templates</a>  
				<a href="?page=leadsform&tab=tab_three" id="tab_dropdowns" class="nav-tab <?php echo $active_tab == 'tab_three' ? 'nav-tab-active' : ''; ?>">Dealership Drop Downs</a>  
          		<a href="?page=leadsform&tab=tab_four" id="tab_customdropdowns" class="nav-tab <?php echo $active_tab == 'tab_four' ? 'nav-tab-active' : ''; ?>">Custom Drop Downs</a>  
          		<a href="?page=leadsform&tab=tab_five" id="tab_settings" class="nav-tab <?php echo $active_tab == 'tab_five' ? 'nav-tab-active' : ''; ?>">Settings</a>  
      
	            </h2>  

            <form method="post" action="options.php"> 
            <?php
                if( $active_tab == 'tab_one' ) {  

                    settings_fields( 'setting-group-1' );
                    do_settings_sections( 'my-menu-slug-1' );

                } else if( $active_tab == 'tab_two' )  {

                    settings_fields( 'setting-group-2' );
                    do_settings_sections( 'my-menu-slug-2' );

                }
                else if( $active_tab == 'tab_three' )  {

                    settings_fields( 'setting-group-3' );
                    do_settings_sections( 'my-menu-slug-3' );

                }
                 else if( $active_tab == 'tab_four' )  {

                    settings_fields( 'setting-group-4' );
                    do_settings_sections( 'my-menu-slug-4' );

                }
                else if( $active_tab == 'tab_five' )  {

                    settings_fields( 'setting-group-5' );
                    do_settings_sections( 'my-menu-slug-5' );

                }
            ?>

               
            </form> 

        </div>
        <?php
}

/* ----------------------------------------------------------------------------- */
/* Setting Sections And Fields */
/* ----------------------------------------------------------------------------- */ 

function sandbox_initialize_theme_options() {  
    add_settings_section(  
        'page_1_section',         // ID used to identify this section and with which to register options  
        'Form Editor',                  // Title to be displayed on the administration page  
        'page_1_section_callback', // Callback used to render the description of the section  
        'my-menu-slug-1'                           // Page on which to add this section of options  

    );

    add_settings_section(  
        'page_2_section',         // ID used to identify this section and with which to register options  
        'Template Editor',                  // Title to be displayed on the administration page  
        'page_2_section_callback', // Callback used to render the description of the section  
        'my-menu-slug-2'                           // Page on which to add this section of options  
    );

        add_settings_section(  
        'page_3_section',         // ID used to identify this section and with which to register options  
        'Drop Down Manager',                  // Title to be displayed on the administration page  
        'page_3_section_callback', // Callback used to render the description of the section  
        'my-menu-slug-3'                           // Page on which to add this section of options  
    );
    add_settings_section(  
        'page_4_section',         // ID used to identify this section and with which to register options  
        'Custom Drop Down Manager',                  // Title to be displayed on the administration page  
        'page_4_section_callback', // Callback used to render the description of the section  
        'my-menu-slug-4'                           // Page on which to add this section of options  
    );
    add_settings_section(  
        'page_5_section',         // ID used to identify this section and with which to register options  
        'Settings',                  // Title to be displayed on the administration page  
        'page_5_section_callback', // Callback used to render the description of the section  
        'my-menu-slug-5'                           // Page on which to add this section of options  
    );

    /* ----------------------------------------------------------------------------- */
    /* Option 1 */
    /* ----------------------------------------------------------------------------- */ 

    add_settings_field (   
        'option_1',                      // ID used to identify the field throughout the theme  
        ' ',                           // The label to the left of the option interface element  
        'option_1_callback',   // The name of the function responsible for rendering the option interface  
        'my-menu-slug-1',                          // The page on which this option will be displayed  
        'page_1_section',         // The name of the section to which this field belongs  
        array(                              // The array of arguments to pass to the callback. In this case, just a description.  
            'This is the description of the option 1',
        )  
    );  
    register_setting(  
        //~ 'my-menu-slug',  
        'setting-group-1',  
        'option_1'  
    );

    /* ----------------------------------------------------------------------------- */
    /* Option 2 */
    /* ----------------------------------------------------------------------------- */     

    add_settings_field (   
        'option_2',  // ID -- ID used to identify the field throughout the theme  
        ' ', // LABEL -- The label to the left of the option interface element  
        'option_2_callback', // CALLBACK FUNCTION -- The name of the function responsible for rendering the option interface  
        'my-menu-slug-2', // MENU PAGE SLUG -- The page on which this option will be displayed  
        'page_2_section', // SECTION ID -- The name of the section to which this field belongs  
        array( // The array of arguments to pass to the callback. In this case, just a description.  
            'This is the description of the option 2', // DESCRIPTION -- The description of the field.
        )  
    );
    register_setting(  
        'setting-group-2',  
        'option_2'  
    );

    /* ----------------------------------------------------------------------------- */
    /* Option 3 */
    /* ----------------------------------------------------------------------------- */     

    add_settings_field (   
        'option_3',  // ID -- ID used to identify the field throughout the theme  
        ' ', // LABEL -- The label to the left of the option interface element  
        'option_3_callback', // CALLBACK FUNCTION -- The name of the function responsible for rendering the option interface  
        'my-menu-slug-3', // MENU PAGE SLUG -- The page on which this option will be displayed  
        'page_3_section', // SECTION ID -- The name of the section to which this field belongs  
        array( // The array of arguments to pass to the callback. In this case, just a description.  
            'This is the description of the option 3', // DESCRIPTION -- The description of the field.
        )  
    );
    register_setting(  
        'setting-group-3',  
        'option_3'  
    );

    /* ----------------------------------------------------------------------------- */
    /* Option 4 */
    /* ----------------------------------------------------------------------------- */  


        add_settings_field (   
        'option_4',  // ID -- ID used to identify the field throughout the theme  
        ' ', // LABEL -- The label to the left of the option interface element  
        'option_4_callback', // CALLBACK FUNCTION -- The name of the function responsible for rendering the option interface  
        'my-menu-slug-4', // MENU PAGE SLUG -- The page on which this option will be displayed  
        'page_4_section', // SECTION ID -- The name of the section to which this field belongs  
        array( // The array of arguments to pass to the callback. In this case, just a description.  
            'This is the description of the option 4', // DESCRIPTION -- The description of the field.
        )  
    );
    register_setting(  
        'setting-group-4',  
        'option_4'  
    );

    /* ----------------------------------------------------------------------------- */
    /* Option 5 */
    /* ----------------------------------------------------------------------------- */  


        add_settings_field (   
        'option_5',  // ID -- ID used to identify the field throughout the theme  
        ' ', // LABEL -- The label to the left of the option interface element  
        'option_5_callback', // CALLBACK FUNCTION -- The name of the function responsible for rendering the option interface  
        'my-menu-slug-5', // MENU PAGE SLUG -- The page on which this option will be displayed  
        'page_5_section', // SECTION ID -- The name of the section to which this field belongs  
        array( // The array of arguments to pass to the callback. In this case, just a description.  
            'This is the description of the option 5', // DESCRIPTION -- The description of the field.
        )  
    );
    register_setting(  
        'setting-group-5',  
        'option_5'  
    );


} // function sandbox_initialize_theme_options
add_action('admin_init', 'sandbox_initialize_theme_options');

/************************************************* FIRST TAB *******************************************/

function page_1_section_callback() {  

 
	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";
	$wpdb->templates = "wcar_templates";
	$wpdb->settings = "wcar_settings";
	
		
	$forms_result = $wpdb->get_results ( "SELECT * FROM $wpdb->forms" );
	$templates_result = $wpdb->get_results ( "SELECT * FROM $wpdb->templates" );

	$settings_results = $wpdb->get_row ( "SELECT * FROM $wpdb->settings where name = 'preview_page'" );

	$preview_page = $settings_results->value;

	//plugin_dir_url( __FILE__ ) . 'css/styles.css';
?>



<div id="form_left_panel" class="form_left_panel" >

<label for="forms_list"><b>Edit or Create a new Form</b></label>

	<p><label>New Form Name</label>
	<input type="text" id="new_form_input" autocomplete="off" size="40">
	</p>
	<p><input type="submit" name="new_form" id="new_form" class="button button-primary" value="New Form"></p>



		  

		  
		   
	       <select name="forms_list" id="forms_list"  multiple="multiple">
	      	
		  
		  	<?php foreach( $forms_result as $value ) { 
		  		
		  		?>

		      <option value="<?php echo $value->id;?>" <?php selected($value->id, $car_form_id_saved_value); ?> > <?php echo $value->form_name; ?></option>
 	         <?php } ?>
			 
			 
		   </select>
	
			<p>

		   <div style="float:left;">
					<input type="submit" name="form_delete" id="form_delete" class="button button-secondary" value="Delete Form">

		   </div>
		   <div id="#state_notification_wrapper"> 
		   		<div id="form_notification" style="float:left;margin-left:15px;margin-top:5px;">
		   			

		   		</div>
			</div>
			</p>
		   

			
   	     
  </div>


  <div id="form_right_panel">



  <div id="formName" class="formName">
	<div>Form Name</div>
  	<input autocomplete="off" type="text" id="formName_field" size="40"></div><br><br>
  

  <div id="form_details" class="right_panel">

  	
  	

	

	

	

<div id="shortcode_wrapper">
	
	</div>
	<div id="shortcode_button_wrapper">
		<input type="button" name="btn_copy" id="btn_copy" class="smallbutton" value="Copy">
		<div id="copied"></div>
	</div>

	<div style="clear:left;">
<label for="forms_list" style="clear:left;"><b>Form Details</b></label><br>

	<div class="form-field" >Brand</div> <div class="form-wide-column"><input autocomplete="off" type="text" id="brand" size="40"></div>

	<div class="form-field">Model</div> <div class="form-wide-column"><input autocomplete="off" type="text" id="model" size="40"></div>

	<div class="form-field">Style</div><div class="form-wide-column"><input autocomplete="off" type="text" id="style" size="40"></div>

<div class="form-field">Language</div><div class="form-wide-column"><input autocomplete="off" type="text" id="lang" size="40"></div>


	<div class="form-field">Fleet</div>
	<div class="form-wide-column">
		<select id="fleet_select">
			<option valuue="0">No</option>
			<option value="1">Yes</option>
		</select>

	</div>
</div>

	<div class="form-field">Form Template</div>
	
	 <select name="template_list" id="template_list" size="8" multiple="multiple">
	      	
		  
		  	<?php foreach( $templates_result as $value ) { 
		  		//$code = $value->brand . "-" . $value->model . "-" . $value->style;

		  		?>

		      <option value="<?php echo $value->id;?>" > <?php echo $value->title; ?></option>
 	         <?php } ?>
			 
			 
		   </select>
			<p>
			<div style="float:left;">
		    <input type="submit" name="form_save" id="form_save" class="button button-primary" value="Save Changes">
			</div>
				<div id="state_notification" style="float:left;margin-left:15px;margin-top:5px;">
	
				</div>
			</p>

  	</div>     
</div> <!--end form rigth panel -->


<div id="form_preview_panel">

<?php 

	$home_url = get_home_url();




?>

 <input type="button" preview_page="<?php echo $preview_page; ?>" name="form_preview" url="<?php echo $home_url?>" form_id="" template_id="" id="form_preview" class="button button-primary" value="Form Preview">

<div id="hidden_form_preview" ></div>
</div>

    <?php  
} 



/************************************************* SECOND TAB *******************************************/

// function page_1_section_callback
function page_2_section_callback() {  
   

global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";
	$wpdb->templates = "wcar_templates";
	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	
		
	$result = $wpdb->get_results ( "SELECT * FROM $wpdb->forms" );
	$templates_result = $wpdb->get_results ( "SELECT * FROM $wpdb->templates" );
	$dropdowns_result = $wpdb->get_results ( "SELECT * FROM $wpdb->dropdown_groups WHERE type=0" );
	#$template_objects = $wpdb->get_results ( "SELECT * FROM $wpdb->dropdown_groups" );

	//plugin_dir_url( __FILE__ ) . 'css/styles.css';
?>
<div id="template_left_panel" class="template_left_panel" >

<label for="templates_list"><b>Edit or Create a new Template</b></label>
<p ><label>Template Name</label> <br>
<input type = "text" id="new_template_input" autocomplete="off" size="40"></p>
	<p ><input type="submit" name="new_template" id="new_template" class="button button-primary" value="New Template"></p>


	




		  

		  
		   
	       <select name="templates_list" id="templates_list"  multiple="multiple">
	      	
		  
		  	<?php foreach( $templates_result as $value ) { 
		  		

		  		?>

		      <option value="<?php echo $value->id;?>" > <?php echo $value->title; ?></option>
 	         <?php } ?>
			 
			 
		   </select>
   	    
			<p>
					<input type="submit" name="template_delete" id="template_delete" class="button button-primary" value="Delete Template">

		   </p>

		   	<div id="state_notification">
	
				</div>

  </div>

  
  <div id="tabs" class="template_editor">
<div id="TemplateNameDiv" >
	<b>Template Name</b>
	<input type="text" id="template_name" autocomplete="off" size="40" value=""></p>
  </div>


 <div id="state_notification_wrapper">
        <div id="form_save_notification"></div>
    </div>
  <div class="save_button_wrapper">
        <input type="button" name="template_save" id="template_save" class="button button-primary" value="Save Changes">
  </div>





<div style="clear:left;">
	<ul>
	    <li>
	    	<a href="#tabs-1">Visual</a></li>


	    <li><a href="#tabs-2">Source Code</a></li>
	  
	  </ul>
</div>
		<div id="tabs-1" >

			  

	  	</div>     

		<div id="tabs-2">

			<textarea id="template_sourcecode" ></textarea>




	  	</div>  

	  
 
	</div>

   
    <div id="images_panel">
<p>
<b>Car Images Gallery</b>
</p>
<div id="images_list">

<?php echo do_shortcode('[carsgallery]');  ?>
</div>



    </div>

    <div id="shortcodes_panel">
    	<br/>
<b>Available Shortcodes:</b>
<br/><br/>
<pre>[headline], [input], [dropdown], [checkbox], [label], [image], [button]</pre>
<pre>[open_form], [close_form], [dynamic_dealers], [dynamic_images]</pre>
Most shortcodes accept the following attributes: <span style="font-family:monospace"> <i> value, class, id, name</i></span>
<br/><br/>
The variable {{carmodel}} can be incorporated in any part of a text value attribute inside any tag.


    </div>

	
<?php



} // End of page_2_section_callback

/************************************************* THIRD TAB *******************************************/

// function page_1_section_callback

function page_3_section_callback() {  
    


?>
<div id="dropdowns_left_panel" class="form_left_panel" >


<div class="carform_first_panel_column">


	<label for="dropdown_list"><b>Edit or Create a new Drop Down Group</b></label>


	<p>
	<div><label>Group Name</label></div>

	
		<input type="text" id="new_drop_down_input" autocomplete="off" size="40">
	
	<p>
	<button name="new_drop_down" id="new_drop_down" class="button button-primary" >New Drop Down Group</button>
	</p>
	

		  
		   
	       <select name="dropdown_list" id="dropdown_list"  multiple="multiple">
	      	
		  
			 
			 
		   </select>


		   <p>
					<input type="button" name="dropdown_delete" id="dropdown_delete" class="button button-secondary" value="Delete Dropdown">

		   </p>


   	     </div>

				 <div class="carform_panel_column">


								 <div id="dropwdowns_middle_panel">

<p>
	<div id="shortcode_wrapper">
	
	</div>
	<div id="shortcode_button_wrapper">
		<input type="button" name="btn_copy" id="btn_copy" class="smallbutton" value="Copy">
		<div id="copied"></div>
	</div>

	<div style="clear:left;">

			<div style="float:left;">
							<b>Group Name</b>
						<input type="text" name="group_name" id="group_name" value="">
			</div>
			<div style="width:60px;float:left;">
				<button name="rename_drop_down" id="rename_drop_down" class="button button-primary" >Rename</button>
			</div>
	
			
			

		<div id="dealer_details">
			

		</div>


	
									
								
			<div style="margin-top:10px;"><b>Items</b></div>


							<div style="float:left;width:360px;">		
									<select id="dropdown_middle_list" size="17" multiple="multiple">
										
									</select>
							

							<div style="float:right;">
								<div id="vertical_buttons_group_1">
									<div class="vertical_arrow_buttons" >
								 	<button id="dropdown_up_button" name="dropdown_up_button" class="button button-secondary">↑</button>
								 	</div>
								 	<div class="vertical_arrow_buttons">
								 	<button id="dropdown_dn_button" name="dropdown_dn_button_1" class="button button-secondary">↓</button>
								 	</div>
								 </div>
							</div>
								

								<p>
								<button name="dropdown_remove" id="dropdown_remove" class="button button-secondary" >Remove Selected</button>
								<button name="dropdown_sort" id="dropdown_sort" class="button button-secondary" >Sort</button>
								<button name="dropdown_save" id="dropdown_save" class="button button-primary" >Save Changes</button>
								
								</p>
	<div id="state_notification">
	
	</div>
						</div>	
</div>
		</div>
				
</div>
  </div>
 
    <div id="dropwdowns_buttons_panel">


	<div id="buttons_group">
		<div class="arrow_buttons" >
	 	
	 	
	 	<button id="dropdown_left_button" name="dropdown_left_button" class="button button-secondary">←</button>
	 </div>
	 <div class="arrow_buttons">
	 	<button id="dropdown_right_button" name="dropdown_right_button" class="button button-secondary">→</button>
	 	
	 	</div>
	</div>
 
  
  </div>

  <div id="dropdowns_right_panel" class="right_panel">

  	
  	

	<label for="dropdown_items"><b>Drop Down Items in Database Table</b></label><br><br>

	

	<div class="form-field">Drop Down Items</div>
	
	 		<select name="dropdown_items" id="dropdown_items" size="17" multiple="multiple">
	
		   </select>

	<div style="margin-top:15px;">
		<form action="" enctype="multipart/form-data" method="post">
	 	<div >
			
			<div style="float:left;width:80px;height:40px;">

		 	<button id="open_csv" name="open_csv" class="button button-primary">Import CSV</button>
		 	<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
		 	<input id="file" type="file" name="file" accept=".csv" style="visibility:hidden;">
		 	
		 	
		 	</div>
		 	<div id="csv_filename" style="float:left;margin-left:35px;margin-top:5px;">
		 		
		 	</div>
		 	
		</div>
	 	

		<div style="clear:left; ">
			
			<div style="float:left;">
				<a href="<?php echo admin_url( 'admin-post.php?action=download_csv' ) ?>">Download CSV </a>
			</div>
			<div>
	 			<div id="csv_notification"></div>
	 			</div>	  
			</div>

		</form>
  	</div>     
		

    <div id="bottom_panel">






    </div>

<?php



} // function page_3_section_callback




/************************************************* FOURTH TAB *******************************************/


function page_4_section_callback() {  
    


?>
<div id="custom_dropdowns_left_panel" class="form_left_panel" >

  <div class="carform_first_panel_column">
		<label for="custom_dropdown_list"><b>Create a new Drop Down Group</b></label>

			
		<p>
	<div><label>Group Name</label></div>
		

			
		<input type="text" id="new_custom_dropdown_input" autocomplete="off">
			
			<p>
				<button name="custom_dropdown_create" id="custom_dropdown_create" class="button button-primary" >Create Custom Dropdown Group</button>
			</p>




		
		  
	       <select name="custom_dropdown_list" id="custom_dropdown_list"  multiple="multiple">
	      	
		
			 
			 
		   </select>
   	    
   	      <p>
				<div style="float:left;width:40px;">
					<input type="button" name="custom_dropdown_copy" id="custom_dropdown_copy" class="button button-secondary" value="Copy">


		   </div>
		   <div id="dropdown_notification_wrapper" style="float:left;">
			   <div id="dropdown_state_notification">
				
				</div>
			</div>
		   <div style="width:40px;float:left;margin-left:10px;">
				<input type="button" name="custom_dropdown_delete" id="custom_dropdown_delete" class="button button-secondary" value="Delete">
			</div>
			
		   </p>
   	  
		</div>

   	  <div class="custom_panel_column">

<p>
	<div id="shortcode_wrapper">
		
	</div>
	<div id="shortcode_button_wrapper">
		<input type="button" name="btn_copy" id="btn_copy" class="smallbutton" value="Copy">
		<div id="copied"></div>
	</div>
	<p style="clear:left;">
		<div style="float:left;">
							<b>Group Name</b>
						<input type="text" name="group_name" id="group_name" value="">
				</div>
		<div>
				<button name="rename_custom_drop_down" id="rename_custom_drop_down" class="button button-primary" >Rename</button>
		</div>
			</p>
		   </p>
						

		<div style="margin-top:10px;"><b>Items</b></div>
		<div style="float:left;height:355px;">
   	     <select id="custom_dropdown_middle_list" size="17" multiple="multiple">
   	     	</select>
   	     </div>	
   	     		<div style="float:left;">


						<div id="vertical_buttons_group">
							<div class="vertical_arrow_buttons" >
						 	
						 	
						 	<button id="custom_dropdown_up_button" name="custom_dropdown_up_button" class="button button-secondary">↑</button>
						 	</div>
						 	<div class="vertical_arrow_buttons">
						 	<button id="custom_dropdown_dn_button" name="custom_dropdown_dn_button" class="button button-secondary">↓</button>
						 	
						 	</div>
						</div>


  				</div>


<div style="">
<button name="custom_dropdown_remove" id="custom_dropdown_remove" class="button button-secondary" >Remove Selected</button>
<button name="custom_dropdown_save" id="custom_dropdown_save" class="button button-primary" >Save Changes</button>
</div>

</div>






    </div>
 

   <div id="custom_dropwdowns_middle_panel">


<div class="form-field">Option value</div><div class="form-wide-column"><input type="text" id="custom_drop_down_input_index" autocomplete="off" size="40"></div>
<div class="form-field">Title</div><div class="form-wide-column"><input type="text" id="custom_drop_down_input_title" autocomplete="off" size="40"></div>

<p class="submit">
<button name="new_custom_drop_down_entry" id="new_custom_drop_down_entry" class="button button-secondary" >Add Entry</button>
<button name="btn_clear" id="btn_clear" class="button button-secondary" >Clear</button>

	<div id="state_notification">
	
	</div>
</p>

  </div>	
   
<div id="dialog" style="border:1px solid #ccc;width:250px;height:250px;" title="Basic dialog">
 
</div>

    <div id="bottom_panel">




<?php



} // function page_1_section_callback


/************************************************* FOURTH TAB *******************************************/


function page_5_section_callback() {  


	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";
	$wpdb->templates = "wcar_templates";
	$wpdb->settings = "wcar_settings";
	

	$settings_results = $wpdb->get_row ( "SELECT * FROM $wpdb->settings where name = 'preview_page'" );

	$preview_page = $settings_results->value;

	$settings_results = $wpdb->get_row ( "SELECT * FROM $wpdb->settings where name = 'ajax_url'" );

	$ajax_url = $settings_results->value;


?>

<div id="settings_left_panel" class="settings_left_panel" >
<div class="carform_first_panel_column">
		<label for="custom_dropdown_list"><b>Settings Variables</b></label>
	<p>
	<div><label><b>Preview Page Id</b></label></div>
		

			
		<input type="text" id="preview_page" autocomplete="off" class="settings_field" value="<?php echo $preview_page; ?>">

			<br><br><div><label><b>Form Submission Ajax URL</b></label></div><br>

            <label>Default: <i>https://news.gocarsolutions.be/wp-admin/admin-ajax.php</i></label><br><br>

		<input type="text" id="ajax_url" autocomplete="off"  class="settings_field" value="<?php echo $ajax_url; ?>">



			<p>
				<button name="save_settings" id="save_settings" class="button button-primary" >Save Settings</button>
			</p>

			<div id="state_notification">
	
			</div>
			
		<p>
</div>
</div>


<?php 

}



/* ----------------------------------------------------------------------------- */
/* Field Callbacks */
/* ----------------------------------------------------------------------------- */ 

function option_1_callback($args) {  
   

    ?>



    
    <p class="description option_1"></p>
    <?php      
} // end sandbox_toggle_header_callback  

function option_2_callback($args) {  
    ?>
   
    <?php      
} // end sandbox_toggle_header_callback  

function option_3_callback($args) {  
    ?>

    
    <?php      
} // end sandbox_toggle_header_callback  

function option_4_callback($args) {  
    ?>

    
    <?php      
} // end sandbox_toggle_header_callback  


function option_5_callback($args) {  
    ?>

    
    <?php      
} // end sandbox_toggle_header_callback  







	
//************************************************ METABOX DATA ******************************************************


function create_new_metabox_context( $post ) {
    
    do_meta_boxes( null, 'custom-metabox-holder', $post );
}
add_action( 'edit_form_after_editor', 'create_new_metabox_context' );

function offerForm_add_custom_box()
{
    $screens = ['post', 'offerForm_cpt'];
    foreach ($screens as $screen) {
        add_meta_box(
            'offerForm_box_id',           // Unique ID
            'Lead Forms',  // Box title
            'offerForm_custom_box_html',  // Content callback, must be of type callable
            'post',
			'custom-metabox-holder' //New context
        );
    }
}

function offerForm_custom_box_html($post)
{
  
	
	$brand = $_POST["brand"];
	$model = $_POST["model"];
	$style = $_POST["style"];


	global $current_user;
	get_currentuserinfo();
	$user = $current_user->ID;
	global $wpdb;
	global $result;
	$courses = array();
	//$wpdb->wp_cars = "{$wpdb->prefix}cars";
	$wpdb->forms = "wcar_forms";
	
	global $car_form_id;
	
	$car_form_id_saved_value = get_post_meta($post->ID, '_car_form_id_', true);
	
	$car_form_id = $car_form_id_saved_value;

	$form_details = $wpdb->get_results ( "SELECT * FROM $wpdb->forms WHERE id = $car_form_id" );



	foreach( $form_details as $value ) {

		$brand_id = $value->brand;
		$model_id = $value->model;
		$style_id = $value->style;
		$lang_id  = $value->lang;
		$fleet_id = $value->fleet;
			
	}
		
	$result = $wpdb->get_results ( "SELECT * FROM $wpdb->forms" );

	$all_brands = $wpdb->get_results ( "SELECT DISTINCT brand FROM $wpdb->forms" );

	$all_models = $wpdb->get_results ( "SELECT DISTINCT model FROM $wpdb->forms WHERE brand = '$brand_id'" );

	$all_styles = $wpdb->get_results ( "SELECT DISTINCT style FROM $wpdb->forms WHERE brand = '$brand_id' AND model='$model_id'" );

	$all_langs = $wpdb->get_results ( "SELECT * FROM $wpdb->forms WHERE brand = '$brand_id' AND model='$model_id'" );




	// GET VALUES OF ALL ENTRIES

	
?>
		
	  <form action="<?php bloginfo('url'); ?>" method="get">

				Select a Form to be placed at the end the Post content <br>
				or to Copy it as a Shortcode as [Form id="<i>form-id</i>"]:
				<br>
				<br>
		  <select name="carforms_list" id="carforms_list">
	      	 <option value="">----- Select a Form -------</option>
		  
		  	<?php foreach( $result as $value ) { 
		  		//$code = $value->brand . "-" . $value->model . "-" . $value->style;

		  		?>
			
		      <option value="<?php echo $value->id;?>" <?php selected($value->id, $car_form_id_saved_value); ?> > <?php echo $value->id . " - " . $value->form_name; ?></option>
 	         <?php } ?>
			 
			 
		   </select>
   	     </form>
		 
<?php

}

add_action( 'add_meta_boxes', 'offerForm_add_custom_box' );


add_action( 'save_post', 'save_offerad_box' );



function save_offerad_box($post_id)
{
	
	if ( !current_user_can( 'edit_post', $post_id ))
	            return $post->ID;
	
	
    update_post_meta($post_id,'_car_form_id_',$_POST['carforms_list']);
	
	//update_post_meta($post_id,'_offer_lang_id_',$_POST['lang_list']);
    
}


function themeslug_query_vars( $qvars ) {
    $qvars[] = 'fid';
    return $qvars;
}
add_filter( 'query_vars', 'themeslug_query_vars' );

function wpa_content_filter( $content ) {



	$form_id = get_query_var('fid'); // for the preview page

	global $post;
	global $wpdb;
	$wpdb->forms = "wcar_forms";
	$wpdb->templates = "wcar_templates";
	$wpdb->settings = "wcar_settings";
	$wpdb->dropdown_groups = "wcar_dropdown_groups";
	global $car_form_id;


	$settings_results = $wpdb->get_row( "SELECT * FROM $wpdb->settings where name='preview_page'");

	$preview_page = $settings_results->value;

	$settings_results = $wpdb->get_row( "SELECT * FROM $wpdb->settings where name='ajax_url'");

	$AJAX_FULL_URL = $settings_results->value;

	if ($AJAX_FULL_URL=='') {
	    $AJAX_FULL_URL = 'https://news.gocarsolutions.be/wp-admin/admin-ajax.php';
	}
	
	$selected_form_id = get_post_meta($post->ID, '_car_form_id_', true);




		if ($post->ID == $preview_page) {

					//$templates_sourcecode = $wpdb->get_row( "SELECT * FROM $wpdb->templates where id=$template_id");
					
					$templates_form_details = $wpdb->get_row( "SELECT * FROM $wpdb->forms f "
						. "INNER JOIN $wpdb->templates t "
						. "ON t.id = f.template_id "
						. "WHERE f.id= $form_id"
						);
							

					$source_code = $templates_form_details->source_code; 
					//$car_model = ucfirst(strtolower($templates_form_details->brand . " " . $templates_form_details->model));
					$brand = $templates_form_details->brand;
					//$form_name = $templates_form_details->form_name;


					$group_results = $wpdb->get_row("SELECT * FROM $wpdb->dropdown_groups WHERE lower(`title`) = lower('". $brand . "') ");

					$group_id = $group_results->id;


					$brand = ucfirst(strtolower($templates_form_details->brand));
					$model = ucfirst(strtolower($templates_form_details->model));
					//$model  = strtolower($templates_form_details->model);
					$model = ucfirst(strtolower($model));

					$car_model = $brand . " " . $model ;

					    $bootstrap_js = '<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.bundle.js"></script>';
	$bootstrap_css = '<link rel="stylesheet" type="text/css" href="maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';

    //$local_validation = '<script>var $ = jQuery.noConflict();$(document).ready(function(){$(function(){$(\'[data-toggle="popover-hover"]\').length&&$(\'[data-toggle="popover-hover"]\').popover({trigger:"hover"})});if($("#leadsform").length){var t=$("#leadsform :input[required]"),e="";t.each(function(){e=""==$(this).val()}),e?$("#btn_submit").prop("disabled",!0):$("#btn_submit").removeAttr("disabled"),t.on("keyup",function(t){""==$(this).val()?$("#btn_submit").prop("disabled",!0):$("#btn_submit").removeAttr("disabled")})}$("#leadsform").submit(function(t){t.preventDefault();var e=$("#leadsform :input, #leadsform input[type=\'text\'],  input[type=checkbox]"),i={};return e.each(function(){"submit"!==$(this).attr("type")&&""!==this.name&&(i[this.name]=$(this).val()),"checkbox"===$(this).attr("type")&&($(this).is(":checked")?i[this.name]="1":i[this.name]="0")}),i=JSON.stringify(i),$.ajax({type:"POST",data:(JSON,{action:"submit_form",values:i}),url:"http://localhost/gocarsolutions/wp-admin/admin-ajax.php",success:function(t){$("#btn_submit").prop("disabled",!0);var e=$("#resultSection").attr("text");$("#resultSection").html(e),$("#resultSection").fadeIn().delay(8e3).fadeOut()}}),!1})});</script>';

    $validation = "<script>
var $ = jQuery.noConflict();
$( document ).ready(function() { 

    $(function () {
        //var selection = $('[data-toggle=\"popover-hover\"]').text();
        if ($('[data-toggle=\"popover-hover\"]').length) {
            $('[data-toggle=\"popover-hover\"]').popover({
                trigger : 'hover'
            });
        }

    });


if ($(\"#leadsform\").length) {
        var inputs = $(\"#leadsform :input[required]\");

        var empty = '';

        inputs.each(function () {
            if ($(this).val() == '') {
                empty = true;
            }
            else {
                empty = false;
            }
        });

        if (empty) {
            $('#btn_submit').prop('disabled', true); //
        } else {
            $('#btn_submit').removeAttr('disabled'); //
        }


        inputs.on(\"keyup\", function(e) {

            var empty = '';

            if ($(this).val() == '') {
                empty = true;
            }
            else {
                empty = false;
            }

            if (empty) {
                $('#btn_submit').prop('disabled', true);
            } else {
                $('#btn_submit').removeAttr('disabled');
            }

        });


    }

    $(\"#leadsform\").submit(function( e ) {
    //$(\"#btn_submit\").submit(function (e) {
            e.preventDefault();




            var inputs = $(\"#leadsform :input, #leadsform input[type='text'],  input[type=checkbox]\");



            var values = {};
            inputs.each(function() {
                if ($(this).attr('type')!=='submit' && this.name!=='') {
                    values[this.name] = $(this).val();
                }
                if ($(this).attr('type')==='checkbox') {
                    if ($(this).is(\":checked\")) {
                        values[this.name] = '1';
                    }
                    else {
                        values[this.name] = '0';
                    }
                }
            });

            values = JSON.stringify(values);


            $.ajax({

                type: 'POST',
                data: JSON,
                url: '$AJAX_FULL_URL' ,
                data: { action: 'submit_form', values: values },
                success: function(response) {

                    //alert(response);
                    $('#btn_submit').prop('disabled', true);
                    var text = $('#resultSection').attr(\"text\");
                    $('#resultSection').html(text);
                    $('#resultSection').fadeIn().delay(8000).fadeOut();




                }
            });

            return false;
        });


});
</script>";

	$sc_render = $sc_render . $bootstrap_js;
	$sc_render = $sc_render . $bootstrap_css;
    $sc_render = $sc_render . $validation;

					$sc_render = $sc_render . '<div id="form_wrapper"><link href="https://s3-eu-west-1.amazonaws.com/itcl/gocar/lead/css/bootstrap.min.css" rel="stylesheet"><div class="form row"><div class="col-md-12">';

					//$sc_render = $sc_render . "<div>" . $car_model . "</div>";

					$source_code = str_replace ( "dynamic_dealers" ,'dynamic_dealers group_id="'.$group_id.'" ', $source_code  ) ;
					$source_code = str_replace ( "dynamic_images" ,'dynamic_images brand="'.$brand.'" ', $source_code  ) ;

					$render_content = do_shortcode($source_code);

					$render_content = str_replace ( "{{carmodel}}" ,$car_model, $render_content  ) ;
					$render_content = str_replace ( "{{form_name}}" ,$form_id, $render_content  ) ;

					$sc_render = $sc_render . $render_content;


					$sc_render = $sc_render . '</div></div></div>';

		}
		else {
			$sc_render='';
		}



		$content = $content . $sc_render;
    
    return $content;
}


add_filter( 'the_content', 'wpa_content_filter', 10 );
