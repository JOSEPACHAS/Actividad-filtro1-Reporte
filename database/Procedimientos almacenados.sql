-- Procedimiento almacenado: spu_superhero_list_publisher_alignment
-- Obtiene una lista de superhéroes filtrada por un editor y una alineación específicos.
DELIMITER $$
CREATE PROCEDURE spu_superhero_list_publisher_alignment
(
	IN _publisher_id	INT,     -- Parámetro de entrada: ID del editor
	IN _alignment_id	INT      -- Parámetro de entrada: ID de la alineación
)
BEGIN
	IF(_alignment_id = 0) THEN  -- Si la alineación es 0 (ninguna alineación seleccionada) lista todo
		SELECT 
			sp.id, 
			sp.superhero_name, 
			sp.full_name, 
			rc.race  AS 'race',
			pb.publisher_name AS 'publisher'
		FROM superhero sp 
		INNER JOIN race rc ON rc.`id` 	= sp.`race_id`
		INNER JOIN publisher pb ON pb.`id` 	= sp.`publisher_id`
		WHERE sp.publisher_id = _publisher_id
		ORDER BY sp.`id`;
	ELSE  -- Si se seleccionó una alineación válida, lista segun la alineacion
		SELECT 
			sp.id, 
			sp.superhero_name, 
			sp.full_name, 
			rc.race  AS 'race',
			pb.publisher_name AS 'publisher'
		FROM superhero sp 
		INNER JOIN race rc ON rc.`id` 	= sp.`race_id`
		INNER JOIN publisher pb ON pb.`id` 	= sp.`publisher_id`
		WHERE sp.publisher_id = _publisher_id AND sp.alignment_id = _alignment_id
		ORDER BY sp.`id`;
	END IF;
END $$

-- Procedimiento almacenado: spu_publisher_list
-- Obtiene una lista de editores ordenada por el nombre del editor.
DELIMITER $$
CREATE PROCEDURE spu_publisher_list()
BEGIN
	SELECT * FROM publisher ORDER BY publisher_name;
END $$

-- Procedimiento almacenado: spu_alignment_list
-- Obtiene una lista de alineaciones ordenada por la alineación.
DELIMITER $$
CREATE PROCEDURE spu_alignment_list()
BEGIN
	SELECT * FROM alignment ORDER BY alignment;
END $$


CALL spu_alignment_list();

