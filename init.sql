CREATE SCHEMA IF NOT EXISTS animais;

CREATE TABLE animais.gato (
    gat_id SERIAL PRIMARY KEY, 
    nome character varying(255),
    idade integer,
    cor character varying(60)
);

INSERT INTO animais.gato (nome, idade, cor) VALUES 
('Salem', 5, 'preto'),
('Mingau', 2, 'branco'),
('Luna', 3, 'cinza'),
('Garfield', 7, 'laranja'),
('Frajola', 4, 'preto e branco');

CREATE SCHEMA IF NOT EXISTS "system";

-- DROP TABLE system.sys_usuario 
CREATE TABLE IF NOT EXISTS system.sys_usuario (
	usu_id SERIAL NOT NULL,
	usu_email VARCHAR(255) NOT NULL,
	usu_nome VARCHAR(255) NOT NULL,
	usu_password TEXT NOT NULL,
	CONSTRAINT pk_sys_usuario_usu_id PRIMARY KEY (usu_id)
);

INSERT INTO system.sys_usuario (usu_email, usu_nome, usu_password) VALUES ('mestre@gmail.com', 'Mestre', '123');