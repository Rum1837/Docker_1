<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Текст</title>
    <link rel="stylesheet" type="text/css" href="css/index.css" />
</head>
<body>
    <form method="GET" action="index.php" accept-charset="UTF-8">
        <p><input type='text' name='city' <?= isset($_GET['clearButton']) ? '' : (isset($_GET['vivod']) ? $_SESSION['new'] : '') ?> " /></p>
        <input type="Submit" name='Vvod' value="Clic_me" />
        <input type="submit" name="clearButton" value="Очистить" />
    </form>
    <?php
    $Vvod1 = $_GET['city'];
    if (isset($_GET['clearButton']))
    {
        session_destroy();
    }
    if (isset($_GET['city']))
    {
        if (preg_match('/^[A-Za-zА-Яа-яЁё\s]+$/', $Vvod1))
        {
            if (!isset($_SESSION['mass']))
            {
                $_SESSION['mass'] = array();
            }
            if (!isset($_SESSION['new']))
            {
                $_SESSION['new'] = $Vvod1;
                    $_SESSION['new'] = mb_convert_case($_SESSION['new'], MB_CASE_TITLE, 'UTF-8');                                          //  увеличение регистра
                echo "<p>".$_SESSION['new']."</p>";
                $_SESSION['mass'][] = $Vvod1;
                                                         // уменьшение  регистра
            }
            else
            {
                if (mb_substr($Vvod1, 0, 1, 'UTF-8') == mb_substr($_SESSION['new'], -1, 1, 'UTF-8'))
                {
                    if (!in_array($Vvod1, $_SESSION['mass']))
                    {
                        $_SESSION['new'] = $Vvod1;
                            $_SESSION['new'] = mb_convert_case($_SESSION['new'], MB_CASE_TITLE, 'UTF-8');                                          //увеличение регистра
                        echo "<p>Правильное слово - " . $_SESSION['new']."</p>";
                                                                   // уменьшение регистра
                        $_SESSION['mass'][] = $Vvod1;
                    }
                    else
                    {
                            $Vvod1 = mb_convert_case($Vvod1, MB_CASE_TITLE, 'UTF-8');                                          // увеличение регистра
                        echo "<p>Это слово уже было введено - " . $Vvod1 . "</p>";
                                                                    // уменьшение регистра
                    }
                } else
                {
                        $Vvod1 = mb_convert_case($Vvod1, MB_CASE_TITLE, 'UTF-8');                                               // увеличение регистра
                    echo "<p>Ошибка - " . $Vvod1 . "</p>";
                                                                    // уменьшение регистра

                }
            }
            foreach ($_SESSION['mass'] as $word)
            {
                $word = mb_convert_case($word, MB_CASE_TITLE, 'UTF-8');                                          // увеличение регистра
                echo"<p>". $word."</p>";
            }
        }
        else
        {
            echo "ни че я тебе не покажу!";
        }
    }
    ?>
</body>
</html>
