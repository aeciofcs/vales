USE `db_vales`;
DROP procedure IF EXISTS `sp_tab_vouchersupdate_save`;

DELIMITER $$
USE `db_vales`$$
CREATE PROCEDURE `sp_tab_vouchersupdate_save`(
	pid_voucher int(11), 
	pid_user int(11), 
	pint_valor smallint(5) 
    )
Begin
                  
    UPDATE tab_vouchers 
    SET int_valor = pint_valor 
    WHERE id_voucher = pid_voucher AND id_user = pid_user;
	
    SELECT * FROM tab_vouchers vo WHERE vo.id_voucher = pid_voucher;
	
END$$

DELIMITER ;