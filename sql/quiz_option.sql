/* 選択問題の選択肢 */
CREATE TABLE quiz_option (
    quiz_id SMALLINT NOT NULL      /* クイズID */
    ,quiz_option_id VARCHAR(5)     /* 選択肢 ID */
    ,quiz_option_text VARCHAR(100) /* 選択肢 */
    ,PRIMARY KEY(quiz_id, quiz_option_id)
);