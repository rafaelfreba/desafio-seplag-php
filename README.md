# DESAFIO TÉCNICO SEPLAG-MT
## Número da inscrição: 8837 - Perfil: DESENVOLVEDOR PHP - SÊNIOR
### API Laravel 12, PostgreSQL 15, MinIO e Nginx para SEPLAG MT

Este projeto é uma API desenvolvida com Laravel 12, utilizando PostgreSQL 15 como banco de dados, MinIO para armazenamento de arquivos e Nginx como servidor web.

## Requisitos

* Docker e Docker Compose instalados.
* Composer instalado.
* Postman (ou similar) para testar as rotas da API.

## Instruções de Execução

1.  **Clonar o Repositório:**

    ```bash
    git clone https://github.com/rafaelfreba/desafio-seplag-php.git
    cd desafio-seplag-php
    ```

2.  **Instalar Dependências do PHP:**

    ```bash
    composer install
    ```
    
3.  **Subir os Contêineres Docker:**

    ```bash
    docker-compose up -d --build
    ```

4.  **Importar Coleção do Postman:**

    * Abra o Postman.
    * Importe a coleção de rotas da API, localizada na raiz do projeto **(desafio_seplag.postman_collection)**.

      Obs.: caso esteja rodando os containeres em uma VM altere a variável de ambiente **url_base** para o ip da VM (ex.: http://192.158.1.38:8080/api)

5.  **Testar as Rotas da API:**

    * Utilize o Postman para enviar requisições para as rotas da API e verificar o funcionamento.

## Informações Adicionais

* Certifique-se de que as portas necessárias (por exemplo, a porta 80 para o Nginx) estejam disponíveis em sua máquina.
* O MinIO estará acessível através da porta configurada no `docker-compose.yml`.
* O PostgreSql estará acessivel através da porta configurada no `docker-compose.yml`.
