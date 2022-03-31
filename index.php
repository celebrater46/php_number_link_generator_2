<?php

namespace php_number_link_generator;

//use php_number_link_generator\modules as modules;

//require_once "modules/create_html.php";
require_once "init.php";
require_once "pnlg_get_html.php.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="copyright" content="Enin Fujimi">
    <title><?php echo PNLG_SITE_NAME; ?></title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <?php echo pnlg_get_html(PNLG_MAX_TEXT_NUM); ?>
</body>
</html>
