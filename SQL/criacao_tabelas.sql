Doc mysql:

### usuários 

CREATE TABLE usuarios (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    email VARCHAR(255) NOT NULL,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('usuario', 'admin') NOT NULL DEFAULT 'usuario',
    ativo TINYINT(1) NOT NULL DEFAULT 1,
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    UNIQUE KEY uk_usuarios_email (email)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4;


### treinos:

CREATE TABLE treinos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    dia ENUM(
        'SEG',
        'TER',
        'QUA',
        'QUI',
        'SEX',
        'SAB'
    ) NOT NULL,

    titulo VARCHAR(100) NOT NULL,
    horario VARCHAR(30) NOT NULL,
    descricao VARCHAR(500),
    nivel ENUM(
        'iniciante',
        'intermediario',
        'avancado',
        'todos'
    ) NOT NULL,

    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4;


  ### campeonatos

  CREATE TABLE campeonatos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    nome VARCHAR(200) NOT NULL,

    tipo ENUM(
        'proximo',
        'disputado',
        'conquista'
    ) NOT NULL,

    status ENUM(
        'aberto',
        'confirmado',
        'analise',
        'finalizado'
    ) DEFAULT NULL,

    local VARCHAR(200),
    data_exibicao VARCHAR(100),
    ano SMALLINT UNSIGNED,
    colocacao VARCHAR(30),
    icone VARCHAR(20),
    descricao TEXT,

    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    KEY idx_campeonatos_tipo (tipo),
    KEY idx_campeonatos_ano (ano)
) ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4;

  ### ALbuns

  CREATE TABLE albuns (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    categoria ENUM(
        'treinos',
        'campeonatos',
        'time',
        'bastidores'
    ) NOT NULL,
    descricao VARCHAR(500),
    status ENUM(
        'publicado',
        'oculto'
    ) NOT NULL DEFAULT 'publicado',
    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    atualizado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (id),
    KEY idx_albuns_categoria (categoria),
    KEY idx_albuns_status (status)
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;


## fotos

CREATE TABLE fotos (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,

    album_id INT UNSIGNED NOT NULL,

    nome_arquivo VARCHAR(255) NOT NULL,
    tipo_mime VARCHAR(100) NOT NULL,
    tamanho INT UNSIGNED,

    imagem MEDIUMBLOB NOT NULL,

    legenda VARCHAR(255),
    ordem INT UNSIGNED NOT NULL DEFAULT 0,

    criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    PRIMARY KEY (id),

    KEY idx_fotos_album (album_id),

    CONSTRAINT fk_fotos_album
        FOREIGN KEY (album_id)
        REFERENCES albuns(id)
        ON DELETE CASCADE
) ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4;