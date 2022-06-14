<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC:wght@400;700&family=Poiret+One&display=swap" rel="stylesheet">
</head>
<body>
    <video autoplay muted loop id="myVideo">
      <source src="https://vod-progressive.akamaized.net/exp=1655209877~acl=%2Fvimeo-prod-skyfire-std-us%2F01%2F1767%2F11%2F283838731%2F1067680830.mp4~hmac=f5ed908975ac5e35c73a18aeba31546a0df30da7e477fbeb652c2d174093157b/vimeo-prod-skyfire-std-us/01/1767/11/283838731/1067680830.mp4?filename=Cosmos+-+17692.mp4" type="video/mp4">
    </video>
    <main>
        <section>
            <form action="index.php" method="POST">
                <h1>Гра екстрасенс</h1>
                <p class="title">Спробуй свої можливості</p>
                <p class="text">Вгадай діапазон, в якому знакодиться загадане комп'ютером число. Для цього лише потрібно обрати його з випадаючого списку нижче. <br>У тебе все вийде!</p>
                <?php
                    session_start();
                    if (isset($_POST['new'])) {
                        session_destroy();
                        unset($complicatedPsychic->password);
                        header("refresh: 0;");
                    }
                    class PsychicData {
                        public $password = 0;
                        public $disabledNumbers = [];
                        public $win = 0;
                        public $totalLoss = 0;
                    }

                    $complicatedPsychic = (isset($_SESSION["complicatedPsychic"])) ? json_decode($_SESSION["complicatedPsychic"]) : new PsychicData();
                    $disabledNumbers = (isset($_SESSION["disabledNumbers"])) ? json_decode($_SESSION["disabledNumbers"]) : [];
            
                    if ($complicatedPsychic->password != 0) {
                        $password = $complicatedPsychic->password;
                    } else {
                        $password = rand(1, 100);
                        $complicatedPsychic->password = $password;
                    }

                    echo $complicatedPsychic->password;
                    // echo "<h2>$password</h2>";
                    if (isset($_POST['number'])) {
                            $number = $_POST['number'];
                            explode(" - ", $number);
                            $start = explode(" - ", $number)[0];
                            $end = explode(" - ", $number)[1];
                            if ($password >= $start && $password <= $end) {
                                $complicatedPsychic->win++;
                                header('Location: two.php');
                            } else {
                                $complicatedPsychic->totalLoss++;
                                array_push($disabledNumbers , $number);
                                echo "<p>Ви не вгадали, спробуйте ще!</p>";
                                if ($complicatedPsychic->totalLoss == 3) {
                                    header('Location: two.php');
                                }
            
                            }
                            // echo $complicatedPsychic->totalLoss;
                            // echo $complicatedPsychic->win;
                            $complicatedPsychic->disabledNumbers = $disabledNumbers;
                            // var_dump($complicatedPsychic->disabledNumbers);
                        }
                        echo ("<p>");
                        echo ("<select class='select' name='number'>");
                            for($i = 0; $i <= 99; $i+=10) {
                                $start = $i + 1;
                                $end = $i + 10;
                                $value = $start ." - ". $end;
                                if (in_array($value, $disabledNumbers)) {
                                    echo ("<option value='$value' disabled>$value</option>");
                                }
                                else {
                                    echo ("<option value='$value'>$value</option>");
                                }
                            }
                        echo ("</select>");

                    $_SESSION["complicatedPsychic"] = json_encode($complicatedPsychic);
                    $_SESSION["disabledNumbers"] = json_encode($disabledNumbers);
                ?>
                <input class="btn b" type="submit" name="sub" value="Спробувати"></p>
                <button class="btn t" type="submit" name="new"><a href="index.php">Нова гра!</a></button>
            </form>
        </section>
    </main>
</body>
</html>