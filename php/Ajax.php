<?php
require_once('Common.php');
require_once('Db.php');

class Ajax extends Db
{
    /**
    * ゲーム状態取得
    * @return string
    */
    public function chkGameState($post)
    {
        $sql = 'SELECT state FROM admin_rock_paper_scissors WHERE admin_member_id = 1';
        $stmt = $this->dbh->query($sql);
        $nowState = $stmt->fetch(PDO::FETCH_COLUMN);
        echo $nowState;
    }

    /**
    * じゃんけんの選択項目変更をDBに反映(ユーザー)
    * @param array $post
    * @return string
    */
    public function changeRps($post)
    {
        $rps = $post['rps'];
        $id  = $post['member_id'];

        $sql = <<< EOF
            UPDATE
                rock_paper_scissors
            SET
                rps = ?
            WHERE
                member_id = ?
        ;
EOF;

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([$rps, $id]);

        $rpsNm = '';
        if ($rps === '1') {
            $rpsNm = 'グー';
        } else if ($rps === '2') {
            $rpsNm = 'チョキ';
        } else if ($rps === '3') {
            $rpsNm = 'パー';
        }

        echo $rpsNm;
    }

    /**
    * じゃんけんの選択項目変更をDBに反映(管理者)
    * @param array $post
    * @return string
    */
    public function changeAdminerRps($post)
    {
        $rps = $post['rps'];
        $sql = <<< EOF
            UPDATE
                admin_rock_paper_scissors
            SET
                admin_choise = ?
            WHERE
                admin_member_id = 1
        ;
EOF;

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([$rps]);

        $rpsNm = '';
        if ($rps === '1') {
            $rpsNm = 'グー';
        } else if ($rps === '2') {
            $rpsNm = 'チョキ';
        } else if ($rps === '3') {
            $rpsNm = 'パー';
        }

        echo $rpsNm;
    }

    /**
    * 次のじゃんけんへ進むがクリックされたかどうかチェック
    * @return string
    */
    public function chkNextGame($post)
    {
        $sql = <<< EOF
            SELECT
                CONCAT(DATE_FORMAT(renewal_time, '%H%i%s'), state)
            FROM
                admin_rock_paper_scissors
            WHERE admin_member_id = 1
EOF;
        $stmt = $this->dbh->query($sql);
        echo $stmt->fetch(PDO::FETCH_COLUMN);
    }


    // =============================================== //
    // ======= ここから下はクイズゲーム用！！ ======== //
    // =============================================== //

    /**
     * 現在のステータスを取得
     * @param array
     * @return void
     */
    public function chkQuizGameState($post)
    {
        $sql = 'SELECT now_state FROM quiz_admin_status';
        $stmt = $this->dbh->query($sql);
        $nowState = $stmt->fetch(PDO::FETCH_COLUMN);

        if (empty($nowState)) {
            $nowState = 0;
        }

        echo $nowState;
    }

    /**
     * メンバーの回答を変更(ユーザー画面のラジオボタンクリックで着火)
     * @param array
     * @return void
     */
    public function changeMemberAnswer($post)
    {
        $answer    = $post['your_answer'];
        $memberId  = $post['member_id'];
        $gameId    = $post['game_id'];
        $gameOrder = $post['game_order'];

        $sql = <<< EOF
            UPDATE
                quiz_member_answer
            SET
                member_answer = :answer
                ,answer_time = NOW(3)
            WHERE
                member_id = :memberId
            AND game_id = :gameId
            AND game_order = :gameOrder
        ;
EOF;

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            'answer' => $answer,
            'memberId' => $memberId,
            'gameId' => $gameId,
            'gameOrder' => $gameOrder,
        ]);
    }

    /**
     * メンバーのスーパーさとしくん使用是非変更
     * @param array
     * @return void
     */
    public function changeIsUsingSupersatoshikun($post)
    {
        $isUsingSuperSatoshikun = $post['is_using_super_satoshikun'];
        $memberId  = $post['member_id'];
        $gameId    = $post['game_id'];
        $gameOrder = $post['game_order'];

        $sql = <<< EOF
            UPDATE
                quiz_member_answer
            SET
                is_using_super_satoshikun = :answer
            WHERE
                member_id = :memberId
            AND game_id = :gameId
            AND game_order = :gameOrder
        ;
EOF;

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            'answer' => $isUsingSuperSatoshikun,
            'memberId' => $memberId,
            'gameId' => $gameId,
            'gameOrder' => $gameOrder,
        ]);
    }
}

$fnc = $_POST['fnc_name'];
$req = new Ajax();
$req->$fnc($_POST);
