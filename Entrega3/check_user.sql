CREATE OR REPLACE FUNCTION

check_user (urut varchar(25), upass varchar(20))

RETURNS BOOLEAN AS $$

BEGIN
    IF urut, upass IN (SELECT rut, contrasena FROM usuarios WHERE rut = urut AND contrasena = upass) THEN
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;

END

$$language plpgsql