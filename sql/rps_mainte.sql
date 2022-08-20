-- ログインユーザー確認用
SELECT * FROM game_member WHERE login_state = 1;
SELECT COUNT(member_id) FROM game_member WHERE login_state = 1;

-- ログインしていないユーザーはこっち
SELECT * FROM game_member WHERE login_state <> 1;
