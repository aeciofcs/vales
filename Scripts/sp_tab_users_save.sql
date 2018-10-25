DELIMITER $$
CREATE PROCEDURE `sp_tab_users_save`(
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
    
	INSERT INTO tab_persons (des_person, des_email, nr_phone, des_pis, des_cpf, des_rg, num_salario)
                      VALUES(pdes_person, pdes_email, pnr_phone, pdes_pis, pdes_cpf, pdes_rg, pnum_salario);
    
    SET vid_person = LAST_INSERT_ID();
    
    INSERT INTO tab_users (id_person, des_login, des_password, inadmin)
    VALUES(vid_person, pdes_login, pdes_password, pinadmin);
    
    SELECT * FROM tab_users us INNER JOIN tb_persons pe USING(id_person) WHERE us.id_user = LAST_INSERT_ID();
    
END$$
DELIMITER ;