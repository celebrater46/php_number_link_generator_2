<?php

namespace php_number_link_generator\classes;

use php_number_link_generator\modules as modules;

require_once( dirname(__FILE__) . '/../modules/html_common_module.php');

class NumberLink
{
    public $text_sum; // テキストファイルの総数
    public $page_num; // 全部の記事を何ページに分けて表示するか
    public $current_page;
    public $start; // 何番目の記事から表示するか。if($max == 3) 1 == 0, 2 == 3, 3 == 6, 4 == 9, 5 == 12 ...
    public $current_link_page; // 今何番目のリンクページにいるか。if($max_link_num === 5) [1 2 3 4 5] => 1, [6 7 8 9 10] => 2 ...
    public $start_page_num; // [6 7 8 9 10] -> 6

    // [1 2 3 4 5] -> 1
    // [6 7 8 9 10] -> 6
    // [11 12 13 14 15] -> 11
    // [16 17 18 19 20] -> 16

    // $texts == 1ページに何記事表示するか
    // $links == リンクナンバーを1ページにいくつ表示するか
    // $num == テキストファイルの総数
    function __construct($sum){
        $this->text_sum = $sum;
        $this->page_num = ceil($sum / PNLG_MAX_TEXT_NUM); // 全部の記事を何ページに分けて表示するか
        $this->current_page = isset($_GET["page"]) ? $_GET["page"] : 1;
        $this->start = $this->get_start_text_num($this->current_page, PNLG_MAX_TEXT_NUM); // 何番目の記事から表示するか。if($max == 3) 1 == 0, 2 == 3, 3 == 6, 4 == 9, 5 == 12 ...
        $this->current_link_page = ceil($this->current_page / PNLG_MAX_LINK_NUM); // 今何番目のリンクページにいるか。if($max_link_num === 5) [1 2 3 4 5] => 1, [6 7 8 9 10] => 2 ...
        $this->start_page_num = ($this->current_link_page - 1) * PNLG_MAX_LINK_NUM + 1; // [6 7 8 9 10] -> 6
    }

// 何番目の記事から表示するか。if($max == 3) 1 == 0, 2 == 3, 3 == 6, 4 == 9, 5 == 12 ...
    function get_start_text_num($num, $max){
        if($num === null){
            return 0;
        } elseif($num < 2){
            return 0;
        } else {
            return ($num - 1) * $max;
        }
    }

    function get_page_links_html(){
        $html = modules\space_br("<p class='links'>", 1);
        if($this->current_link_page > 1){
            $html .= modules\space_br('<a href="' . PNLG_INDEX_FILE_NAME . '?page=' . ($this->current_link_page - 1) . '">＜＜</a>', 2);
        }
        for($i = $this->start_page_num; $i <= $this->current_link_page * PNLG_MAX_LINK_NUM; $i++){
            if($i <= $this->page_num){
                $html .= modules\space_br('<a href="' . PNLG_INDEX_FILE_NAME . '?page=' . $i . '">' . $i . '</a>', 2);
            }
        }
        if($this->page_num > $this->current_link_page * PNLG_MAX_LINK_NUM){
            $html .= modules\space_br('<a href="' . PNLG_INDEX_FILE_NAME . '?page=' . ($this->current_link_page * PNLG_MAX_LINK_NUM + 1) . '">＞＞</a>', 2);
        }
        $html .= modules\space_br("</p>", 1);
        return $html;
    }
}