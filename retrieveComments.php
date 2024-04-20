<?php
$comments = array(
    array("Janka", "uzasny film!"),
    array("Sara", "Určite odporúčam"),
    array("Mišo", "Ten koniec nebol dobre spracovany")
);

foreach ($comments as $comment) {
    echo "<p><strong>{$comment[0]}:</strong> {$comment[1]}</p>";
}
?>
