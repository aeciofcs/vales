DELIMITER $$
CREATE PROCEDURE `sp_tab_usersupdate_save`(
    pid_user INT,	
	pdes_person VARCHAR(64), 
	pdes_email VARCHAR(128), 
	pnr_phone BIGINT, 
	pdes_pis VARCHAR(11), 
	pdes_cpf VARCHAR(11), 
	pdes_rg VARCHAR(15), 
	pnum_salario numeric(10,2), 
	pdes_login VARCHAR(64), 
	pdes_password VARCHAR(256), 
	pinadmin TINYINT )
BEGIN
	
    DECLARE vid_person INT;
    
    SELECT id_person INTO vid_person
    FROM tab_users WHERE id_user = pid_user;
    
	UPDATE tab_persons 
    SET des_person  = pdes_person, 
        des_email   = pdes_email, 
        nr_phone    = pnr_phone, 
        des_pis     = pdes_pis, 
        des_cpf     = pdes_cpf, 
        des_rg      = pdes_rg, 
        num_salario = pnum_salario
	WHERE id_person = vid_person;
    
       
    UPDATE tab_users 
    SET des_login    = pdes_login, 
        des_password = pdes_password, 
        inadmin      = pinadmin
    WHERE id_user = pid_user;
    
    SELECT * FROM tab_users us INNER JOIN tab_persons pe USING(id_person) WHERE us.id_user = pid_user;
    
END$$
DELIMITER ;