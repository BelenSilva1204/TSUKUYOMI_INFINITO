CREATE OR REPLACE FUNCTION

check_user (urut varchar(25), upass varchar(20))

RETURNS BOOLEAN AS $$

BEGIN
    IF urut, upass IN (SELECT rut, password FROM usuarios) THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;

END

$$language plpgsql