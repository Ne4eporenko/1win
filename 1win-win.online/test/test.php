<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

function f()
{
    $f = json_decode(file_get_contents(__DIR__ . '/../games/data/games.json'), true)['slots'];
    $win = array();
    $j = 0;
    $count = 0;
    for ($i = 0; $i < count($f); $i++) {
        if ($f[$i]['sltg']['provider'] === 'Greentube') {
            if ($count >= 300)
                break;
            array_push($win, $f[$i]);
            $count++;
        }
    }
    //    echo '<pre>';
    //    print_r ($win);
    //    echo '</pre>';

    return $win;
}
function blocks($lang)
{
    $w = f();
    $demoPlay = 'Демо';
    $play = 'ИГРАТЬ';
    if ($lang === 'ru') {
        $demoPlay = 'Демо';
        $play = 'ИГРАТЬ';
    }
    if ($lang === 'kz') {
        $demoPlay = 'Демо';
        $play = 'Ойнау';
    }
    if ($lang === 'az') {
        $demoPlay = 'Demo';
        $play = 'Oynamaq';
    }
    for ($i = 0; $i < count($w); $i++) {
        $ps = explode('.', $w[$i]['path'])[0] . '.webp';
        $title = $w[$i]['title'];
        $src = '/images/games_images/' . $ps;
        $imgae = $w[$i]['sltg']['image'];
        $url = $w[$i]['fullDemoUrl'];
        $uid = $w[$i]['sltg']['uuid'];
        $shortUrl = explode('/', $url)[count(explode('/', $url)) - 1];
        echo "<div class=\"game\">
                    <div>
                        <div class=\"game_hover\">
                        <a href=\"/$lang/demo/$shortUrl\" class=\"button_demo_txt\"><button class=\"btn_demo\">$demoPlay</button></a>
                        <a href=$shortUrl class=\"button_game_txt\"><button class=\"btn_play\">$play</button></a>
                        </div>
                        <img src=$src alt=\"$title\"/>
                    </div>
                    <h5>$title</h5>
                </div>";
    }





    // echo "<div class=\"popular_games_block\" bis_skin_checked=\"1\">
    //      <div class=\"hover\" bis_skin_checked=\"1\">
    //      <div class=\"button_hover\" bis_skin_checked=\"1\">
    //      <div class=\"button_demo\" bis_skin_checked=\"1\"><a href=\"/$lang/demo/$shortUrl\" class=\"button_demo_txt\">$demoPlay</a></div>
    //      <div class=\"button\" bis_skin_checked=\"1\"><a href=$shortUrl class=\"button_game_txt\">$play</a></div>
    //  </div>
    //  <img src=$src  alt=\"$title\" >
    //  </div>
    // <h3 class=\"title\">$title</h3>
    // </div>";

    //        echo "<div class=\"block_game\"
    //                    style=\"background-image: url($src)\" alt =\"$title\">
    //                    <div class=\"block_game_inner\"><p class=\"gameTitleSmall\">$title</p></div>
    //                    <div class=\"gamesButtons\">
    //                    <a href=\"/play?$shortUrl\" class=\"btn btnBlue btnBestGame\">Играть</a>
    //                    <a href=\"/$lang/demo/?gameId=$uid\" class=\"btn btnDemo\">Демо</a>
    //                    </div>
    //              </div>";
}

blocks("ru");
