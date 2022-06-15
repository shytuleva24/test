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
        <source src="https://vod-progressive.akamaized.net/exp=1655302142~acl=%2Fvimeo-prod-skyfire-std-us%2F01%2F1767%2F11%2F283838731%2F1067680830.mp4~hmac=ca8257d179e93c83ff55057592ad38e058229c9781f2c30b4cac630f5d43ab2d/vimeo-prod-skyfire-std-us/01/1767/11/283838731/1067680830.mp4?filename=Cosmos+-+17692.mp4" type="video/mp4">
    </video>
    <main>
        <section>
            <form action="index.php" method="POST">
                <h1>Гра екстрасенс</h1>
                <p class="title">Спробуй свої можливості</p>
                <?php 
                    session_start();
                    if (isset($_POST['new'])) {
                        unset($_SESSION["complicatedPsychic"]);
                        unset($complicatedPsychic->password);
                        unset($disabledNumbers);
                        session_unset();
                        header('Location: index.php');
                    }

                    $complicatedPsychic = json_decode($_SESSION["complicatedPsychic"]);
                    $disabledNumbers = (isset($_SESSION["disabledNumbers"])) ? json_decode($_SESSION["disabledNumbers"]) : [];
                    $password = "".$complicatedPsychic->password;
                    if (isset($_POST['number'])) {
                        $number = $_POST['number']; 
                    } else {
                        $number = 0;
                    } 
                    // var_dump($disabledNumbers);

                    if (($number == $complicatedPsychic->password && $complicatedPsychic->totalLoss < 2) || $complicatedPsychic->totalLoss == 0) {
                        echo "<p class='text'>З тебе вийде чудовий екстрасенс!</p>";
                    } else if ($number == $complicatedPsychic->password && $complicatedPsychic->totalLoss < 7) {
                        echo "<p class='text'>Eкстрасенсорні здібності у тебе на мінімумі!</p>";
                    } else if ($complicatedPsychic->win == 0 && $complicatedPsychic->totalLoss < 7){
                        echo "<p class='text'>Ти не вгадав, задумайся над чимось іншим!</p>";
                    } else {
                        echo "<p class='text'>З тебе вийде такий собі екстрасенс!</p>";
                    }
                    
                    // var_dump ($disabledNumbers);
                    // echo "<br>$complicatedPsychic->win<br>";
                    // echo "$complicatedPsychic->totalLoss<br>";
                    // echo $complicatedPsychic->password;

                    $_SESSION["complicatedPsychic"] = json_encode($complicatedPsychic);
                    $_SESSION["disabledNumbers"] = json_encode($disabledNumbers);
                ?>
            <button class="btn t" type="submit" name="new">Нова гра!</button></p>
        </form>

        </section>
    </main>
</body>
</html>




