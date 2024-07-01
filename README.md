Este projeto tem como objetivo realizar o controle financeiro de uma empresa:

Como não conseguir baixar o Mysql utilizei uma máquina virtual(VM) para criar o meu banco de dados usando os seguintes comandos:

Instalar MySQL 
1- Atualizar os Pacotes do Sistema
*  sudo apt update
*  sudo apt upgrade
  
2- Instalar o MySQL Server
*  sudo apt install mysql-server

3- Configurar o MySQL
*  sudo mysql_secure_installation

4-Verificar o Status do MySQL
*  sudo systemctl status mysql

5- Adicionar o Repositório MySQL
*  wget https://dev.mysql.com/get/mysql80-community-release-el7-3.noarch.rpm
*  sudo rpm -Uvh mysql80-community-release-el7-3.noarch.rpm

6- Instalar o MySQL Server
*  sudo yum install mysql-server

7- Iniciar o MySQL
*  sudo systemctl start mysqld

8- Obter a Senha Temporária
*  sudo grep 'temporary password' /var/log/mysqld.log

9- Configurar o MySQL
*  mysql -u root -p
*  ALTER USER 'root'@'localhost' IDENTIFIED BY 'NovaSenhaSegura!';
exit

10- Executar o Script de Segurança
*  sudo mysql_secure_installation

11- Verificar a Instalação
*  sudo systemctl status mysql    # Para Ubuntu/Debian
*  sudo systemctl status mysqld   # Para CentOS/RHEL

12- Conectar ao MySQL
*  mysql -u root -p

13- Criar o Banco de Dados e as Tabelas
*  CREATE DATABASE controle_financeiro;
USE controle_financeiro;

*  CREATE TABLE tbl_empresa (
    id_empresa INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL
);

*  CREATE TABLE tbl_conta_pagar (
    id_conta_pagar INT AUTO_INCREMENT PRIMARY KEY,
    valor DECIMAL(10, 2) NOT NULL,
    data_pagar DATE NOT NULL,
    pago TINYINT(1) NOT NULL DEFAULT 0,
    id_empresa INT,
    FOREIGN KEY (id_empresa) REFERENCES tbl_empresa(id_empresa)
);
