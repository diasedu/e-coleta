--
SELECT * FROM usuario;
--
select * from acesso.usuario;

create table TipoColeta (
	idTipoCol INT PRIMARY KEY AUTO_INCREMENT,
    nmTipoCol VARCHAR(30) NOT NULL,
    staTipoCol CHAR(1) NOT NULL
);

CREATE TABLE usuario (
	idUsua INT PRIMARY KEY AUTO_INCREMENT,
    nmUsua VARCHAR(30) NOT NULL,
    staUsua CHAR(1) NOT NULL,
    loginUsua VARCHAR(30) NOT NULL,
    senhaUsua VARCHAR(4000) NOT NULL,
    dtIncl DATE NOT NULL
);
--
INSERT INTO usuario (nmUsua, staUsua, loginUsua, senhaUsua, dtIncl)
VALUES ('Eduardo Praxedes Dias', 'A', 'eduardodias830@gmail.com', '5981213d5fb903c6ec6ea4bbb1b8f91e', sysdate());
--
CREATE TABLE usuario_perfil (
	id_usua INT NOT NULL,
    id_perfil INT NOT NULL,
    PRIMARY KEY(id_usua, id_perfil),
    FOREIGN KEY(id_usua) REFERENCES usuario(idUsua),
    FOREIGN KEY(id_perfil) REFERENCES perfil(idPerfil)
);