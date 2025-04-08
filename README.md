# 🔐 Gerenciador de Tokens com Laravel Sanctum e Filament

Este projeto é uma aplicação desenvolvida com **Laravel 12**, utilizando **Laravel Sanctum** para autenticação via tokens de API e **Filament PHP** como painel administrativo.

O foco principal do projeto é permitir a criação, visualização e gerenciamento de tokens personalizados para consumo seguro de APIs, com uma interface amigável e moderna.

---

## 🎯 Motivação

Este projeto foi criado para estudo e prática das autenticações baseadas em token, além de explorar os recursos avançados do Filament para gerenciamento de dados de forma segura e elegante.

---

## ⚙️ Tecnologias Utilizadas

- **Laravel 12** — framework robusto e produtivo para desenvolvimento backend
- **Sanctum** — autenticação via tokens com escopos e expiração configurável
- **Filament PHP** — painel administrativo reativo e personalizável
- **SQLite** — banco de dados leve e fácil de configurar para ambientes locais

---

## 🧩 Funcionalidades Técnicas

- Criação de tokens de acesso via painel administrativo
- Definição de permissões customizadas (abilities)
- Data de expiração opcional por token
- Exibição do token gerado diretamente na interface, com botão de **cópia para área de transferência**
- Relação direta entre usuários e seus tokens (via `RelationManager`)
- Notificações visuais para feedback imediato do usuário

---

## 🔐 Segurança

- Os tokens gerados são exibidos **somente no momento da criação**, seguindo as boas práticas do Laravel Sanctum
- O valor armazenado no banco é um hash criptografado, não sendo possível descriptografar posteriormente
- A implementação segue o princípio de **privacidade mínima** dos dados sensíveis

---

## 📌 Observações

- O projeto utiliza o `RelationManager` para vincular tokens diretamente a cada usuário, facilitando o controle e visualização por parte do administrador.

---

## 🤝 Contribuições

Este projeto é pessoal e está em constante evolução. Sugestões são bem-vindas!

