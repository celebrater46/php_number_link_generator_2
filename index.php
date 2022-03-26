<?php

namespace php_number_link_generator;

use php_number_link_generator\modules as modules;

require_once "modules/create_html.php";

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
    <?php echo modules\pnlg_get_html(); ?>
</body>
</html>
