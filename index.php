<?php

$max = 5; // 1ページに表示するテキストの最大数
$max_link_num = 5; // 1ページに貼る数字リンクの最大数

$file_names = glob('files/*.txt'); // ファイル名一覧
$titles = create_titles($file_names);
$texts = get_texts($file_names);
$page_num = ceil(count($file_names) / $max); // 全部の記事を何ページに分けて表示するか
//$page_num_per_page =
$current_page = isset($_GET["page"]) ? $_GET["page"] : null;
$start = get_start_text_num($current_page, $max); // 何番目の記事から表示するか。if($max == 3) 1 == 0, 2 == 3, 3 == 6, 4 == 9, 5 == 12 ...
$current_link_page = ceil($current_page / $max_link_num); // 今何番目のリンクページにいるか。if($max_link_num === 5) [1 2 3 4 5] => 1, [6 7 8 9 10] => 2 ...
$start_page_num = ($current_link_page - 1) * $max_link_num + 1; // [6 7 8 9 10] -> 6

// [1 2 3 4 5] -> 1
// [6 7 8 9 10] -> 6
// [11 12 13 14 15] -> 11
// [16 17 18 19 20] -> 16

function create_titles($names){
//    $num = glob(("files/*.txt")); // txt の数を数える
    $array = [];
    for($i = 0; $i < count($names); $i++){
        array_push($array, "sample title " . ($i + 1));
    }
    return $array;
}

function get_texts($names){
    $texts = [];
    for ($i = 0; $i < count($names); $i++){
        array_push($texts, file($names[$i]));
    }
    return $texts;
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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="copyright" content="Enin Fujimi">
    <title>PHP Number Link Generator</title>
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>
<body>
    <p><?php echo "page_num: " . $page_num ; ?></p>
    <p><?php echo "current_link_page: " . $current_link_page ; ?></p>
    <p><?php echo "start_page_num: " . $start_page_num ; ?></p>

    <h1>PHP Number Link Generator</h1>
    <?php for ($i = $start; $i < $start + $max; $i++) : ?>
        <?php if($i < count($file_names)) : ?>
            <hr>
            <h2><?php echo $titles[$i]; ?></h2>
            <div>
                <?php foreach ($texts[$i] as $line) : ?>
                    <p><?php echo $line; ?></p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    <?php endfor; ?>

    <p class="links">
        <?php if($current_link_page > 1) : ?>
            <a href="index.php?page=<?php echo ($current_link_page - 1) * $max_link_num; ?>">
                <<
            </a>
        <?php endif; ?>

        <?php for($i = $start_page_num; $i <= $current_link_page * $max_link_num; $i++) : ?>
            <?php if($i <= $page_num) : ?>
                <a href="index.php?page=<?php echo $i; ?>">
                    <?php echo $i; ?>
                </a>
            <?php endif; ?>
        <?php endfor; ?>

        <?php if($page_num > $current_link_page * $max_link_num) : ?>
            <a href="index.php?page=<?php echo $current_link_page * $max_link_num + 1; ?>">
                >>
            </a>
        <?php endif; ?>
    </p>
</body>
</html>
