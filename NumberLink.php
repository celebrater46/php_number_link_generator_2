<?php

class NumberLink
{
//    public $file_names; // ファイル名一覧
    public $text_sum; // テキストファイルの総数
//    public $titles;
//    public $texts;
    public $page_num; // 全部の記事を何ページに分けて表示するか
//    public $page_num_per_page =
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
    function __construct($texts, $links, $sum){
//        $this->file_names = glob('files/*.txt'); // ファイル名一覧
//        $this->titles = $this->create_titles($this->file_names);
        $this->text_sum = $sum;
        $this->page_num = ceil($sum / $texts); // 全部の記事を何ページに分けて表示するか
        $this->current_page = isset($_GET["page"]) ? $_GET["page"] : null;
        $this->start = $this->get_start_text_num($this->current_page, $texts); // 何番目の記事から表示するか。if($max == 3) 1 == 0, 2 == 3, 3 == 6, 4 == 9, 5 == 12 ...
        $this->current_link_page = ceil($this->current_page / $links); // 今何番目のリンクページにいるか。if($max_link_num === 5) [1 2 3 4 5] => 1, [6 7 8 9 10] => 2 ...
        $this->start_page_num = ($this->current_link_page - 1) * $links + 1; // [6 7 8 9 10] -> 6
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
}