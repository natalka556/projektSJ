<?php
// Spustí reláciu (session) alebo pokračuje v existujúcej relácii
// Relácia umožňuje uchovávať informácie naprieč rôznymi stránkami (napr. prihlasovacie údaje)
session_start();
// odstráni položku user_id zo superglobálneho poľa $_SESSION
// Tým sa efektívne odhlási používateľ, pretože user_id už nebude uložený v relácii
unset($_SESSION['user_id']);
// presmeruje používateľa na stránku index.php
header("Location: index.php");
// okamžite ukončí vykonávanie skriptu
exit();
?>
