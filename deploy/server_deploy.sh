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
# Separate releases storage (outside webroot) and the public webroot
RELEASE_ROOT="/virtual/xdaidaix/releases/test02"   # where releases are stored (outside webroot)
WEBROOT="/virtual/xdaidaix/public_html/test02"     # the actual public folder that must be a physical directory
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
TARGET_DIR="$RELEASE_ROOT/$RELEASE_DIR"

log "Starting deploy of $REPO#$BRANCH to $TARGET_DIR"

mkdir -p "$TARGET_DIR"
mkdir -p "$RELEASE_ROOT"
mkdir -p "$(dirname "$WEBROOT")"

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

# Publish: copy the new release into the WEBROOT as a physical directory (avoid symlink)
log "Publishing release to webroot (physical copy)"
TMP_WEBROOT="${WEBROOT}.__tmp__.$(timestamp)"
# remove any previous tmp
rm -rf "$TMP_WEBROOT"
mkdir -p "$(dirname "$TMP_WEBROOT")"

# Use rsync to create a new webroot copy, excluding .git
rsync -a --delete --exclude='.git' "$TARGET_DIR/" "$TMP_WEBROOT/"

# set ownership and perms on tmp webroot
if chown -R "$USER_NAME:$GROUP_NAME" "$TMP_WEBROOT" 2>/dev/null; then :; else chown -R "$USER_NAME" "$TMP_WEBROOT" || true; fi
find "$TMP_WEBROOT" -type d -exec chmod 755 {} +
find "$TMP_WEBROOT" -type f -exec chmod 644 {} +

# Atomically swap: remove any existing symlink or directory, then move tmp into place
if [ -L "$WEBROOT" ]; then
  log "Removing existing symlink at $WEBROOT"
  rm -f "$WEBROOT"
fi
if [ -d "$WEBROOT" ]; then
  log "Backing up existing directory to ${WEBROOT}.backup.$(timestamp)"
  mv "$WEBROOT" "${WEBROOT}.backup.$(timestamp)" || true
fi

mv "$TMP_WEBROOT" "$WEBROOT"
log "Published $WEBROOT -> $TARGET_DIR"

# Optional post-deploy steps
if [ "$RUN_COMPOSER" = true ] ; then
  if command -v composer >/dev/null 2>&1 || [ -f "$WEBROOT/composer.phar" ]; then
    log "Running composer install (no-dev, optimize-autoloader)"
    (cd "$WEBROOT" && if command -v composer >/dev/null 2>&1; then composer install --no-dev --optimize-autoloader; else php82cli composer.phar install --no-dev --optimize-autoloader; fi)
  else
    log "composer not found on server; skipping composer install"
  fi
fi

if [ "$RUN_ARTISAN" = true ] ; then
  if command -v php82cli >/dev/null 2>&1; then
    log "Running artisan commands: migrate (force) + cache rebuild"
    (cd "$WEBROOT" && php82cli artisan migrate --force || true)
    (cd "$WEBROOT" && php82cli artisan config:cache || true)
    (cd "$WEBROOT" && php82cli artisan route:cache || true)
    (cd "$WEBROOT" && php82cli artisan view:cache || true)
  else
    log "php82cli not found on server; skipping artisan tasks"
  fi
fi

# Cleanup old releases
log "Cleaning up old releases, keeping $KEEP_RELEASES"
cd "$RELEASE_ROOT"
ls -1tr | head -n -$KEEP_RELEASES | xargs -r rm -rf -- || true

log "Deploy finished"

exit 0
