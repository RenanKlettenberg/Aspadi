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