CREATE OR REPLACE FUNCTION

import_users (unombre varchar(100), urut varchar(25), uedad int, usexo varchar(10), udid int)

RETURNS BOOLEAN AS $$

DECLARE
uidmax int;

BEGIN 

    IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD contrasena varchar(20);
        UPDATE usuarios SET contrasena = LTRIM(STR(rand()*(100000000-1)+1, 8));
    END IF;
    /* IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD contrasena varchar(20);
        UPDATE usuarios SET contrasena = LTRIM(STR(rand()*(100000000-1)+1, 8);
    END IF; */

    IF urut NOT IN (SELECT rut FROM Usuarios) THEN
        
        SELECT INTO uidmax
        MAX(uid)
        FROM usuarios;

        INSERT INTO usuarios values(uidmax, unombre, urut, uedad, usexo, udid, LTRIM(STR(rand()*(100000000-1)+1, 8));
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END

$$ language plpgsql


        