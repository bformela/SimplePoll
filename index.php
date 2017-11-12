<!DOCTYPE html>

<html>
<head>
    <title>Sonda</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<?php
    require 'Poll.php';
    require 'Json.php';

    $name = 'Kocia sonda';
    $question = 'Jakie kotki lubisz najbardziej?';
    $answers = array(
        1 => array('Normalne dachowce', '/img/dachowiec.png', 0),
        2 => array('Długowłose', '/img/dlugowlosy.png', 0),
        3 => array('Puszyste kulki', '/img/puszysty.png', 0),
        4 => array('Łyse', '/img/lysy.png', 0),
        5 => array('Nie lubię kotków', '/img/smutny.png', 0)
    );
    $poll = new Poll($name, $question, $answers);
    $json = new Json($poll->getAnswers());
    $init_file = $json->init_file();

    if ($init_file) $poll->setAnswers($json->getData());

    if (isset($_POST["question"])) {
        echo '<div class="container">';
        echo '<h3>' . $poll->getName() . '</h3>';
        echo '<h4>Twoja odpowiedź to: ' . $poll->getAnswers()[$_POST['question']][0] . '</h4>';
        $poll->setPointToAnswer($_POST["question"]);
        $json->setData($poll->getAnswers());
        $json->write_json();
        $poll->genResults();
        echo '<footer>';
        echo '<span>&#9786; Dziękuję</span>';
        echo '</footer>';
        echo '</div>';
    } else {
?>

    <form class="container" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <h3><?php echo $poll->getName(); ?></h3>
        <h4><?php echo $poll->getQuestion(); ?></h4>
        <?php
            foreach ($poll->getAnswers() as $id => $answer) {
                echo "<p><label for=\"$id\"><img src=\"$answer[1]\" alt='Kotek'><br>$answer[0]</label><input type='radio' name='question' id=\"$id\" value=\"$id\" checked></p>";
            }
        ?>
        <input type="submit" />
        <footer>
            <span>&#9757; Głosuj rozsądnie!</span>
        </footer>
    </form>
    <?php } ?>
</body>
</html>