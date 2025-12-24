# 🔐 API com UUID - Documentação Atualizada

## ⚡ Mudanças Importantes

A API agora usa **UUIDs** ao invés de IDs sequenciais para maior segurança e evitar exposição de dados.

---

## 🔄 Antes vs Depois

### ❌ Antes (IDs sequenciais)
```
GET /api/customers/1
GET /api/customers/2
GET /api/records/1
```

### ✅ Agora (UUIDs)
```
GET /api/customers/550e8400-e29b-41d4-a716-446655440000
GET /api/customers/6ba7b810-9dad-11d1-80b4-00c04fd430c8
GET /api/records/7c9e6679-7425-40de-944b-e07fc1f90ae7
```

---

## 📋 Exemplos de Uso Atualizados

### 1️⃣ **Listar Clientes**
```bash
curl -X GET http://localhost:8000/api/customers \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json"
```

**Resposta:**
```json
[
    {
        "uuid": "550e8400-e29b-41d4-a716-446655440000",
        "name": "João da Silva",
        "document": "12345678901",
        "created_at": "2025-12-24T10:30:00.000000Z",
        "updated_at": "2025-12-24T10:30:00.000000Z"
    }
]
```

---

### 2️⃣ **Criar Cliente**
```bash
curl -X POST http://localhost:8000/api/customers \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Maria Santos",
    "document": "98765432100"
  }'
```

**Resposta:**
```json
{
    "uuid": "6ba7b810-9dad-11d1-80b4-00c04fd430c8",
    "name": "Maria Santos",
    "document": "98765432100",
    "created_at": "2025-12-24T11:00:00.000000Z",
    "updated_at": "2025-12-24T11:00:00.000000Z"
}
```

---

### 3️⃣ **Visualizar Cliente (usando UUID)**
```bash
curl -X GET http://localhost:8000/api/customers/550e8400-e29b-41d4-a716-446655440000 \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json"
```

---

### 4️⃣ **Atualizar Cliente (usando UUID)**
```bash
curl -X PUT http://localhost:8000/api/customers/550e8400-e29b-41d4-a716-446655440000 \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "João da Silva Atualizado",
    "document": "12345678901"
  }'
```

---

### 5️⃣ **Deletar Cliente (usando UUID)**
```bash
curl -X DELETE http://localhost:8000/api/customers/550e8400-e29b-41d4-a716-446655440000 \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json"
```

---

## 💰 Registros de Valores com UUID

### **⚠️ Mudança no Campo**
Agora use `end_customer_uuid` ao invés de `end_customer_id`

### 1️⃣ **Criar Registro**
```bash
curl -X POST http://localhost:8000/api/records \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "end_customer_uuid": "550e8400-e29b-41d4-a716-446655440000",
    "total_amount": 3500.00,
    "transaction_type": "credit",
    "installments": 5,
    "description": "Pagamento via API"
  }'
```

**Resposta:**
```json
{
    "uuid": "7c9e6679-7425-40de-944b-e07fc1f90ae7",
    "customer": {
        "uuid": "550e8400-e29b-41d4-a716-446655440000",
        "name": "João da Silva"
    },
    "total_amount": "3500.00",
    "transaction_type": "credit",
    "installments": 5,
    "installment_amount": "700.00",
    "description": "Pagamento via API",
    "created_at": "2025-12-24T12:00:00.000000Z",
    "updated_at": "2025-12-24T12:00:00.000000Z"
}
```

### 2️⃣ **Listar Registros**
```bash
curl -X GET http://localhost:8000/api/records \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json"
```

**Resposta:**
```json
[
    {
        "uuid": "7c9e6679-7425-40de-944b-e07fc1f90ae7",
        "customer": {
            "uuid": "550e8400-e29b-41d4-a716-446655440000",
            "name": "João da Silva",
            "document": "12345678901"
        },
        "total_amount": "3500.00",
        "transaction_type": "credit",
        "installments": 5,
        "installment_amount": "700.00",
        "description": "Pagamento via API",
        "created_at": "2025-12-24T12:00:00.000000Z",
        "updated_at": "2025-12-24T12:00:00.000000Z"
    }
]
```

### 3️⃣ **Visualizar Registro (usando UUID)**
```bash
curl -X GET http://localhost:8000/api/records/7c9e6679-7425-40de-944b-e07fc1f90ae7 \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json"
```

### 4️⃣ **Atualizar Registro (usando UUID)**
```bash
curl -X PUT http://localhost:8000/api/records/7c9e6679-7425-40de-944b-e07fc1f90ae7 \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "end_customer_uuid": "550e8400-e29b-41d4-a716-446655440000",
    "total_amount": 4000.00,
    "transaction_type": "credit",
    "installments": 4,
    "description": "Valor atualizado"
  }'
```

### 5️⃣ **Deletar Registro (usando UUID)**
```bash
curl -X DELETE http://localhost:8000/api/records/7c9e6679-7425-40de-944b-e07fc1f90ae7 \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json"
```

---

## 🔄 Migrando Código Existente

### Se você já tinha código usando IDs:

**Antes:**
```javascript
// Listar cliente por ID
const response = await fetch(`/api/customers/1`);

// Criar registro com ID do cliente
const data = {
    end_customer_id: 1,
    total_amount: 1500.00,
    // ...
};
```

**Depois:**
```javascript
// Listar cliente por UUID
const response = await fetch(`/api/customers/550e8400-e29b-41d4-a716-446655440000`);

// Criar registro com UUID do cliente
const data = {
    end_customer_uuid: "550e8400-e29b-41d4-a716-446655440000",
    total_amount: 1500.00,
    // ...
};
```

---

## ✅ Vantagens do UUID

1. **🔒 Segurança**: Não expõe quantidade de registros
2. **🎲 Imprevisível**: Impossível adivinhar IDs
3. **🌐 Único Globalmente**: Pode ser usado em sistemas distribuídos
4. **📊 Escalabilidade**: Não depende de sequência única do banco

---

## 📝 Validações

### Campos que mudaram:

| Campo Antigo | Campo Novo | Descrição |
|--------------|------------|-----------|
| `end_customer_id` | `end_customer_uuid` | UUID do cliente final |
| URL com `/customers/1` | URL com `/customers/{uuid}` | Rota com UUID |
| URL com `/records/1` | URL com `/records/{uuid}` | Rota com UUID |

---

## 🚀 Executar Migration

Para aplicar as mudanças no banco de dados:

```bash
php artisan migrate
```

Isso irá:
- ✅ Adicionar coluna `uuid` nas tabelas
- ✅ Criar índices únicos
- ✅ Gerar UUIDs automaticamente para novos registros

---

## 🧪 Testando

### 1. Rodar migration:
```bash
php artisan migrate
```

### 2. Criar um cliente:
```bash
curl -X POST http://localhost:8000/api/customers \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"name": "Teste UUID", "document": "11111111111"}'
```

### 3. Copiar o UUID retornado

### 4. Usar o UUID para criar um registro:
```bash
curl -X POST http://localhost:8000/api/records \
  -H "Authorization: Bearer SEU_TOKEN" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{
    "end_customer_uuid": "UUID_COPIADO_AQUI",
    "total_amount": 1000.00,
    "transaction_type": "credit",
    "installments": 1,
    "description": "Teste"
  }'
```

---

## 💡 Notas Importantes

- ✅ UUIDs são gerados automaticamente na criação
- ✅ IDs internos (incrementais) ainda existem no banco, mas não são expostos na API
- ✅ Todas as buscas e operações na API agora usam UUID
- ✅ Compatível com sistemas existentes (IDs internos mantidos para relationships)

---

Pronto! Sua API agora é mais segura com UUIDs! 🎉
