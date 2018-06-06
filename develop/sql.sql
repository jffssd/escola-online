CREATE SCHEMA IF NOT EXISTS `eonline` DEFAULT CHARACTER SET utf8;
USE `eonline`;

CREATE TABLE `eonline`.`config_site` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome_site` VARCHAR(100) NOT NULL,
  `logo` VARCHAR(100) NOT NULL,
  `titulo_site` VARCHAR(100) NOT NULL,
PRIMARY KEY (`id`)) 
ENGINE=InnoDB;

CREATE TABLE `eonline`.`usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  `nomemeio` VARCHAR(30),
  `sobrenome` VARCHAR(60) NOT NULL,
  `data_nasc` DATETIME,
  `usuario` VARCHAR(50) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `senha` VARCHAR(32) NOT NULL,
  `imagem_perfil` VARCHAR(255) NOT NULL,
  `permissao` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  `aluno` CHAR(1),
  `professor` CHAR(1),
  `celular` VARCHAR(17),
  `data_registro` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `chave_temporaria` VARCHAR(32),
  `data_solic_senha` DATETIME,
  `req_troca_senha` VARCHAR(26),
PRIMARY KEY (`id`),
  UNIQUE INDEX `usuario_UNIQUE` (`usuario` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC)) 
ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`calendario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(35) NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `ano` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`calendario_datas` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `calendario_id` INT NOT NULL,
  `data` DATETIME NOT NULL,
  `feriado` CHAR(1) NOT NULL,
  `reposicao` CHAR(1) NOT NULL,
  `semestre` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`usuario_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `usuario_id` INT NOT NULL,
  `data_hora` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `ip` VARCHAR(50) NOT NULL,
  `acao` VARCHAR(50) NOT NULL,
  `msg` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_usuario_log_usuario1`
    FOREIGN KEY (`usuario_id`)
    REFERENCES `eonline`.`usuario` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`turma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `turno` VARCHAR(15) NOT NULL,
  `ciclo` INT NOT NULL,
  `serie` INT NOT NULL,
  `codigo` VARCHAR(15) NOT NULL,
  `ano` INT NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`disciplina` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(15) NOT NULL,
  `sigla` CHAR(3) NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`professor_escala` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `professor_id` INT NOT NULL,
  `turno` CHAR(1) NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_professor_disciplina_turma_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`professor_disciplina` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `professor_id` INT NOT NULL,
  `disciplina_id` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_professor_disciplina_professor_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_professor_disciplina_disciplina_id`
  FOREIGN KEY (`disciplina_id`)
  REFERENCES `eonline`.`disciplina` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`prof_resp_turma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `turma_id` INT NOT NULL,
  `professor_id` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  `ano` INT NOT NULL, 
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_prof_resp_turma_turma_id`
  FOREIGN KEY (`turma_id`)
  REFERENCES `eonline`.`turma` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_prof_resp_turma_professor_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`turma_alunos` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `aluno_id` INT NOT NULL,
  `turma_id` INT NOT NULL,
  `status` CHAR(1) NOT NULL,
  `ano` INT NOT NULL, 
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_turma_alunos_turma_id`
  FOREIGN KEY (`turma_id`)
  REFERENCES `eonline`.`turma` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION,
  CONSTRAINT `fk_turma_alunos_aluno_id`
  FOREIGN KEY (`aluno_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `eonline`.`escala_professor` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `professor_id` INT NOT NULL,
  `turno` VARCHAR(15) NOT NULL,
  `ano` INT NOT NULL, 
  `status` CHAR(1) NOT NULL, 
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_escala_professor_professor_id`
  FOREIGN KEY (`professor_id`)
  REFERENCES `eonline`.`usuario` (`id`)
  ON DELETE NO ACTION
  ON UPDATE NO ACTION)
ENGINE = InnoDB;

INSERT INTO `config_site` (`nome_site`, `logo`, `titulo_site`) VALUES
('E-Online', 'logo.png', 'Escola Online');

INSERT INTO `usuario` (`nome`, `nomemeio`, `sobrenome`, `usuario`, `senha`, `data_nasc`, `email`, `imagem_perfil`, `permissao`, `status`, `aluno`, `professor`) VALUES
('Administrador', '', 'do Sistema', 'admin', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste1@teste.com.br', 'default-profile.png', 1, 'A', 'N', 'N'),
('Professor', '', 'de Testes', 'professor', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste2@teste.com.br', 'default-profile.png', 2, 'A', 'N', 'S'),
('Paulo', 'Cardoso', 'Melo', 'paulo.melo', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste3@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Raissa', 'Melo', 'Souza', 'raissa.souza', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste4@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Samuel', 'Silva', 'Rocha', 'samuel.rocha', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste5@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Daniel', 'Pereira Fernandes', 'Moura', 'daniel.moura', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste6@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Giovanna', 'Araujo', 'Rodrigues', 'giovanna.rodrigues', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste7@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Pedro', 'Sousa Cavalcanti', 'Schein', 'pedro.schein', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste8@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Emily', 'Melo', 'Carvalho', 'emily.carvalho', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste9@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Tânia', 'Gomes', 'Azevedo', 'tania.azevedo', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste10@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Renan', 'Lima', 'Rocha', 'renan.rocha', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste11@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Luiz', 'Carvalho', 'Cunha', 'luiz.cunha', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste12@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Joao', 'Costa', 'Sousa', 'joao.souza', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01',  'teste13@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Camila', 'Fernandes', 'Castro', 'camilla.castro', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste14@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Marina', 'Lima Castro', 'Silva', 'marina.silva', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste15@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Beatrice', 'Fernandes', 'Gomes', 'beatrice.gomes', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste16@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Kaua', 'Ferreira', 'Goncalves', 'kaua.goncalves', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste17@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Laura', 'Pinto', 'Alves', 'laura.alves', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste18@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('João', 'Felipe', 'Ferreira', 'joao.ferreira', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste19@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Marcel', '', 'Duarte', 'marcel.duarte', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste20@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Daniel', '', 'Maneteyer', 'daniel.maneteyer', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste21@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Eduardo', '', 'Rezende', 'eduardo.rezende', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste22@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('André', '', 'Napoleão', 'andre.napoleao', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste23@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N'),
('Clayton', '', 'Philippe', 'clayton.phillipe', 'aa1bf4646de67fd9086cf6c79007026c', '2000-01-01', 'teste24@teste.com.br', 'default-profile.png', 2, 'A', 'S', 'N');


INSERT INTO `disciplina` (`nome`, `sigla`, `status`) VALUES
('Artes', 'ART', 'A'),
('Fisica', 'FIS', 'A'),
('Biologia', 'BIO', 'A'),
('Quimica', 'QUI', 'A'),
('Geografia', 'GEO', 'A'),
('Historia', 'HIS', 'A'),
('Matematica', 'MAT', 'A'),
('Português', 'POR', 'A'),
('Literatura', 'LIT', 'A'),
('Educação Física', 'EDF', 'A'),
('Sociologia', 'SOC', 'A'),
('Filosofia', 'FIL', 'A');

INSERT INTO `turma` (`turno`, `ciclo`, `serie`, `codigo`, `ano`) VALUES
('Tarde', 1, 2, 'A', 2018),
('Tarde', 3, 6, 'A', 2018),
('Manhã', 4, 7, 'A', 2018),
('Manhã', 4, 9, 'B', 2018);

INSERT INTO `turma_alunos` (`turma_id`, `aluno_id`, `status`, `ano`) VALUES
(1, 3, 'A', 2018),
(1, 4, 'A', 2018),
(1, 5, 'A', 2018),
(1, 6, 'A', 2018),
(1, 7, 'A', 2018),
(2, 8, 'A', 2018),
(2, 9, 'A', 2018),
(2, 10, 'A', 2018),
(2, 11, 'A', 2018),
(2, 12, 'A', 2018),
(3, 13, 'A', 2018),
(3, 14, 'A', 2018),
(3, 15, 'A', 2018),
(3, 16, 'A', 2018),
(3, 17, 'A', 2018),
(3, 18, 'A', 2018),
(4, 19, 'A', 2018),
(4, 20, 'A', 2018),
(4, 21, 'A', 2018),
(4, 22, 'A', 2018),
(4, 23, 'A', 2018),
(4, 24, 'A', 2018);


CREATE USER IF NOT EXISTS 'root'@'%' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' WITH GRANT OPTION;