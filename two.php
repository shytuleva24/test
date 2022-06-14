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
        <form action="three.php" method="POST">
            <h1>Гра екстрасенс</h1>
            <p class="title">Спробуй свої можливості</p>
                <?php 
                    session_start();
                    $complicatedPsychic = json_decode($_SESSION['complicatedPsychic']);
                    $disabledNumbers = (isset($_SESSION['disabledNumbers'])) ? json_decode($_SESSION['disabledNumbers']) : [];
                    $password = $complicatedPsychic->password;
                    $number = (isset($_POST['number'])) ? $_POST['number'] : "00 - 00";
                    $loss = 0;
                    // echo $complicatedPsychic->password;
                    // var_dump($disabledNumbers);

                    $numberStart = floor(($complicatedPsychic->password-1)/10)*10+1;
                    $numberEnd = $numberStart + 9;

                
                    if ($complicatedPsychic->totalLoss == 0) {
                        echo "<p class='text'>В тебе дуже гарно виходить, ти вгадав, так тримати!</p>";
                    } else if (count($disabledNumbers) != 0) {
                        echo "<p class='text'>Шкода, але ти не вгадав!</p>";
                    }

                    echo "<p class='text'>Тепер спробуй вгадати саме число. В тебе є лише одна спроба тому добре подумай та обери його зі списку нижче.<br>У тебе все вийде!</p>";
                    echo $complicatedPsychic->password;


                    if (isset($_POST['number']) && $_POST['number'] != "00 - 00") {
                        $number = $_POST['number'];
                        if ($password == $number) {
                            header('Location: result.php');
                            $complicatedPsychic->win++;
                        } else {
                            $loss++;
                            $complicatedPsychic->totalLoss++;
                            array_push($disabledNumbers , $number);
                            echo "<p>Ви не вгадали, спробуйте ще!</p>";
                        }
                    }
                    echo ("<p>");
                    echo ("<select name='number'>");
                    echo ("<option value='0'>Обери число</option>");
                        for($i = $numberStart; $i <= $numberEnd; $i++) {
                            if (in_array($i, $disabledNumbers)) {
                                echo ("<option value='$i' disabled>$i</option>");
                            } 
                            else {
                                echo ("<option value='$i'>$i</option>");
                            }
                        }
                    echo ("</select>");

                $_SESSION["complicatedPsychic"] = json_encode($complicatedPsychic);
                $_SESSION["disabledNumbers"] = json_encode($disabledNumbers);
            ?>
                <input class="btn b" type="submit" name="sub" value="Спробувати"></p>
                <!-- <button class="btn t" type="submit" name="new"><a href="index.php">Нова гра!</a></button> -->
            </form>
        </section>
    </main>
</body>
</html>

