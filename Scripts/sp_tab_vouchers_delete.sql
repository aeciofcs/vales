DELIMITER $$
CREATE PROCEDURE `sp_tab_vouchers_delete`(
	pid_voucher INT,
	pid_user INT
)
BEGIN

    DELETE FROM tab_vouchers WHERE id_voucher = pid_voucher AND id_user = pid_user;
    
END$$
DELIMITER ;