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
        // reset the state of the plugin and return the first question
        $_SESSION["currentQuestion"] = 0;
        $_SESSION["showResult"] = false;
        return $questions[0];
    }

    function nextQuestion($questions)
    {
        // add the chosen answer option to the array of chosen answers
        $_SESSION["chosenAnswers"][$_SESSION["currentQuestion"]] = $_GET["chosenAnswer"];

        // check if there is a next question or if it's the end of the quiz
        if (($_SESSION["currentQuestion"] + 1) < count($questions)) {

            // if a next question exists, set the marker for the current question correctly and return the question
            $_SESSION["currentQuestion"] += 1;
            return $questions[$_SESSION["currentQuestion"]];

        } else {

            // if it's the end of the quiz, show the result
            $_SESSION["showResult"] = true;
            return null;

        }
    }

    if (!isset($_SESSION["currentQuestion"]) || isset($_POST['retakeQuiz'])) {

        // if the currentQuestion variable is not set, it indicates that the plugin was just started
        // if the retakeQuiz variable is set, the user wants to retake the quiz
        // both cases mean we should call resetSession() to bring the plugin into a proper state
        $currentQuestion = resetSession($questions);

    } else {

        // check to see if the page was refreshed
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

        if ($pageWasRefreshed)
            // if the page was refreshed, do not change the state of the plugin
            $currentQuestion = $questions[$_SESSION["currentQuestion"]];
        else
            // if the page was not refreshed, move on to the next question
            $currentQuestion = nextQuestion($questions);

    }
    ?>
</head>
<body>
    <h4>Coffee Finder</h4>
    <?php if ($_SESSION["showResult"] == true): ?>
        <!-- TODO: Remove this on production -->
        Zeige Ergebnis, Antworten:
        <?php
        for ($i = 0; $i < count($questions); ++$i) {
            echo $_SESSION["chosenAnswers"][$i] . "\n";
        }
        ?>
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
                        echo '<button type="submit" name="chosenAnswer" value="' . htmlspecialchars($i) . '">';
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