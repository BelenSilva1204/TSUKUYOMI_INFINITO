CREATE OR REPLACE FUNCTION

import_users (unombre varchar(100), urut varchar(25), uedad int, usexo varchar(10), udid int)

RETURNS BOOLEAN AS $$

DECLARE
uidmax int;
upassword varchar;

BEGIN 

    IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD contrasena varchar(20);

        SELECT INTO upassword
        TRIM((RANDOM()*(100000000-1)+1)::varchar(20));
        
        UPDATE usuarios SET contrasena = upassword;
    END IF;
   /*  IF 'contrasena' NOT IN (SELECT column_name FROM information_schema.columns WHERE table_name='usuarios') THEN
        ALTER TABLE usuarios ADD contrasena varchar(20);
        UPDATE usuarios SET contrasena = '1';
    END IF; */

    IF urut NOT IN (SELECT rut FROM Usuarios) THEN
        
        SELECT INTO uidmax
        MAX(uid)
        FROM usuarios;

        SELECT INTO upassword
        TRIM((RANDOM()*(100000000-1)+1)::varchar(20));

        INSERT INTO usuarios values(uidmax, unombre, urut, uedad, usexo, udid, upassword);
        RETURN TRUE;
    ELSE
        RETURN FALSE;
    END IF;
END

$$ language plpgsql


        