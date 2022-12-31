<?php
    use App\MineSweeper;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    require '../vendor/autoload.php';

    session_start();

    $tiles = [
        [0,MineSweeper::BOMB,0, 0],
        [MineSweeper::BOMB,0,0 ,0],
        [MineSweeper::BOMB,MineSweeper::BOMB,0, 0],
    ];
    if (isset($_GET['reset'])) {
        unset($_SESSION['minesweeper']);
    }

    $mineSweeper = $_SESSION['minesweeper'] ?? new MineSweeper($tiles);

    if (isset($_GET['x']) && isset($_GET['y'])) {
        try {
            $mineSweeper->play($_GET['x'], $_GET['y']);
        } catch(Exception $exception) {
            $error = $exception->getMessage();
        }
    }

    $_SESSION['minesweeper'] = $mineSweeper;

    $loader = new FilesystemLoader(__DIR__ . '/../src/View');
    $twig = new Environment($loader, []);

    echo $twig->render('index.html.twig', [
        'mineSweeper' => $mineSweeper,
        'error' => $error ?? '',
    ]);
