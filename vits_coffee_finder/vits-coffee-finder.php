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
    $vitsCfCurrentQuestion = null;

    function vits_cf_reset_session($vitsCfQuestions)
    {
        // reset the state of the plugin and return the first question
        $_SESSION["vitsCfCurrentQuestion"] = 0;
        $_SESSION["showResult"] = false;
        $_SESSION["level"] = 0;
        return $vitsCfQuestions[0];
    }

    function vits_cf_next_question($vitsCfQuestions)
    {
        // add the chosen answer option to the array of chosen answers
        $_SESSION["chosenAnswers"][$_SESSION["vitsCfCurrentQuestion"]] = $_GET["chosenAnswer"];

        // on the first question, set the level
        if ($_SESSION["vitsCfCurrentQuestion"] == 0) {
            $_SESSION["level"] = $_GET["chosenAnswer"];
        }

        // check if there is a next question or if it's the end of the quiz
        if (($_SESSION["vitsCfCurrentQuestion"] + 1) < count($vitsCfQuestions)) {

            // if a next question exists, set the marker for the current question correctly and return the question
            $_SESSION["vitsCfCurrentQuestion"] += 1;

            // check if the next question is available for the current level, if not, move to the next question
            if (!in_array($_SESSION["level"], $vitsCfQuestions[$_SESSION["vitsCfCurrentQuestion"]]->getLevels()))
                vits_cf_next_question($vitsCfQuestions);

            return $vitsCfQuestions[$_SESSION["vitsCfCurrentQuestion"]];

        } else {

            // if it's the end of the quiz, show the result
            $_SESSION["showResult"] = true;
            return null;

        }
    }

    if (!isset($_SESSION["vitsCfCurrentQuestion"]) || isset($_POST['retakeQuiz'])) {

        // if the vitsCfCurrentQuestion variable is not set, it indicates that the plugin was just started
        // if the retakeQuiz variable is set, the user wants to retake the quiz
        // both cases mean we should call resetSession() to bring the plugin into a proper state
        $vitsCfCurrentQuestion = vits_cf_reset_session($vitsCfQuestions);

    } else {

        // check to see if the page was refreshed
        $pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

        if ($pageWasRefreshed)
            // if the page was refreshed, do not change the state of the plugin
            $vitsCfCurrentQuestion = $vitsCfQuestions[$_SESSION["vitsCfCurrentQuestion"]];
        else
            // if the page was not refreshed, move on to the next question
            $vitsCfCurrentQuestion = vits_cf_next_question($vitsCfQuestions);

    }
    ?>
</head>
<body>
    <h4>Coffee Finder</h4>
    <?php if ($_SESSION["showResult"] == true): ?>
        <!-- TODO: Remove this on production -->
        Zeige Ergebnis, Antworten:
        <?php
        for ($i = 0; $i < count($vitsCfQuestions); ++$i) {
            echo $_SESSION["chosenAnswers"][$i] . "\n";
        }
        ?>
        <form method="POST">
            <button type="submit" name="retakeQuiz">Retake Quiz</button>
        </form>
    <?php else: ?>
        <div class="questionText">
            <?php echo htmlspecialchars($vitsCfCurrentQuestion->getQuestionText()); ?>
        </div>
        <?php if ($vitsCfCurrentQuestion->getFlavourText() != ""): ?>
            <div class="flavourText">
                <?php echo htmlspecialchars($vitsCfCurrentQuestion->getFlavourText()); ?>
            </div>
        <?php endif; ?>
        <div class="form">
            <form action="<?php $_PHP_SELF ?>" method="GET">
                <div class="answerOptions">
                    <?php
                    $answerOptions = $vitsCfCurrentQuestion->getAnswerOptions();
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