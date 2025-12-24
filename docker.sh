#!/bin/bash

# Script para gerenciar o ambiente Docker do projeto Nossa Paroquia Online

case "$1" in
    "up")
        echo "🚀 Subindo o ambiente Docker..."
        cp env.docker .env
        docker-compose up -d
        echo "⏳ Aguardando serviços iniciarem..."
        sleep 10
        echo "🔑 Gerando chave da aplicação..."
        docker-compose exec app php artisan key:generate
        echo "📦 Executando migrações..."
        docker-compose exec app php artisan migrate
        echo "✅ Ambiente Docker está rodando!"
        echo "🌐 Acesse: http://localhost:8089"
        echo "🗄️  MySQL: localhost:3309"
        echo "📊 Redis: localhost:6389"
        ;;
    "down")
        echo "🛑 Parando o ambiente Docker..."
        docker-compose down
        ;;
    "restart")
        echo "🔄 Reiniciando o ambiente Docker..."
        docker-compose down
        docker-compose up -d
        ;;
    "logs")
        docker-compose logs -f
        ;;
    "shell")
        echo "🐚 Abrindo shell no container da aplicação..."
        docker-compose exec app bash
        ;;
    "artisan")
        shift
        docker-compose exec app php artisan "$@"
        ;;
    "composer")
        shift
        docker-compose exec app composer "$@"
        ;;
    "mysql")
        echo "🗄️  Conectando ao MySQL..."
        docker-compose exec mysql mysql -u registradora -p registradora
        ;;
    "build")
        echo "🔨 Construindo imagens Docker..."
        docker-compose build --no-cache
        ;;
    *)
        echo "📋 Comandos disponíveis:"
        echo "  up       - Sobe o ambiente Docker"
        echo "  down     - Para o ambiente Docker"
        echo "  restart  - Reinicia o ambiente Docker"
        echo "  logs     - Mostra logs dos containers"
        echo "  shell    - Abre shell no container da aplicação"
        echo "  artisan  - Executa comandos do Artisan"
        echo "  composer - Executa comandos do Composer"
        echo "  mysql    - Conecta ao MySQL"
        echo "  build    - Reconstrói as imagens Docker"
        echo ""
        echo "Exemplos:"
        echo "  ./docker.sh up"
        echo "  ./docker.sh artisan migrate"
        echo "  ./docker.sh composer install"
        ;;
esac
