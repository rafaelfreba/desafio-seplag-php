# DESAFIO TÉCNICO SEPLAG-MT
## Número da inscrição: 8837 - Perfil: DESENVOLVEDOR PHP - SÊNIOR
### API Laravel 12, PostgreSQL 15, MinIO e Nginx para SEPLAG MT

Este projeto é uma API desenvolvida com Laravel 12, utilizando PostgreSQL 15 como banco de dados, MinIO para armazenamento de arquivos e Nginx como servidor web.

## Requisitos

* Docker e Docker Compose instalados.
* Composer instalado.
* Insomnia (ou similar) para testar as rotas da API.

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

4.  **Ajuste variáveis de ambiente (opcional):**

      Caso esteja rodando os containeres em uma VM altere as variáveis de ambiente no arquivo ``.env`` conforme imagem:
    
      ![alt text](image.png)

## Testar API

### Gerar Token de Acesso

**Rota:** `POST http://localhost:8000/api/login`

**Payload:**
```json
{
  "email": "admin@example.com",
  "password": "password"
}
```
Obs.: admin@example.com é o usuário com acesso full, já user@example.com é o usuário com acesso apenas para consultas.

Caso precise renovar o token:

**Rota:** `POST http://localhost:8000/api/refresh-token`

Não esqueça de inserir o Bearer Token na autenticação.

_Atenção! O Bearer Token gerado pelos endpoints login ou refresh-token é obrigatório nos demais endpoints da api._ 

## Unidade

### Inserir

**Rota:** `POST http://localhost:8000/api/unidades`

**Payload:**
```json
{
  "unid_nome": "SECRETARIA DE PLANEJAMENTO",
  "unid_sigla": "SEPLAG",
  "end_tipo_logradouro": "RUA",
  "end_logradouro": "D",
  "end_numero": 1,
  "end_bairro": "CPA",
  "cid_id": 1
}
```

### Listar

**Rota:** `GET http://localhost:8000/api/unidades`

### Buscar 

**Rota:** `GET http://localhost:8000/api/unidades/{unid_id}`

### Atualizar 

**Rota:** `PUT http://localhost:8000/api/unidades/{unid_id}`

**Payload:**
```json
{
  "unid_nome": "SECRETARIA DE SAÚDE",
  "unid_sigla": "SES",
  "end_tipo_logradouro": "RUA",
  "end_logradouro": "S",
  "end_numero": 10,
  "end_bairro": "CONTORNO",
  "cid_id": 1
}
```

## Servidor efetivo

### Inserir

**Rota:** `POST http://localhost:8000/api/servidores-efetivos`

**Payload:**
```json
{
    "se_matricula":"123456/7",
    "pes_nome":"JOSÉ MARIA DA SILVA",
    "pes_data_nascimento":"2002-02-02",
    "pes_sexo":"masculino",
    "pes_mae":"MARIA DA SILVA",
    "pes_pai":"JOSÉ DA SILVA",
    "end_tipo_logradouro":"RUA",
    "end_logradouro":"BOCAIÚVA",
    "end_numero":10,
    "end_bairro":"CENTRO",
    "cid_id":1,
    "unid_id":1,
    "lot_data_lotacao":"2020-05-15",
    "lot_data_remocao":"",
    "lot_portaria": "PT GB 1020/2025"
}
```

### Listar

**Rota:** `GET http://localhost:8000/api/servidores-efetivos`

### Buscar 

**Rota:** `GET http://localhost:8000/api/servidores-efetivos/{se_id}`

### Atualizar 

**Rota:** `PUT http://localhost:8000/api/servidores-efetivos/{se_id}`

**Payload:**
```json
{
    "se_matricula":"765432/1",
    "pes_nome":"MARIA JOSÉ DA SILVA",
    "pes_data_nascimento":"2001-01-01",
    "pes_sexo":"feminino",
    "pes_mae":"MARIA DA SILVA",
    "pes_pai":"JOSÉ DA SILVA",
    "end_tipo_logradouro":"AV",
    "end_logradouro":"B",
    "end_numero":7,
    "end_bairro":"CENTRO",
    "cid_id":1,
    "unid_id":1,
    "lot_data_lotacao":"2025-02-01",
    "lot_data_remocao":"",
    "lot_portaria": "PT GB 1020/2025"
}
```
## Servidor temporário

### Inserir

**Rota:** `POST http://localhost:8000/api/servidores-temporarios`

**Payload:**
```json
{
    "st_data_admissao":"2025-03-15",
    "st_data_demissao":"",
    "pes_nome":"FERNANDA CLARA MAGALHÃES",
    "pes_data_nascimento":"2002-02-02",
    "pes_sexo":"feminino",
    "pes_mae":"MARIA DA SILVA",
    "pes_pai":"JOSÉ DA SILVA",
    "end_tipo_logradouro":"RUA",
    "end_logradouro":"B",
    "end_numero":7,
    "end_bairro":"CENTRO",
    "cid_id":1,
    "unid_id":1,
    "lot_data_lotacao":"2025-03-29",
    "lot_data_remocao":"",
    "lot_portaria": "PT GB 1020/2025"
}
```

### Listar

**Rota:** `GET http://localhost:8000/api/servidores-temporarios`

### Buscar 

**Rota:** `GET http://localhost:8000/api/servidores-temporarios/{st_id}`

### Atualizar 

**Rota:** `PUT http://localhost:8000/api/servidores-temporarios/{st_id}`

**Payload:**
```json
{
    "st_data_admissao":"2025-03-15",
    "st_data_demissao":"",
    "pes_nome":"CLAUDIA MARIA BATISTA",
    "pes_data_nascimento":"2003-03-03",
    "pes_sexo":"feminino",
    "pes_mae":"MARIA DA SILVA",
    "pes_pai":"JOSÉ DA SILVA",
    "end_tipo_logradouro":"RUA",
    "end_logradouro":"B",
    "end_numero":7,
    "end_bairro":"CENTRO",
    "cid_id":1,
    "unid_id":1,
    "lot_data_lotacao":"2025-03-29",
    "lot_data_remocao":"",
    "lot_portaria": "PT GB 1020/2025",
}
```
## Lotação

### Inserir

**Rota:** `POST http://localhost:8000/api/lotacoes`

**Payload:**
```json
{
    "pes_id" : "1",
    "unid_id" : "1",
    "lot_data_lotacao" : "2025-01-02",
    "lot_data_remocao" : "2025-03-28",
    "lot_portaria" : "PT GB 8855/25"
}
```

### Listar

**Rota:** `GET http://localhost:8000/api/lotacoes`

### Buscar 

**Rota:** `GET http://localhost:8000/api/lotacoes/{lot_id}`

### Atualizar 

**Rota:** `PUT http://localhost:8000/api/lotacoes/{lot_id}`

**Payload:**
```json
{
    "pes_id" : "1",
    "unid_id" : "1",
    "lot_data_lotacao" : "2024-03-03",
    "lot_data_remocao" : "2025-02-01",
    "lot_portaria" : "PT GB 5555/25"
}
```

## Foto

### Upload

**Rota:** `POST http://localhost:8000/api/upload/{pes_id}/foto`

_Obs.: no body selecionar Form Data, a key => foto, value => selecione um arquivo png, jpg ou jpeg de até 2MB. Já no header adicionar (caso não exista) Content-Type = multipart/form-data._

### Buscar 

**Rota:** `GET http://localhost:8000/api/pessoa/{pes_id}/foto`


## Outros

### Listar servidores efetivos de uma unidade específica do id

**Rota:** `GET http://localhost:8000/api/servidores-efetivos/?unid_id={unid_id}`

### Retornar endereço funcional do servidor efetivo por parte do nome

**Rota:** `GET http://localhost:8000/api/servidores-efetivos/?nome={parte_nome_servidor}`


## Informações Adicionais

* Certifique-se de que as portas necessárias (por exemplo, a porta 80 para o Nginx) estejam disponíveis em sua máquina.
* O MinIO estará acessível através da porta configurada no `docker-compose.yml`.
* O PostgreSql estará acessivel através da porta configurada no `docker-compose.yml`.
