CREATE OR REPLACE FUNCTION

change_password(log_usuario varchar(25), current_password varchar(20), new_password varchar(20), new_password_two varchar(25))

-- declaramos lo que retorna 
RETURNS BOOLEAN AS $$

BEGIN
    if current_password NOT IN (SELECT contrasena FROM usuarios WHERE rut = log_usuario AND contrasena = current_password) THEN
        RETURN FALSE;
    END IF;

    if new_password != new_password_two THEN
        RETURN FALSE;
    END IF;
    
    UPDATE usuarios
    SET contrasena = new_password
    WHERE uid = log_usuario;

    RETURN TRUE;

END
$$ language plpgsql