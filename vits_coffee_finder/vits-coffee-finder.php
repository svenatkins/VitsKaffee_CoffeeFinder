<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vits Coffee Finder</title>
    <?php include 'questions/questions.php'; ?>
    <style>
        <?php include 'css/vits-coffee-finder.css'; ?>
    </style>
    <?php
    $currentQuestion = null;

    function resetSession($questions)
    {
        $_SESSION["currentQuestion"] = 0;
        $_SESSION["showResult"] = false;
        return $questions[0];
    }

    function nextQuestion($questions)
    {
        // TODO Logic for saving answers should be somewhere in here
        if (($_SESSION["currentQuestion"] + 1) < count($questions)) {
            $_SESSION["currentQuestion"] += 1;
            return $questions[$_SESSION["currentQuestion"]];
        } else {
            $_SESSION["showResult"] = true;
            return null;
        }
    }

    if (isset($_POST['retakeQuiz'])) {
        $currentQuestion = resetSession($questions);
    } else if ($_SESSION["showResult"] == false) {
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';
        if ($pageWasRefreshed)
            $currentQuestion = $questions[$_SESSION["currentQuestion"]];
        else
            $currentQuestion = nextQuestion($questions);
    }
    ?>
</head>
<body>
    <h4>Coffee Finder</h4>
    <?php if ($_SESSION["showResult"] == true): ?>
        <!-- TODO: Remove this on production -->
        Zeige Ergebnis
        <form method="POST">
            <button type="submit" name="retakeQuiz">Retake Quiz</button>
        </form>
    <?php else: ?>
        <div class="questionText">
            <?php echo htmlspecialchars($currentQuestion->getQuestionText()); ?>
        </div>
        <div class="form">
            <form action="<?php $_PHP_SELF ?>" method="GET">
                <div class="answerOptions">
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
                </div>
            </form>
        </div>
    <?php endif; ?>
</body>
</html>