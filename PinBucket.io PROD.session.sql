--SELECT * FROM users ORDER BY created_at ASC;
--SELECT DATE_TRUNC('MONTH', "created_at"), COUNT(*) FROM users GROUP BY 1 ORDER BY 1;

--SELECT COUNT(*) FROM users;
--SELECT COUNT(*) FROM teams;

--SELECT team_id, teams.name, COUNT(*), array_agg(user_id) FROM team_user INNER JOIN teams ON team_id = teams.id GROUP BY 1, 2 ORDER BY 3 DESC;
SELECT user_id, users.name, COUNT(*), array_agg(teams.name) FROM team_user INNER JOIN teams ON team_id = teams.id INNER JOIN users ON user_id = users.id GROUP BY 1, 2 ORDER BY 3 DESC;


--SELECT id, user_id, team_id, created_at FROM links ORDER BY 4 ASC
--SELECT user_id, team_id FROM team_user ORDER BY 1;


--SELECT COUNT(*) FROM links;