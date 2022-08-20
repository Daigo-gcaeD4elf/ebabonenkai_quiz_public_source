<?php
session_start();

require_once('quiz_func.php');

// TODO:制限時間と配点は数字じゃないとダメ

$quizId = '';
if (!empty($_GET['quiz_id'])) {
    $quizId = $_GET['quiz_id'];
}
require_once('../html/create_quiz_conf.html');
