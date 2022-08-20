CREATE TABLE quiz_admin_status (
    admin_member_id SMALLINT NOT NULL PRIMARY KEY
    ,now_state SMALLINT             /* 0:ゲーム中ではない 1:回答画面 2:回答待ち 3:結果発表・次のクイズ待ち */
    ,renewal_time DATETIME(3)
    ,now_game_id SMALLINT
    ,now_game_order SMALLINT
    ,now_quiz_id SMALLINT
    ,now_playlist_id SMALLINT
    ,now_playlist_order SMALLINT
    ,super_satoshikun_power_point SMALLINT
);