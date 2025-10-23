#!/usr/bin/env bash
set -euo pipefail

# server_deploy.sh
# Server-side deploy script (pull-based, no GitHub Actions secrets required)
# Requirements on server:
# - git, rsync, tar, php (optional), composer or composer.phar (optional)
# - a deploy SSH key whose public key is added as a GitHub "Deploy key" (read-only)
# - this script should run as the deploy user which owns the webroot

#########################
# Configuration (edit or export as env vars)
REPO="https://github.com/daaaaaaaaaai/test02.git"
BRANCH="main"
DEPLOY_PATH="/virtual/xdaidaix/public_html/test02"   # path that will contain `releases/` and `current`
KEEP_RELEASES=5

# Optional toggles
RUN_COMPOSER=true   # set to false if composer is not available on server
RUN_ARTISAN=false   # set to true to run migrations + caches (use with caution)

#########################

timestamp() { date -u +%Y%m%d%H%M%S; }
log() { echo "[deploy][$(date -u +%Y-%m-%dT%H:%M:%SZ)] $*"; }

if [ -n "${1-}" ] && [ "$1" = "--help" ]; then
  echo "Usage: $0 [branch]" && exit 0
fi

BRANCH=${1:-$BRANCH}
RELEASE_DIR="$(timestamp)"
TARGET_DIR="$DEPLOY_PATH/releases/$RELEASE_DIR"

log "Starting deploy of $REPO#$BRANCH to $TARGET_DIR"

mkdir -p "$TARGET_DIR"

# Prefer using git archive over SSH to avoid leaving .git on the server
if command -v git >/dev/null 2>&1; then
  log "Attempting git archive to export repository (no .git created)"
  # Try git archive first; GitHub may not support git-upload-archive, so fall back to shallow clone on failure
  if git archive --remote="$REPO" "$BRANCH" | tar -x -C "$TARGET_DIR"; then
    log "git archive succeeded"
  else
    log "git archive failed, falling back to shallow clone and rsync"
    tmpdir="/tmp/deploy_$RELEASE_DIR"
    rm -rf "$tmpdir" && mkdir -p "$tmpdir"
    git clone --depth 1 --branch "$BRANCH" "$REPO" "$tmpdir"
    rsync -a --delete --exclude='.git' "$tmpdir/" "$TARGET_DIR/"
    rm -rf "$tmpdir"
  fi
else
  log "git not available: falling back to shallow clone and cleanup"
  tmpdir="/tmp/deploy_$RELEASE_DIR"
  rm -rf "$tmpdir" && mkdir -p "$tmpdir"
  git clone --depth 1 --branch "$BRANCH" "$REPO" "$tmpdir"
  rsync -a --delete --exclude='.git' "$tmpdir/" "$TARGET_DIR/"
  rm -rf "$tmpdir"
fi

# Set permissions (adjust user/group as needed)
USER_NAME=$(whoami)
# prefer primary group name; if id -gn fails, fall back to username
GROUP_NAME=$(id -gn 2>/dev/null || true)
if [ -z "$GROUP_NAME" ]; then
  GROUP_NAME="$USER_NAME"
fi
log "Setting ownership to $USER_NAME:$GROUP_NAME"
if chown -R "$USER_NAME:$GROUP_NAME" "$TARGET_DIR" 2>/dev/null; then
  :
else
  log "Warning: group $GROUP_NAME may not exist; setting owner only"
  chown -R "$USER_NAME" "$TARGET_DIR" || true
fi
find "$TARGET_DIR" -type d -exec chmod 755 {} +
find "$TARGET_DIR" -type f -exec chmod 644 {} +

# Symlink switch
ln -nfs "$TARGET_DIR" "$DEPLOY_PATH/current"
log "Switched current -> $TARGET_DIR"

# Optional post-deploy steps
if [ "$RUN_COMPOSER" = true ] ; then
  if command -v composer >/dev/null 2>&1 || [ -f "$DEPLOY_PATH/current/composer.phar" ]; then
    log "Running composer install (no-dev, optimize-autoloader)"
    (cd "$DEPLOY_PATH/current" && if command -v composer >/dev/null 2>&1; then composer install --no-dev --optimize-autoloader; else php composer.phar install --no-dev --optimize-autoloader; fi)
  else
    log "composer not found on server; skipping composer install"
  fi
fi

if [ "$RUN_ARTISAN" = true ] ; then
  if command -v php >/dev/null 2>&1; then
    log "Running artisan commands: migrate (force) + cache rebuild"
    (cd "$DEPLOY_PATH/current" && php artisan migrate --force || true)
    (cd "$DEPLOY_PATH/current" && php artisan config:cache || true)
    (cd "$DEPLOY_PATH/current" && php artisan route:cache || true)
    (cd "$DEPLOY_PATH/current" && php artisan view:cache || true)
  else
    log "php not found on server; skipping artisan tasks"
  fi
fi

# Cleanup old releases
log "Cleaning up old releases, keeping $KEEP_RELEASES"
cd "$DEPLOY_PATH/releases"
ls -1tr | head -n -$KEEP_RELEASES | xargs -r rm -rf -- || true

log "Deploy finished"

exit 0
