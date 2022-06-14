<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Сomplicated psychic</title>
</head>
<body>
    <main>
        <form action="
            <?php 
                session_start();
                $totalLoss = (isset($_POST['totalLoss'])) ? $_POST['totalLoss'] : 0;
                $win = (isset($_POST['win'])) ? $_POST['win'] : 0;
                if ($totalLoss == 1 || $win == 1) {
                    echo 'two.php';
                } else {
                    echo 'index.php';
                } 
            ?>" 
            method="POST">
            <h1>Гра екстрасенс (ускладненна версія)!</h1>
            <h2>Спробуй свої можливості</h2>
            <p class="text">Вгадай число яке загадав комп'ютер! Для цього тобі потрібно лише обрати число з випадаючого списку.</p>

            <?php 
                if (isset($_POST['new'])) {
                    session_destroy();
                    header("refresh: 0;");
                }

                class Foo {
                    public $password = NULL;
                    public $disabledNumbers = NULL;
                    public $win = 0;
                    public $totalLoss = 0;
                }
                $complicatedPsychic = (isset($_SESSION["complicatedPsychic"])) ? json_decode($_SESSION["complicatedPsychic"]) : new Foo();
                $disabledNumbers = (isset($_SESSION["disabledNumbers"])) ? json_decode($_SESSION["disabledNumbers"]) : [];
                
                echo $complicatedPsychic -> $win;

                if (isset($complicatedPsychic["password"])) {
                    $password = $complicatedPsychic['password'];
                } else {
                    $password = rand(1, 100);
                }


                // $complicatedPsychic = ["password" => rand(1, 100), "win" => 0, "totalLoss" => 0];
                // $password = (isset($_SESSION["complicatedPsychic"])) ? $complicatedPsychic['pass'] : 0;
                // echo "<p> totalLoss $totalLoss</p>";
                
                echo "<h2>$password</h2>";
                if ($totalLoss < 2) {
                    if (isset($_POST['number'])) {
                        $number = $_POST['number'];
                        $start = $number;
                        $end = $start + 9;
                        // explode(" - ", $number);
                        // $start = explode(" - ", $number)[0];
                        // $end = explode(" - ", $number)[1];
                        if ($password >= $start && $password <= $end) {
                            echo "<p>WIN</p>";
                            $win = 1;
                            echo "win $win <br>";
                            header('Location: two.php');
                            // array_push($complicatedPsychic, $number);
                        } else {
                            $totalLoss++;
                            array_push($complicatedPsychic, $number);
                            echo "<p>totalLoss</p>";
                        }
                    }
                    var_dump ($complicatedPsychic);

                    echo ("<p>");
                    echo ("<select name='number'>");
                        for($i = 0; $i <= 99; $i+=10) {
                            $start = $i + 1;
                            $end = $i + 10;
                            $value = $start ." - ". $end;
                            if (in_array($value, $complicatedPsychic)) {
                                echo ("<option value='$value' disabled>$value</option>");
                            } 
                            else {
                                echo ("<option value='$value'>$value</option>");
                            }
                        }
                    echo ("</select>");
                    echo ("</p>"); 

                    foreach($complicatedPsychic as $name => $value) {
                        echo "$name : $value<br />";
                    }

                }
                array_push($complicatedPsychic, $disabledNambers);
                $_SESSION["complicatedPsychic"] = json_encode($complicatedPsychic);
            ?>
            <input class="btn b" type="submit" name="sub" value="Спробувати"></p>
            <button class="btn t" type="submit" name="new">Нова гра!</button>
        </form>
    </main>
</body>
</html>