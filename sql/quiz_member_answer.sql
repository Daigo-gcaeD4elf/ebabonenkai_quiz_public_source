/* メンバーの回答はこのテーブルに記載される  */
CREATE TABLE quiz_member_answer (
    member_id SMALLINT NOT NULL         /* メンバーID */
    ,game_id SMALLINT NOT NULL          /* ゲームID */
    ,game_order SMALLINT NOT NULL       /* そのゲームの何問めか */
    ,member_answer_no SMALLINT NOT NULL /* 回答1 (基本は1のみ。多答問題の場合は2, 3, 4…とレコードが増えていく) */
    ,member_answer VARCHAR(100)         /* 回答 */
    ,answer_time DATETIME(3)            /* 回答時刻 */
    ,is_using_super_satoshikun TINYINT  /* スーパーさとしくん 0:使用しない 1:使用する */
    ,is_correct_answer TINYINT          /* 正解不正解 0:不正解 or 採点前 1:正解 */
    ,acquired_point SMALLINT            /* 獲得した点数 */
    ,PRIMARY KEY(member_id, game_id, game_order, member_answer_no)
);

/* クイズ終わったらDELETE or TRUNCATE */