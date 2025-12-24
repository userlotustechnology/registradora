# 💰 Sistema de Saldos - Registradora API

## 📊 Visão Geral

O sistema de saldos da Registradora API permite que cada cliente tenha dois tipos de saldo acumulados automaticamente:

### Tipos de Saldo

#### 1. **Saldo Disponível** (`available_balance`)
Representa o saldo imediatamente disponível para uso, calculado como:
- ✅ **Créditos via PIX** (+)
- ✅ **Créditos via Boleto** (+)
- ✅ **Créditos via Outro** (+)
- ❌ **Todos os Débitos** (-)

**Fórmula:** `available_balance = (PIX + Boleto + Outro) - Débitos`

#### 2. **Saldo de Crédito** (`credit_balance`)
Representa o saldo proveniente de pagamentos parcelados, calculado como:
- ✅ **Créditos via Cartão de Crédito** (+)

**Fórmula:** `credit_balance = Cartão de Crédito`

---

## 🔄 Atualização Automática

Os saldos são atualizados **automaticamente** sempre que:
- ✨ Um novo registro de valor é criado
- ✏️ Um registro de valor é atualizado
- 🗑️ Um registro de valor é deletado
- ♻️ Um registro de valor é restaurado

Isso é feito através de um **Observer** (`ValueRecordObserver`) que monitora todas as operações nos registros de valores.

---

## 📝 Exemplos Práticos

### Exemplo 1: Cliente com PIX e Boleto

```json
// Cliente inicial: available_balance = 0, credit_balance = 0

// Adiciona crédito via PIX de R$ 1.000,00
POST /api/records
{
  "end_customer_uuid": "abc-123",
  "total_amount": 1000.00,
  "transaction_type": "credit",
  "payment_type": "pix"
}
// Resultado: available_balance = 1000.00

// Adiciona crédito via Boleto de R$ 500,00
POST /api/records
{
  "end_customer_uuid": "abc-123",
  "total_amount": 500.00,
  "transaction_type": "credit",
  "payment_type": "boleto"
}
// Resultado: available_balance = 1500.00

// Adiciona débito (taxa) de R$ 50,00
POST /api/records
{
  "end_customer_uuid": "abc-123",
  "total_amount": 50.00,
  "transaction_type": "debit",
  "payment_type": "taxa"
}
// Resultado: available_balance = 1450.00
```

### Exemplo 2: Cliente com Cartão de Crédito

```json
// Cliente inicial: available_balance = 0, credit_balance = 0

// Adiciona crédito via Cartão de R$ 2.000,00
POST /api/records
{
  "end_customer_uuid": "def-456",
  "total_amount": 2000.00,
  "transaction_type": "credit",
  "payment_type": "cartao_credito"
}
// Resultado: credit_balance = 2000.00, available_balance = 0
```

### Exemplo 3: Cliente com Múltiplos Tipos

```json
// PIX de R$ 1.000,00
// available_balance = 1000.00, credit_balance = 0

// Cartão de R$ 500,00
// available_balance = 1000.00, credit_balance = 500.00

// Débito de R$ 100,00
// available_balance = 900.00, credit_balance = 500.00

// Saldo Total = 900.00 + 500.00 = R$ 1.400,00
```

---

## 🔍 Consultar Saldos

### Endpoint

```http
GET /api/customers/{uuid}/balance
Authorization: Bearer {api_token}
```

### Resposta

```json
{
  "customer": {
    "uuid": "abc-123-def",
    "name": "João Silva",
    "document": "12345678900"
  },
  "balances": {
    "available_balance": "1450.00",
    "credit_balance": "2000.00",
    "total_balance": "3450.00"
  },
  "breakdown": {
    "pix_boleto_credits": "1500.00",
    "credit_card_credits": "2000.00",
    "total_credits": "3500.00",
    "total_debits": "50.00"
  },
  "transactions_count": 4
}
```

### Campos da Resposta

| Campo | Descrição |
|-------|-----------|
| `available_balance` | Saldo disponível (PIX + Boleto - Débitos) |
| `credit_balance` | Saldo de crédito (Cartão) |
| `total_balance` | Saldo total (disponível + crédito) |
| `pix_boleto_credits` | Total de créditos via PIX/Boleto |
| `credit_card_credits` | Total de créditos via Cartão |
| `total_credits` | Total geral de créditos |
| `total_debits` | Total geral de débitos |
| `transactions_count` | Quantidade de transações |

---

## 🔧 Comandos Úteis

### Recalcular Saldos de Todos os Clientes

Se por algum motivo os saldos ficarem desatualizados, você pode recalculá-los:

```bash
php artisan customers:recalculate-balances
```

Este comando:
- ✅ Percorre todos os clientes
- ✅ Recalcula os saldos baseado em todos os registros
- ✅ Atualiza os campos no banco de dados
- ✅ Mostra barra de progresso

**Quando usar:**
- Após migração de dados
- Após correção manual no banco
- Para validar integridade dos saldos

---

## 💾 Estrutura do Banco de Dados

### Tabela: `end_customers`

```sql
CREATE TABLE end_customers (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  uuid VARCHAR(36) NOT NULL UNIQUE,
  partner_id BIGINT UNSIGNED NOT NULL,
  name VARCHAR(255) NOT NULL,
  document VARCHAR(20) NOT NULL,
  available_balance DECIMAL(15,2) DEFAULT 0 COMMENT 'Saldo disponível (PIX + Boleto)',
  credit_balance DECIMAL(15,2) DEFAULT 0 COMMENT 'Saldo de crédito (Cartão de Crédito)',
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  deleted_at TIMESTAMP NULL
);
```

---

## 🎯 Tipos de Pagamento

### Para CRÉDITO (`transaction_type: "credit"`)

| Tipo | Valor | Vai para |
|------|-------|----------|
| `pix` | PIX | `available_balance` |
| `boleto` | Boleto | `available_balance` |
| `cartao_credito` | Cartão de Crédito | `credit_balance` |
| `outro` | Outros | `available_balance` |

### Para DÉBITO (`transaction_type: "debit"`)

| Tipo | Valor | Desconta de |
|------|-------|-------------|
| `estorno_total` | Estorno Total | `available_balance` |
| `estorno_parcial` | Estorno Parcial | `available_balance` |
| `chargeback` | Chargeback | `available_balance` |
| `taxa` | Taxa | `available_balance` |

---

## ⚠️ Observações Importantes

1. **Saldos são sempre não-negativos por padrão** - O sistema não valida se há saldo suficiente antes de debitar. Isso deve ser implementado na lógica de negócio se necessário.

2. **Débitos sempre afetam o saldo disponível** - Nunca afetam o `credit_balance` diretamente.

3. **Atualização automática** - Não é necessário (nem recomendado) atualizar os saldos manualmente.

4. **Soft deletes** - Registros deletados não afetam o saldo (são ignorados no cálculo).

5. **Concorrência** - Em ambientes de alta concorrência, considere usar transações de banco de dados ou locks para garantir consistência.

---

## 🔐 Segurança

- ✅ Os saldos só podem ser modificados através de registros de valores
- ✅ Parceiros só podem ver saldos de seus próprios clientes
- ✅ Autenticação via Bearer Token é obrigatória
- ✅ Logs de todas as transações são mantidos

---

## 📚 Documentos Relacionados

- [EXEMPLOS_PAYLOADS.md](EXEMPLOS_PAYLOADS.md) - Exemplos de requisições
- [GUIA_RAPIDO_API.md](GUIA_RAPIDO_API.md) - Guia rápido de uso
- [API_UUID_DOCUMENTATION.md](API_UUID_DOCUMENTATION.md) - Documentação sobre UUIDs

---

**Sistema desenvolvido em:** 24 de dezembro de 2025
