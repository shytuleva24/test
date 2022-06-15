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
            <form action="result.php" method="POST">                
                <h1>Гра екстрасенс</h1>
                <p class="title">Спробуй свої можливості</p>
                <p class="text">Нажаль ти не вгадав, та не переймайся. Ми зменшили діапазон, спробуй тепер вгадати.<br>У тебе все вийде!</p>
                    <?php 
                        session_start();

                        $complicatedPsychic = json_decode($_SESSION["complicatedPsychic"]);
                        $disabledNumbers = (isset($_SESSION["disabledNumbers"])) ? json_decode($_SESSION["disabledNumbers"]) : [];
                        $password = "".$complicatedPsychic->password;
                        // $loss = 0;

                        // echo $complicatedPsychic->password;
                        if ($password[1] < 6) {
                            $numberStart = floor(($complicatedPsychic->password-1)/10)*10+1;
                        } else {
                            $numberStart = floor(($complicatedPsychic->password-1)/10)*10+6;
                        }
                        $numberEnd = $numberStart + 4;
                        // var_dump($disabledNumbers);

                        if (isset($_POST['number'])) {
                            $number = $_POST['number'];                            
                            if ($complicatedPsychic->password != $number) {
                                array_push($disabledNumbers, $number);
                                if ($complicatedPsychic->password > $number) {
                                    echo "<p class='text'>Загадане число більше від числа обраного вами!</p>";
                                } else if ($complicatedPsychic->password < $number) {
                                    echo "<p class='text'>Загадане число менше від числа обраного вами!</p>";
                                }
                                // $loss++;
                                $complicatedPsychic->totalLoss++;
                            } else {
                                echo "<p>WIN</p>";
                                $complicatedPsychic->win++;
                            }
                        }
                        echo ("<p>");
                        echo ("<select name='number'>");
                        echo ("<option value='0'>Обери число</option>");
                            for($i = $numberStart; $i <= $numberEnd; $i++) {
                                if (in_array($i, $disabledNumbers)) {
                                    echo ("<option value='$i' disabled>$i</option>");
                                } else {
                                    echo ("<option value='$i'>$i</option>");
                                }
                            }
                        echo ("</select>");
                        echo "<input class='btn b' type='submit' name='sub' value='Спробувати'></p>";
                        $_SESSION["complicatedPsychic"] = json_encode($complicatedPsychic);
                        $_SESSION["disabledNumbers"] = json_encode($disabledNumbers);
                    ?>
            </form>
        </section>
    </main>
</body>
</html>




