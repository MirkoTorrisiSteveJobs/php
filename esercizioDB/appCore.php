<?php

require_once 'manageDB.php';
$mysqli = openConnection('localhost', 'root', '');

createDb($mysqli, 'DB_esercizio');
useDb($mysqli, 'DB_esercizio');
createTableUsers($mysqli);
createTableProducts($mysqli);
createTableFavourites($mysqli);
createTableAcesses($mysqli);

createProduct($mysqli, "Pentola a pressione", 10000, "https://images-na.ssl-images-amazon.com/images/I/81aj4X6GgTL._AC_SX425_.jpg");
createProduct($mysqli, "Vite", 154, "https://admin.abc.sm/upload/1115/catalogodinamico/prodotti/img_739986_115712Panelvit_chromiting.1.jpg");
createProduct($mysqli, "Calzino", 600, "https://www.albosunderwear.com/wp-content/uploads/2018/04/Calzino-Corto-Donna-Gallo-Fantasia-Pesci-Rosso-AP50512613725.jpg");
createProduct($mysqli, "Matita", 899, "https://www.momarte.com/598-large_default/matita-grafite-triplus-jumbo.jpg");
createProduct($mysqli, "Verruca", 500, "https://it-m.iliveok.com/sites/default/files/styles/term_image_mobile/public/gallery/krasnaya-borodavka.jpg?itok=Sb_z9-OM");
createProduct($mysqli, "Pesce", 1500, "https://c8.alamy.com/compit/bb5ebc/un-pesce-morto-lavato-fino-sulla-sabbia-bb5ebc.jpg");
createProduct($mysqli, "10 euro", 11, "https://image.shutterstock.com/image-photo/ten-euro-bank-note-finance-260nw-1561601836.jpg");
createProduct($mysqli, "Patata da bollire", 9999999, "https://thumbs.dreamstime.com/b/patata-pulita-sbucciata-7372734.jpg");
closeConnection($mysqli);
