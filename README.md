
## 🕶️ Loja Virtual de Óculos – Laravel

Uma loja virtual desenvolvida sob medida para uma empresa do setor óptico, com foco em simplicidade, performance e gestão eficiente de produtos.
O projeto prioriza um fluxo de compra rápido e direto, sem integração complexa com gateways de pagamento.

![App Screenshot](https://arturferreira.com/imgs/imgsProjetos/LojaDeOculos.png)

## 🚀 Visão Geral

Esta aplicação foi construída para atender empresas que desejam um catálogo digital profissional, permitindo que os clientes naveguem pelos produtos, adicionem itens ao carrinho e finalizem a compra através do WhatsApp, onde o atendimento é concluído de forma rápida e personalizada.

A plataforma inclui:

- Catálogo completo de óculos

- Carrinho funcional

- Finalização de compra via WhatsApp

- Painel administrativo completo

- Sistema de cupons

- Dashboard com estatísticas em tempo real

Desenvolvida inteiramente em Laravel, oferece estabilidade, segurança e facilidade de manutenção, sendo ideal para pequenas e médias empresas.

## 🛠️ Tecnologias Utilizadas

- Laravel 10

- PHP 8.2

- MySQL

## 📚 Funcionalidades Principais
### 🛒 Funcionalidades da Loja

- Exibição de produtos organizados por categorias e coleções

- Página de detalhes do produto

- Carrinho dinâmico

- Cálculo automático de cupons de desconto

- Envio do pedido diretamente para o WhatsApp da loja

- Inclui resumo da compra

- Quantidade de cada item

- Valor final com desconto

## 🔐 Dashboard Administrativo

Interface completa para gerenciamento da loja:

- Cadastro e edição de produtos

- Controle de categorias

- Gerenciamento de coleções

- Sistema de cupons de desconto

- Upload de imagens

- Controle de estoque

- Produtos esgotados destacados

- Estatísticas em tempo real:

- Total de produtos cadastrados

- Quantidade em estoque

# ⚙️ Como Rodar o Projeto

### 1. Clone o repositório

```bash
  git clone https://github.com/arturnf/Loja-de-oculos.git
  cd Loja-de-oculos
```

### 2. Instale as dependências do backend

```bash
  composer install
```

### 3. Configure o arquivo .env

```bash
  cp .env.example .env
```

### 4. Gere a key da aplicação

```bash
  php artisan key:generate
```

### 5. Rode as migrations

```bash
  php artisan migrate --seed
```

### 6. Inicie o servidor

```bash
  php artisan serve
```

## Autor

- [@arturnf](https://www.github.com/arturnf)


