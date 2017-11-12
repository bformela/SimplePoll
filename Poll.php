<?php

declare(strict_types=1);

class Poll {

    private $name;
    private $question;
    private $answers;

    public function __construct($name, $question, array $answers) {
        $this->name = $name;
        $this->question = $question;
        $this->answers = $answers;
    }

    public function getName() {
        return $this->name;
    }

    public function getQuestion() {
        return $this->question;
    }

    public function getAnswers() {
        return $this->answers;
    }

    public function setAnswers($answers) {
        $this->answers = $answers;
    }

    public function setPointToAnswer($answer_id) {
        $this->answers[$answer_id][2] += 1;
    }

    public function genResults() {
        $total = array_sum(array_column($this->getAnswers(),2));
        foreach ($this->getAnswers() as $answer) {
            $percent = 100 * round($answer[2] / ($total), 2);
            echo '<p>';
            echo "<img src=\"$answer[1]\" alt=\"Kotek\"><br>";
            echo "$answer[0]: $percent% ($answer[2])<br><br>";
            echo '</p>';
        }
    }
}
