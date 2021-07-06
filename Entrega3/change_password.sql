CREATE OR REPLACE FUNCTION

change_password(log_usuario int, current_password varchar(100), new_password varchar(100))

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

BEGIN
    if current_password NOT IN (SELECT contrasena FROM usuarios WHERE uid = log_usuario AND contrasena = current_password) THEN
        RETURN FALSE;
    END IF;
    
    UPDATE usuarios
    SET contrasena = new_password
    WHERE uid = log_usuario;

    RETURN TRUE;

END
$$ language plpgsql