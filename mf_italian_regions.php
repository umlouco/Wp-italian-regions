<?php

/*
  Plugin Name: Italian Regions
  Description: Input slelect fileds with Region and Povice that will add the name as an url parameter on change. Usefull for wordpres toolset filters.
  Version: Version 1
  Author: Mario Flores
  Author URI: http://mario-flores.com
  License: WTFPL
 */

add_shortcode('italian_regions', 'mf_regions');

function mf_regions() {
    global $wpdb, $wp;
    $current_region = '';
    $provinces = array();
    $regions = $wpdb->get_results("SELECT * from regioni");
    $current_url = home_url(add_query_arg(array(), $wp->request));
    if (!empty($_GET['mf_region'])) {
        $current_region = sanitize_text_field($_GET['mf_region']);
        $provinces = $wpdb->get_results("SELECT * FROM regioni JOIN province on province.id_regione = regioni.id where regione = '" . $current_region . "'");
    }
    if (!empty($_GET['mf_province'])) {
        $current_province = sanitize_text_field($_GET['mf_province']);
    }

    include(plugin_dir_path(__FILE__) . 'views/select_regions.php');
}

register_activation_hook( __FILE__, 'mf_install_itdb' );

function mf_install_itdb() {
    global $wpdb;
    $wpdb->query("
CREATE TABLE `regioni` (
  `id` int(11) NOT NULL,
  `regione` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;"); 

$wpdb->query("INSERT INTO `regioni` (`id`, `regione`) VALUES
(1, 'Piemonte'),
(2, 'Valle d\'Aosta'),
(3, 'Lombardia'),
(4, 'Trentino-Alto Adige'),
(5, 'Veneto'),
(6, 'Friuli-Venezia Giulia'),
(7, 'Liguria'),
(8, 'Emilia-Romagna'),
(9, 'Toscana'),
(10, 'Umbria'),
(11, 'Marche'),
(12, 'Lazio'),
(13, 'Abruzzo'),
(14, 'Molise'),
(15, 'Campania'),
(16, 'Puglia'),
(17, 'Basilicata'),
(18, 'Calabria'),
(19, 'Sicilia'),
(20, 'Sardegna');");


$wpdb->query("ALTER TABLE `regioni`
  ADD PRIMARY KEY (`id`);");

$wpdb->query("ALTER TABLE `regioni`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;");

$wpdb->query("CREATE TABLE `province` (
  `id` int(11) NOT NULL,
  `id_regione` int(11) NOT NULL,
  `provincia` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;"); 

$wpdb->query("INSERT INTO `province` (`id`, `id_regione`, `provincia`) VALUES
(1, 1, 'Torino'),
(2, 1, 'Vercelli'),
(3, 1, 'Novara'),
(4, 1, 'Cuneo'),
(5, 1, 'Asti'),
(6, 1, 'Alessandria'),
(7, 2, 'Valle d\'Aosta'),
(8, 7, 'Imperia'),
(9, 7, 'Savona'),
(10, 7, 'Genova'),
(11, 7, 'La Spezia'),
(12, 3, 'Varese'),
(13, 3, 'Como'),
(14, 3, 'Sondrio'),
(15, 3, 'Milano'),
(16, 3, 'Bergamo'),
(17, 3, 'Brescia'),
(18, 3, 'Pavia'),
(19, 3, 'Cremona'),
(20, 3, 'Mantova'),
(21, 4, 'Bolzano'),
(22, 4, 'Trento'),
(23, 5, 'Verona'),
(24, 5, 'Vicenza'),
(25, 5, 'Belluno'),
(26, 5, 'Treviso'),
(27, 5, 'Venezia'),
(28, 5, 'Padova'),
(29, 5, 'Rovigo'),
(30, 6, 'Udine'),
(31, 6, 'Gorizia'),
(32, 6, 'Trieste'),
(33, 8, 'Piacenza'),
(34, 8, 'Parma'),
(35, 8, 'Reggio nell\'Emilia'),
(36, 8, 'Modena'),
(37, 8, 'Bologna'),
(38, 8, 'Ferrara'),
(39, 8, 'Ravenna'),
(40, 8, 'Forlì-Cesena'),
(41, 11, 'Pesaro e Urbino'),
(42, 11, 'Ancona'),
(43, 11, 'Macerata'),
(44, 11, 'Ascoli Piceno'),
(45, 9, 'Massa-Carrara'),
(46, 9, 'Lucca'),
(47, 9, 'Pistoia'),
(48, 9, 'Firenze'),
(49, 9, 'Livorno'),
(50, 9, 'Pisa'),
(51, 9, 'Arezzo'),
(52, 9, 'Siena'),
(53, 9, 'Grosseto'),
(54, 10, 'Perugia'),
(55, 10, 'Terni'),
(56, 12, 'Viterbo'),
(57, 12, 'Rieti'),
(58, 12, 'Roma'),
(59, 12, 'Latina'),
(60, 12, 'Frosinone'),
(61, 15, 'Caserta'),
(62, 15, 'Benevento'),
(63, 15, 'Napoli'),
(64, 15, 'Avellino'),
(65, 15, 'Salerno'),
(66, 13, 'L\'Aquila'),
(67, 13, 'Teramo'),
(68, 13, 'Pescara'),
(69, 13, 'Chieti'),
(70, 14, 'Campobasso'),
(71, 16, 'Foggia'),
(72, 16, 'Bari'),
(73, 16, 'Taranto'),
(74, 16, 'Brindisi'),
(75, 16, 'Lecce'),
(76, 17, 'Potenza'),
(77, 17, 'Matera'),
(78, 18, 'Cosenza'),
(79, 18, 'Catanzaro'),
(80, 18, 'Reggio di Calabria'),
(81, 19, 'Trapani'),
(82, 19, 'Palermo'),
(83, 19, 'Messina'),
(84, 19, 'Agrigento'),
(85, 19, 'Caltanissetta'),
(86, 19, 'Enna'),
(87, 19, 'Catania'),
(88, 19, 'Ragusa'),
(89, 19, 'Siracusa'),
(90, 20, 'Sassari'),
(91, 20, 'Nuoro'),
(92, 20, 'Cagliari'),
(93, 6, 'Pordenone'),
(94, 14, 'Isernia'),
(95, 20, 'Oristano'),
(96, 1, 'Biella'),
(97, 3, 'Lecco'),
(98, 3, 'Lodi'),
(99, 8, 'Rimini'),
(100, 9, 'Prato'),
(101, 18, 'Crotone'),
(102, 18, 'Vibo Valentia'),
(103, 1, 'Verbano-Cusio-Ossola'),
(104, 20, 'Olbia-Tempio'),
(105, 20, 'Ogliastra'),
(106, 20, 'Medio Campidano'),
(107, 20, 'Carbonia-Iglesias'),
(108, 3, 'Monza e della Brianza'),
(109, 11, 'Fermo'),
(110, 16, 'Barletta-Andria-Trani');");


$wpdb->query("ALTER TABLE `province`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_regione` (`id_regione`);");


$wpdb->query("ALTER TABLE `province`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;
");
}
