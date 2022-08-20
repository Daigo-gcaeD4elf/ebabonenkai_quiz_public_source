CREATE TABLE quiz (
    quiz_id INT PRIMARY KEY           /* クイズID 主キー */
    ,quiz_format SMALLINT                /* 1:選択問題 2:記述式問題 3:多答問題 FIXME:思いついたら足していく*/
    ,is_quick_press TINYINT              /* 0:早押しでない 1:早押し */
    ,quiz_question_sentence VARCHAR(300) /* 問題文 */
    ,quiz_answer VARCHAR(100)            /* 答え */
    ,time_limit SMALLINT                 /* 回答時間(秒) */
    ,allocation SMALLINT                 /* 配点 */
);