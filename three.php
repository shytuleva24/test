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
        <source src="https://vod-progressive.akamaized.net/exp=1655233849~acl=%2Fvimeo-prod-skyfire-std-us%2F01%2F1767%2F11%2F283838731%2F1067680830.mp4~hmac=348fdb7ed1d29eafbf539644388b24bb5be615d8e9a8330c6b1776aedeb62b10/vimeo-prod-skyfire-std-us/01/1767/11/283838731/1067680830.mp4?filename=Cosmos+-+17692.mp4" type="video/mp4">
    </video>
    <main>
        <section>
            <form action="four.php" method="POST">                
            <h1>Гра екстрасенс</h1>
            <p class="title">Спробуй свої можливості</p>
            <p class="text">Нажаль ти знов не вгадав, та не переймайся. Ми зменшили діапазон, спробуй тепер вгадати.<br>У тебе все вийде!</p>
            <?php 
                session_start();
                $complicatedPsychic = json_decode($_SESSION["complicatedPsychic"]);
                $disabledNumbers = (isset($_SESSION["disabledNumbers"])) ? json_decode($_SESSION["disabledNumbers"]) : [];
                $password = "".$complicatedPsychic->password;
                $number = (isset($_POST['number'])) ? $_POST['number'] : 0;
                $loss = 0;
                // var_dump($disabledNumbers);
                echo $complicatedPsychic->totalLoss;

                if ($password[1] < 6) {
                    $numberStart = floor(($complicatedPsychic->password-1)/10)*10+1;
                } else {
                    $numberStart = floor(($complicatedPsychic->password-1)/10)*10+6;
                }
                $numberEnd = $numberStart + 4;
                echo $complicatedPsychic->password;
                echo ("<p>");
                echo ("<select name='number'>");
                echo ("<option value='0'>Обери число</option>");

                    for($i = $numberStart; $i <= $numberEnd; $i++) {
                        if (in_array($i, $disabledNumbers)) {
                            echo ("<option value='$i' disabled>$i</option>");
                            $numberMemorization = $i;
                        } 
                        else {
                            echo ("<option value='$i'>$i</option>");
                            $numberMemorization = $i;
                        }
                    }
                echo ("</select>");
                echo "<input class='btn b' type='submit' name='sub' value='Спробувати'></p>";
                $numberMemorization = 0;
                if (isset($_POST['number'])) {
                    $number = $_POST['number'];
                    if ($password == $number) {
                        header('Location: result.php');
                        $complicatedPsychic->win++;
                    } else {
                        $complicatedPsychic->totalLoss++;
                        $complicatedPsychic->number = $number;
                        $loss++;
                        array_push($disabledNumbers , $number);
                    }
                }
                $_SESSION["complicatedPsychic"] = json_encode($complicatedPsychic);
                $_SESSION["disabledNumbers"] = json_encode($disabledNumbers);
            ?>
            <input type="hidden" name="number" value="<?php echo $number; ?>">
            <input type="hidden" name="number" value="<?php echo $numberMemorization; ?>">
        </form>
        </section>
    </main>
</body>
</html>

