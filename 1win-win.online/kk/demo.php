<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
$qs = false;
$gameName = false;
$data = false; //массив с названием ключем и uid
$iframeLink = false;
$pageTitle = "";
$pageDescription = "";
$descriptionBlocks = "";

if (isset($_SERVER['REQUEST_URI'])) {
    $qs = $_SERVER['REQUEST_URI'];
//    echo $qs;
//    return;
    if (!$qs) {
        header('location:404');
    }
    if (!count(explode('/', $_SERVER['REQUEST_URI']))) {
        header('location:404');
    }
    $gameName = explode('/', $_SERVER['REQUEST_URI'])[count(explode('/', $_SERVER['REQUEST_URI'])) - 1];
//    echo $gameName;
//    return;
    if (!$gameName or !strlen($gameName)) {
        header('location:404');
    }
    //    echo 'gameNmae:'. $gameName;
    //    echo '<br>';
    require_once __DIR__ . '/../games/gameInit.php';
    $gameInit = new GameInit($gameName);
    //print_r ($gameInit);
    $data = $gameInit->findGameUid();

    if (!$data) {
        header('location:404');
    }
    //    echo '<pre>';
    //    print_r ($data);
    //    echo '</pre>';
    $iframeLink = $gameInit->gameInit($data);
    if (!$iframeLink) {
        header('location:404');
    }
    //print_r ($data);
    $findData = $gameInit->findGamesDescription($data['key']);
    //print_r ($findData);
    if ($findData) {
        $pageTitle =  $findData['title'];
        $pageDescription = $findData['description'];
        $descriptionBlocks = $findData['description_blocks'];
    }
    // else {
    //     echo 'description not found';
    // }

    // echo $iframeLink;
}

require_once __DIR__ . '/head.php';
echo head($pageTitle, $pageDescription);
?>

<body>

    <div class="header_wrap">
        <?php require_once __DIR__ . '/header.php'; ?>
    </div>

    <section class="content">
        <div class="gamePlayWrap">
            <h2><?php echo $pageTitle; ?></h2>
            <div id="iFrame" class="gameFrame" style="min-width:80%; height: 100%; min-height: 300px; max-height: 500px; position: relative">
                <iframe style="height: 100%; width: 100%; display: block; position: relative;" src=<?php echo $iframeLink ?>></iframe>
            </div>
            <div class="gameDescription"><?php echo $descriptionBlocks; ?> </div>
        </div>
        
    </section>

    <?php include __DIR__ . '/footer.php'; ?>
</body>