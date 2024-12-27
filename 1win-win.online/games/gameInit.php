<?php


class GameInit {
    public $game = false;
    public $games = [];
    public function __construct($game)
    {
        $this->game = $game;
        $this->games = json_decode(file_get_contents(__DIR__.'/data/games.json'), true)['slots'];

    }
    public function findGameUid() {
        for ($i=0; $i< count($this->games); $i++) {
            $g = explode('/', $this->games[$i]['fullDemoUrl'])[count(explode('/', $this->games[$i]['fullDemoUrl']))-1];
            if ($g === $this->game) {
                return  array (
                    'uid' => $this->games[$i]['sltg']['uuid'],
                    'title' =>   $this->games[$i]['title'],
                    'provider' => $this->games[$i]['sltg']['provider'],
                    'key' => $this->game
                );
            }
        }
        return false;
    }
    public function gameInit($data) {
        //print_r ($data);
        $game_uid = $data['uid'];
        //echo $game_uid.'<br>';
        if (!$game_uid) {
            //echo 'error game uid';
            return false;
        }
        if ($data['provider'] === 'Quickspin') {
            require_once __DIR__.'/Slotegrator2.php';
            $s = new Slotegrator2();
            $link = $s->gameInit($game_uid, false, 'ru');
            if ($link) {
                $link = json_decode($link, true);
                if (isset($link['url']))
                    return $link['url'];
            }
            return false;
        }
        require_once __DIR__.'/Slogegrator.php';
        $s = new Slotegrator();
        $link = $s->gameInit($game_uid, false, 'ru');
        if ($link) {
            $link = json_decode($link, true);
            if (isset($link['url']))
                return $link['url'];
        }
        return false;
    }

    public function findGamesDescription($key) {
        //echo $key;
        $data = false;
        if (file_exists(__DIR__.'/data/descriptions.json')) {
            $d = json_decode(file_get_contents(__DIR__.'/data/descriptions.json'), true);
//            echo '<pre>';
//            print_r ($d);
//            echo '</pre>';

                if (isset($d[$key])) {
                    $data = array(
                        'title' =>   $d[$key]['title'],
                        'description' => $d[$key]['description'],
                        'description_blocks' => $d[$key]['footerBlock']
                    );
                    return $data;

            }
        }
        else {
            echo 'file_not_exists';
        }

        return $data;
    }
}