# 📋 Exemplos de Payloads - API Registradora

## 🔧 Configuração Inicial

### Variáveis de Ambiente
```
base_url: http://localhost:8000
csrf_token: [obter do formulário web]
api_token: [obter após criar um parceiro]
```

---

## 🌐 Rotas Web (Admin)

### 1️⃣ **PARCEIROS**

#### ➕ Criar Parceiro
```http
POST /admin/partners
Content-Type: application/x-www-form-urlencoded
X-CSRF-TOKEN: {{csrf_token}}

name=Parceiro Teste LTDA
email=contato@parceiroteste.com.br
document=12345678000199
is_active=1
```

**Payload JSON alternativo:**
```json
{
    "name": "Parceiro Teste LTDA",
    "email": "contato@parceiroteste.com.br",
    "document": "12345678000199",
    "is_active": 1
}
```

#### ✏️ Atualizar Parceiro
```http
PUT /admin/partners/1
Content-Type: application/json
X-CSRF-TOKEN: {{csrf_token}}
```
```json
{
    "name": "Parceiro Teste Atualizado",
    "email": "novo@parceiroteste.com.br",
    "document": "12345678000199",
    "is_active": 1
}
```

#### 🔄 Regenerar Token API
```http
POST /admin/partners/1/regenerate-token
X-CSRF-TOKEN: {{csrf_token}}
```

---

### 2️⃣ **CLIENTES FINAIS**

#### ➕ Criar Cliente
```http
POST /admin/end-customers
Content-Type: application/x-www-form-urlencoded
X-CSRF-TOKEN: {{csrf_token}}

partner_id=1
name=João da Silva
document=12345678901
```

**Payload JSON alternativo:**
```json
{
    "partner_id": 1,
    "name": "João da Silva",
    "document": "12345678901"
}
```

#### ✏️ Atualizar Cliente
```http
PUT /admin/end-customers/1
Content-Type: application/json
X-CSRF-TOKEN: {{csrf_token}}
```
```json
{
    "partner_id": 1,
    "name": "João da Silva Atualizado",
    "document": "12345678901"
}
```

---

### 3️⃣ **REGISTROS DE VALORES**

#### ➕ Criar Registro de Crédito
```http
POST /admin/value-records
Content-Type: application/x-www-form-urlencoded
X-CSRF-TOKEN: {{csrf_token}}

partner_id=1
end_customer_id=1
total_amount=1500.50
transaction_type=credit
installments=3
description=Pagamento de serviço contratado
```

**Payload JSON alternativo:**
```json
{
    "partner_id": 1,
    "end_customer_id": 1,
    "total_amount": 1500.50,
    "transaction_type": "credit",
    "installments": 3,
    "description": "Pagamento de serviço contratado"
}
```

#### ➕ Criar Registro de Débito
```json
{
    "partner_id": 1,
    "end_customer_id": 1,
    "total_amount": 2500.00,
    "transaction_type": "debit",
    "installments": 1,
    "description": "Compra à vista"
}
```

#### ✏️ Atualizar Registro
```http
PUT /admin/value-records/1
Content-Type: application/json
X-CSRF-TOKEN: {{csrf_token}}
```
```json
{
    "partner_id": 1,
    "end_customer_id": 1,
    "total_amount": 2000.00,
    "transaction_type": "credit",
    "installments": 4,
    "description": "Valor atualizado"
}
```

#### 🔍 Listar com Filtros
```http
GET /admin/value-records?partner_id=1&transaction_type=credit
```

---

## 🔐 API REST (Autenticação via Bearer Token)

### Cabeçalhos Necessários
```http
Authorization: Bearer {{api_token}}
Accept: application/json
Content-Type: application/json
```

### 1️⃣ **CLIENTES (API)**

#### ➕ Criar Cliente via API
```http
POST /api/customers
Authorization: Bearer {{api_token}}
Content-Type: application/json
```
```json
{
    "name": "Maria Santos",
    "document": "98765432100"
}
```

**Resposta Esperada:**
```json
{
    "id": 1,
    "partner_id": 1,
    "name": "Maria Santos",
    "document": "98765432100",
    "created_at": "2025-12-24T10:30:00.000000Z",
    "updated_at": "2025-12-24T10:30:00.000000Z"
}
```

#### 📋 Listar Clientes
```http
GET /api/customers
Authorization: Bearer {{api_token}}
```

#### 👁️ Visualizar Cliente
```http
GET /api/customers/1
Authorization: Bearer {{api_token}}
```

#### ✏️ Atualizar Cliente
```http
PUT /api/customers/1
Authorization: Bearer {{api_token}}
Content-Type: application/json
```
```json
{
    "name": "Maria Santos Oliveira",
    "document": "98765432100"
}
```

#### 🗑️ Deletar Cliente
```http
DELETE /api/customers/1
Authorization: Bearer {{api_token}}
```

---

### 2️⃣ **REGISTROS (API)**

#### ➕ Criar Registro de Crédito
```http
POST /api/records
Authorization: Bearer {{api_token}}
Content-Type: application/json
```
```json
{
    "end_customer_id": 1,
    "total_amount": 3500.00,
    "transaction_type": "credit",
    "installments": 5,
    "description": "Pagamento via API - Serviço Premium"
}
```

**Resposta Esperada:**
```json
{
    "id": 1,
    "partner_id": 1,
    "end_customer_id": 1,
    "total_amount": "3500.00",
    "transaction_type": "credit",
    "installments": 5,
    "installment_amount": "700.00",
    "description": "Pagamento via API - Serviço Premium",
    "created_at": "2025-12-24T10:35:00.000000Z",
    "updated_at": "2025-12-24T10:35:00.000000Z"
}
```

#### ➕ Criar Registro de Débito
```json
{
    "end_customer_id": 1,
    "total_amount": 800.00,
    "transaction_type": "debit",
    "installments": 1,
    "description": "Compra via API"
}
```

#### ➕ Criar Registro Parcelado (12x)
```json
{
    "end_customer_id": 1,
    "total_amount": 12000.00,
    "transaction_type": "credit",
    "installments": 12,
    "description": "Mensalidade anual parcelada"
}
```
*Cálculo automático: 12.000,00 / 12 = R$ 1.000,00 por parcela*

#### 📋 Listar Registros
```http
GET /api/records
Authorization: Bearer {{api_token}}
```

#### 👁️ Visualizar Registro
```http
GET /api/records/1
Authorization: Bearer {{api_token}}
```

#### ✏️ Atualizar Registro
```http
PUT /api/records/1
Authorization: Bearer {{api_token}}
Content-Type: application/json
```
```json
{
    "end_customer_id": 1,
    "total_amount": 4000.00,
    "transaction_type": "credit",
    "installments": 4,
    "description": "Registro atualizado via API"
}
```

#### 🗑️ Deletar Registro
```http
DELETE /api/records/1
Authorization: Bearer {{api_token}}
```

---

### 3️⃣ **INFORMAÇÕES DO PARCEIRO**

#### 👤 Obter Dados do Parceiro Autenticado
```http
GET /api/partner
Authorization: Bearer {{api_token}}
```

**Resposta Esperada:**
```json
{
    "id": 1,
    "name": "Parceiro Teste LTDA",
    "email": "contato@parceiroteste.com.br",
    "document": "12345678000199",
    "api_token": "abc123...",
    "is_active": true,
    "created_at": "2025-12-24T10:00:00.000000Z",
    "updated_at": "2025-12-24T10:00:00.000000Z"
}
```

---

## 📊 Exemplos de Casos de Uso

### Caso 1: Venda Parcelada
```json
{
    "end_customer_id": 1,
    "total_amount": 5400.00,
    "transaction_type": "credit",
    "installments": 6,
    "description": "Venda de produto - 6x de R$ 900,00"
}
```

### Caso 2: Compra à Vista
```json
{
    "end_customer_id": 1,
    "total_amount": 1200.00,
    "transaction_type": "debit",
    "installments": 1,
    "description": "Compra à vista com desconto"
}
```

### Caso 3: Assinatura Mensal
```json
{
    "end_customer_id": 1,
    "total_amount": 99.90,
    "transaction_type": "credit",
    "installments": 1,
    "description": "Assinatura mensal - Plano Premium"
}
```

### Caso 4: Financiamento Longo Prazo
```json
{
    "end_customer_id": 1,
    "total_amount": 24000.00,
    "transaction_type": "credit",
    "installments": 24,
    "description": "Financiamento 24 meses - R$ 1.000,00/mês"
}
```

---

## 🔍 Validações

### Campos Obrigatórios

**Parceiro:**
- ✅ name (string, máx: 255)
- ✅ email (email único)
- ✅ document (string único)
- ⚪ is_active (boolean, padrão: true)

**Cliente Final:**
- ✅ partner_id (existe em partners)
- ✅ name (string, máx: 255)
- ✅ document (string único)

**Registro de Valor:**
- ✅ partner_id (existe em partners) - *Apenas Web*
- ✅ end_customer_id (existe em end_customers)
- ✅ total_amount (numérico, >= 0)
- ✅ transaction_type (credit ou debit)
- ✅ installments (inteiro, >= 1)
- ⚪ description (string)

---

## 🛡️ Códigos de Status HTTP

| Código | Significado |
|--------|-------------|
| 200 | Sucesso (GET, PUT) |
| 201 | Criado (POST) |
| 204 | Sem Conteúdo (DELETE) |
| 400 | Requisição Inválida |
| 401 | Não Autorizado |
| 403 | Proibido |
| 404 | Não Encontrado |
| 422 | Entidade Não Processável (Erros de Validação) |
| 500 | Erro do Servidor |

---

## 🚀 Como Usar

### Passo 1: Importe a Collection no Postman
1. Abra o Postman
2. Clique em "Import"
3. Selecione o arquivo `Registradora_API.postman_collection.json`

### Passo 2: Configure as Variáveis
1. Vá em "Environments" ou clique no ícone de olho no canto superior direito
2. Configure:
   - `base_url`: http://localhost:8000 (ou sua URL)
   - `api_token`: Cole o token obtido ao criar um parceiro

### Passo 3: Obter Token API
1. Acesse o sistema web como admin: http://localhost:8000/login
2. Vá em "Admin > Parceiros > Adicionar Parceiro"
3. Preencha os dados e clique em "Salvar"
4. Após criar, clique em "Editar" no parceiro
5. Copie o `api_token` exibido na tela
6. Cole na variável `api_token` do Postman

### Passo 4: Teste as Requisições
1. Comece testando "API - Parceiros > Informações do Parceiro"
2. Se retornar os dados do parceiro, está funcionando! ✅
3. Crie clientes com "Customers > Criar Cliente"
4. Crie registros com "Records > Criar Registro"

---

## ⚠️ IMPORTANTE: Formato do Header

**O header de autorização DEVE ser:**
```
Authorization: Bearer SEU_TOKEN_AQUI
```

**NÃO esqueça da palavra "Bearer" antes do token!**

---

## 💡 Dicas

- 🔐 As rotas `/api/*` requerem autenticação via Bearer Token
- 🌐 As rotas `/admin/*` requerem autenticação web (sessão) e CSRF token
- 📊 O valor da parcela é calculado automaticamente: `total_amount / installments`
- ♻️ Todos os registros usam soft delete (exclusão lógica)
- 🔄 O token API pode ser regenerado na área de edição do parceiro

---

## 📝 Notas Importantes

1. **CSRF Token (Web)**: Obtenha o token CSRF do formulário HTML para requisições web
2. **API Token**: O token do parceiro é gerado automaticamente na criação
3. **Soft Delete**: Registros excluídos não são removidos permanentemente
4. **Relacionamentos**: Um cliente pertence a um parceiro; um registro pertence a um parceiro e um cliente
5. **Parcelamento**: O sistema calcula automaticamente o valor de cada parcela
