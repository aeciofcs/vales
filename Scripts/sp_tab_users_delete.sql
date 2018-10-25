DELIMITER $$
CREATE PROCEDURE `sp_tab_users_delete`(
	pid_user INT
)
BEGIN    
    
	DECLARE vid_person INT;
    
    SELECT id_person INTO vid_person
    FROM tab_users WHERE id_user = pid_user;
    
    DELETE FROM tab_users WHERE id_user = pid_user;
	DELETE FROM tab_persons WHERE id_person = vid_person;
    
END$$
DELIMITER ;