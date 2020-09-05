<?php


class Question
{
    /**
     * The actual question as shown to the user.
     */
    private string $questionText;

    /**
     * Array of answer options (strings) that are shown to the user for this question.
     */
    private array $answerOptions;

    /**
     * Number that represents the chosen answer of the user. The first answer option is represented as 0.
     */
    private int $chosenAnswer;

    /**
     * Initialize class, set properties.
     *
     * @param string $questionText The actual question as shown to the user.
     * @param string ...$answerOptions Array of answer options (strings) that are shown to the user for this question.
     * @throws Exception Exception thrown if less than two answer options are passed.
     */
    public function __construct(string $questionText, string ...$answerOptions)
    {
        // enforce more than one answer option
        if (count($answerOptions) <= 1) {
            throw new Exception("Question must have at least two answer options.");
        }

        $this->questionText = $questionText;
        $this->answerOptions = $answerOptions;
    }

    /**
     * @return string The actual question as shown to the user.
     */
    public function getQuestionText(): string
    {
        return $this->questionText;
    }

    /**
     * @return array Array of answer options (strings) that are shown to the user for this question.
     */
    public function getAnswerOptions(): array
    {
        return $this->answerOptions;
    }

    /**
     * @return int Number that represents the chosen answer of the user. The first answer option is represented as 0.
     */
    public function getChosenAnswer(): int
    {
        return $this->chosenAnswer;
    }

    /**
     * @param int $chosenAnswer Number that represents the chosen answer of the user.
     * The first answer option is represented as 0.
     */
    public function setChosenAnswer(int $chosenAnswer): void
    {
        $this->chosenAnswer = $chosenAnswer;
    }
}