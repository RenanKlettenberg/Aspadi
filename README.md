# Aspadi
Software de gestão de uma ONG de animais.

# Primeira vez
Se esta é sua primeira vez executando o projeto nesta máquina, siga as instruções abaixo.

Pré-requisitos:
* Tenha o docker instalado.
* .env configurado de acordo com o .env.example (Obs: Banco e usuário não precisam ser criados)
* Abra o terminal na pasta raiz do projeto.

Passo a passo:
1. Faça o build de desenvolvimento.
2. O backend necessita de suas dependencias! Execute o comando abaixo:
    `docker exec -it app_backend composer install`
3. Verifique tudo ocorreu bem!
    - Acesse a URL: http://localhost:(APP_PORT)/Gato
    - Você deve ver uma lista de gatos definidos por padrão!
    - Execute um teste unitário! Rode o comando abaixo: 
      `docker exec -it app_backend vendor/bin/phpunit tests/Unit/GatoTest.php`
    - Acesse a URL http://localhost:(FRONT_PORT) para verificar se o front-end está ok!
4. Sucesso! Você pode começar a usar e alterar o sistema.

# Build - dev
docker-compose up -d --build

# Build - prod
docker-compose -f docker-compose.prod.yml up --build