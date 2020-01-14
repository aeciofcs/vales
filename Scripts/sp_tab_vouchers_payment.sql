DELIMITER $$
CREATE PROCEDURE `sp_tab_vouchers_payment`(
	pid_voucher INT,
	pid_user INT
)
BEGIN

    UPDATE tab_vouchers 
	SET id_status = 2
	WHERE id_voucher = pid_voucher AND id_user = pid_user;
    
END$$
DELIMITER ;