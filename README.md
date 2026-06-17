# Homzy — Plataforma de Conexão entre Donos de Imóveis e Profissionais de Limpeza

> Homzy é uma aplicação Laravel para gerenciar serviços de limpeza, conectar proprietários de imóveis a profissionais de limpeza e controlar solicitações, candidaturas e agendamentos.

---

## Visão Geral

Homzy oferece:
- Cadastro e login de usuários (donos de imóvel e profissionais de limpeza)
- Painel do proprietário para criar serviços, visualizar solicitações e aceitar/rejeitar candidatos
- Painel do profissional para consultar ofertas, aplicar a vagas e acompanhar serviços agendados
- Filtro de vagas por melhor avaliação e jobs mais recentes
- Visualização de detalhes do imóvel e status do serviço

---

## Placeholder de Imagens

| Página inicial | Detalhes do serviço |
|---------------|-------|---------------------|
| ![Home]<img width="1898" height="939" alt="image" src="https://github.com/user-attachments/assets/31749ba4-bbf2-4db2-b0a9-4c608838c021" /> | ![Job Details]<img width="1900" height="937" alt="image" src="https://github.com/user-attachments/assets/da3bf28f-8816-4bb4-984b-0047f47b24df" /> |

---

## Funcionalidades Principais

- Autenticação de usuário com login e logout
- Controle de acesso por tipo de usuário:
  - PROPERTY_OWNER (Proprietários de imóveis)
  - PROFESSIONAL_CLEANER (Profissionais de limpeza)
- Criação de solicitações de limpeza pelo proprietário
- Listagem de vagas disponíveis para profissionais
- Aplicação a vagas com mensagem opcional
- Aceitar ou rejeitar candidaturas
- Estatísticas simples de agendamentos e serviços concluídos
- Busca de profissionais de limpeza
- Interface responsiva com Tailwind CSS

---

## Stack Tecnológica

- PHP 8.3
- Laravel 13
- Tailwind CSS
- Vite
- MySQL
- Blade Templates

---

## Rotas Importantes

- / — página inicial com ofertas de limpeza e painel do usuário
- /login-page — página de login
- /login — submissão do login
- /logout — logout do usuário
- /findcleaners — lista de profissionais disponíveis
- /cleanerdetails/{slug} — detalhes do profissional
- /jobdetails/{slug} — detalhes do serviço de limpeza
- /job/create — formulário para criar nova solicitação (proprietário)
- /job/store — gravação da solicitação de limpeza
- /accept-application/{slug} — aceitar candidatura
- /reject-application/{slug} — rejeitar candidatura

---

## Instalação Local

`bash
git clone <seu-repositório> homzy
cd homzy
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run dev
php artisan serve
`

> Caso esteja usando Laragon, ajuste o banco de dados em .env para o ambiente local.

---

## Configuração Básica

1. Copie .env.example para .env
2. Configure as credenciais do banco de dados (DB_DATABASE, DB_USERNAME, DB_PASSWORD)
3. Gere a chave de aplicativo: php artisan key:generate
4. Execute as migrações: php artisan migrate


