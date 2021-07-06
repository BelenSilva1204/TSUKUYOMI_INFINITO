CREATE OR REPLACE FUNCTION

check_user (urut varchar(25), upass varchar(20))

RETURNS BOOLEAN AS $$

BEGIN
    IF urut IN (SELECT rut FROM usuarios) THEN
        IF upass IN (SELECT contrasena FROM usuarios WHERE rut = urut)
            RETURN TRUE;
        END IF;
    ELSE
        RETURN FALSE;
    END IF;

END

$$language plpgsql