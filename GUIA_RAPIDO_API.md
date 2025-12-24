# 🔧 Guia Rápido - Como Obter e Usar o Token API

## ✅ Problema Resolvido!

O erro 401 foi corrigido. Agora o sistema usa autenticação via `api_token` do parceiro, não mais o Sanctum padrão.

---

## 📋 Passo a Passo para Testar

### 1️⃣ **Criar um Parceiro**

Acesse via navegador (como admin):
```
http://localhost:8000/admin/partners/create
```

Preencha:
- **Nome**: Parceiro Teste LTDA
- **Email**: contato@teste.com
- **CPF/CNPJ**: 12345678000199
- **Status**: Ativo

Clique em **"Salvar Parceiro"**

### 2️⃣ **Copiar o Token API**

Após criar, você será redirecionado para a lista. Clique em **Editar** no parceiro criado.

Na tela de edição, você verá o **Token de API**. Exemplo:
```
abc123def456ghi789jkl012mno345pqr678stu901vwx234yz
```

**Copie este token!**

### 3️⃣ **Testar no Postman**

#### Opção A: Listar Clientes
```http
GET http://localhost:8000/api/customers
Authorization: Bearer SEU_TOKEN_AQUI
Accept: application/json
```

#### Opção B: Criar um Cliente
```http
POST http://localhost:8000/api/customers
Authorization: Bearer SEU_TOKEN_AQUI
Accept: application/json
Content-Type: application/json

{
    "name": "João da Silva",
    "document": "12345678901"
}
```

#### Opção C: Ver informações do parceiro
```http
GET http://localhost:8000/api/partner
Authorization: Bearer SEU_TOKEN_AQUI
Accept: application/json
```

---

## 🧪 Teste Rápido com cURL

### Obter informações do parceiro:
```bash
curl -X GET http://localhost:8000/api/partner \
  -H "Authorization: Bearer SEU_TOKEN_AQUI" \
  -H "Accept: application/json"
```

### Criar um cliente:
```bash
curl -X POST http://localhost:8000/api/customers \
  -H "Authorization: Bearer SEU_TOKEN_AQUI" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Maria Santos",
    "document": "98765432100"
  }'
```

### Criar um registro de valor:
```bash
curl -X POST http://localhost:8000/api/records \
  -H "Authorization: Bearer SEU_TOKEN_AQUI" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "end_customer_id": 1,
    "total_amount": 1500.00,
    "transaction_type": "credit",
    "installments": 3,
    "description": "Pagamento de serviço"
  }'
```

---

## ⚠️ Importante

### Formato do Header de Autorização:
```
Authorization: Bearer SEU_TOKEN_COMPLETO_AQUI
```

**NÃO esqueça da palavra "Bearer" antes do token!**

### Headers Obrigatórios:
```http
Authorization: Bearer [token]
Accept: application/json
Content-Type: application/json  (apenas para POST/PUT)
```

---

## 🔍 Verificar se Está Funcionando

**Resposta de Sucesso (200/201):**
```json
{
    "id": 1,
    "name": "João da Silva",
    "document": "12345678901",
    "partner_id": 1,
    "created_at": "2025-12-24T10:30:00.000000Z",
    "updated_at": "2025-12-24T10:30:00.000000Z"
}
```

**Erro 401 - Token Inválido:**
```json
{
    "message": "Token inválido ou parceiro inativo.",
    "error": "Unauthorized"
}
```

**Erro 401 - Token Não Fornecido:**
```json
{
    "message": "Token de autenticação não fornecido.",
    "error": "Unauthorized"
}
```

---

## 📝 Endpoints Disponíveis

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| GET | `/api/partner` | Informações do parceiro autenticado |
| GET | `/api/customers` | Listar clientes do parceiro |
| POST | `/api/customers` | Criar novo cliente |
| GET | `/api/customers/{id}` | Visualizar cliente |
| PUT | `/api/customers/{id}` | Atualizar cliente |
| DELETE | `/api/customers/{id}` | Deletar cliente |
| GET | `/api/records` | Listar registros do parceiro |
| POST | `/api/records` | Criar novo registro |
| GET | `/api/records/{id}` | Visualizar registro |
| PUT | `/api/records/{id}` | Atualizar registro |
| DELETE | `/api/records/{id}` | Deletar registro |

---

## 🎯 Exemplo Completo

1. Crie um parceiro via web
2. Copie o token: `abc123...`
3. Configure no Postman:
   - Variável `api_token`: `abc123...`
   - Header: `Authorization: Bearer {{api_token}}`
4. Teste: GET `/api/partner`
5. Se retornar os dados do parceiro = ✅ **Funcionou!**

---

## 💡 Dicas

- ✅ Cada parceiro tem seu próprio token único
- ✅ O token nunca expira (a menos que seja regenerado)
- ✅ Um parceiro só vê seus próprios clientes e registros
- ✅ Para renovar o token, use o botão "Regenerar" na edição do parceiro
- ⚠️ Ao regenerar, o token antigo para de funcionar

---

## 🐛 Solução de Problemas

### Erro 401?
- Verifique se o token está correto
- Confirme que o parceiro está **ativo** (is_active = 1)
- Certifique-se de incluir "Bearer " antes do token

### Erro 404?
- Verifique a URL (deve ser `/api/customers`, não `/admin/...`)
- Confirme que o servidor está rodando

### Erro 422?
- Verifique os dados enviados (campos obrigatórios, formatos, etc)

---

Agora está tudo pronto! 🚀
