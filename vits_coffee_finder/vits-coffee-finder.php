<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vits Coffee Finder</title>
    <link rel="stylesheet" href="/var/www/html/wp-content/plugins/vits_coffee_finder/css/vits-coffee-finder.css">
    <?php include 'questions/questions.php'; ?>
</head>
<body>
    <?php
    $currentQuestion = null;
    if (array_key_exists("currentQuestion", $_SESSION)) {
        if (($_SESSION["currentQuestion"] + 1) < count($questions)) {
            $_SESSION["currentQuestion"] += 1;
            $currentQuestion = $questions[$_SESSION["currentQuestion"]];
        }
    } else {
        $currentQuestion = $questions[0];
        $_SESSION["currentQuestion"] = 0;
    }
    ?>

    <?php if ($currentQuestion == null): ?>
        Zeige Ergebnis
    <?php else: ?>
        <div class="questionText">
            <?php echo htmlspecialchars($currentQuestion->getQuestionText()); ?>
        </div>
        <div class="answerOptions">
            <form action="<?php $_PHP_SELF ?>" method="GET">
                <?php
                $answerOptions = $currentQuestion->getAnswerOptions();
                for ($i = 0; $i < count($answerOptions); ++$i) {
                    echo '<div class="answerOption">';
                    echo '<button type="submit" name="answerOption" value="' . htmlspecialchars($i) . '">';
                    echo htmlspecialchars($answerOptions[$i]);
                    echo '</button>';
                    echo '</div>' . "\n";
                }
                ?>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>