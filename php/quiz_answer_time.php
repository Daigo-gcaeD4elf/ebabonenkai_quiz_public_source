<?php
try {
    // クイズを取得
    $nowQuiz = $quizFunc->fetchQuiz($nowQuizAdminStatus['now_quiz_id']);

    // クイズ選択肢を取得
    $nowQuizOption = $quizFunc->fetchQuizOption($nowQuizAdminStatus['now_quiz_id']);

    // デフォルトでチェックボックスつける選択肢を取得
    $defaultMemberStatus = $quizFunc->fetchDefaultAnswer($nowQuizAdminStatus, $_SESSION['member_id']);
    $defaultAnswer = $defaultMemberStatus['member_answer'];
    $isUsingSuperSatoshikun = $defaultMemberStatus['is_using_super_satoshikun'];

    // スーパーさとしくんを使える回数(これまで使った回数含め)
    $superSatoshikunPowerPoint = $nowQuizAdminStatus['super_satoshikun_power_point'];

    // スーパーさとしくんを使った回数
    $superSatoshikunStock = $quizFunc->fetchSuperSatoshikunStock($nowQuizAdminStatus, $_SESSION['member_id']);

    // 制限時間計算 (ブラウザ更新対策)
    $timeLimit = $quizFunc->calcTimeLimit();

    if (empty($timeLimit) || $timeLimit < 0) {
        $timeLimit = 0;
    }

    // 何かしらの原因で、stateがASK_QUESTION_STATUSでないのにこのPHPが呼ばれた場合
    if ($nowQuizAdminStatus['now_state'] != ASK_QUESTION_STATUS) {
        $timeLimit = 0;
    }

} catch (Exception $e) {
    writeErrorLog(__FILE__, __FUNCTION__, __LINE__, $e->getMessage());
}

// これまでの戦績を取得 獲得したポイント、その経緯(これはeba_quizで取ってくるか…？？)

require_once('../html/quiz_answer_time.html');
