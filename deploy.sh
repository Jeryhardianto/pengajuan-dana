#!/usr/bin/env bash
# Deploy ke vm-gpu: rsync source, build image, migrate, cetak status.
# Alias SSH `vm-gpu` didefinisikan di dev-ops/home-server/config.
set -euo pipefail

HOST=${DEPLOY_HOST:-vm-gpu}
DIR=${DEPLOY_DIR:-/home/vm-gpu/si-pd}

# Tanpa --delete-excluded: .env.prod di VM harus selamat dari --delete.
# vendor/ tidak dikirim — image membangunnya sendiri lewat composer install.
# --inplace WAJIB: docker/nginx.conf di-bind-mount sebagai berkas tunggal, dan
# rsync default mengganti berkas lewat rename. Rename = inode baru, sedangkan
# mount tetap menunjuk inode lama — container diam-diam memakai conf usang.
rsync -az --delete --inplace \
  --exclude '.git' \
  --exclude '.env*' \
  --exclude '.DS_Store' \
  --exclude 'vendor' \
  --exclude 'node_modules' \
  --exclude 'storage/logs/*.log' \
  --exclude 'storage/app/public/*' \
  ./ "$HOST:$DIR/"

C="docker compose --env-file .env.prod -f compose.prod.yaml"
ssh "$HOST" "cd $DIR && $C up -d --build"
# Perubahan nginx.conf tidak memicu recreate container — muat ulang eksplisit.
ssh "$HOST" "cd $DIR && $C exec -T web nginx -t && $C exec -T web nginx -s reload"
ssh "$HOST" "cd $DIR && $C exec -T app php artisan migrate --force"
ssh "$HOST" "cd $DIR && $C ps"
