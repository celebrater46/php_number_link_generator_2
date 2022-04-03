<?php

namespace php_number_link_generator;

require_once dirname(__FILE__) . '/../fcm_init.php';

define('PNLG_SITE_NAME', "PHP Number Link Generator");
define('PNLG_INDEX_FILE_NAME', "index.php");
define('PNLG_MAX_TEXT_NUM', 4); // 1ページに表示するテキストの最大数
define('PNLG_MAX_LINK_NUM', 5); // 1ページに貼る数字リンクの最大数
define('PNLG_HCM_PATH', FCM_HCM); // html_common_module.php
