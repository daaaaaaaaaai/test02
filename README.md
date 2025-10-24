

# test02 — デプロイとセットアップ

このリポジトリは Laravel アプリケーションです。以下の README は共有ホスティング（例: XREA）環境向けに、`.git` を webroot に残さないデプロイ手順、`public` を URL に含めない設定、セキュリティ強化、検査手順、サーバ側での GitHub デプロイキーの作り方などをまとめたものです。

---

## 関連ファイル
- `deploy/server_deploy.sh` — サーバ側デプロイスクリプト（`releases/` を作成し、公開フォルダ `test02` を切り替えます）
- `.github/workflows/deploy.yml` — 任意の GitHub Actions ワークフロー（rsync over SSH）
- `README_DEPLOY.md` — 簡易デプロイ手順（補助）

---

## 1) GitHub からの初回配布（webroot に `.git` を置かない）
推奨フロー（サーバ側）：一時ディレクトリへ shallow clone → タイムスタンプ付きのリリースディレクトリを webroot の外に作成 → `releases` の該当ディレクトリを webroot に物理コピーして切り替える（`test02` 直下に `app` などが配置される）

サーバ上でデプロイユーザーとして実行する例（重要: リリースは webroot の外に作る）：

```bash
# リリース保存ルート + 一時ディレクトリ作成
HOME_ROOT="/virtual/xdaidaix"
PROJECT_NAME="test02"
WEB_ROOT="$HOME_ROOT/public_html/$PROJECT_NAME"
RELEASE_ROOT="$HOME_ROOT/releases/$PROJECT_NAME"
RELEASE_DIR="$RELEASE_ROOT/$(date -u +%Y%m%d%H%M%S)"
TMPDIR="$RELEASE_ROOT/deploy_$$"
mkdir -p "$RELEASE_DIR" "$TMPDIR"

# 一時ディレクトリへ clone
git clone --depth 1 --branch main https://github.com/daaaaaaaaaai/test02.git "$TMPDIR"

# .git を除いて rsync でリリースディレクトリへコピー
rsync -a --delete --exclude='.git' "$TMPDIR/" "$RELEASE_DIR/"
rm -rf "$TMPDIR"

# 所有者・パーミッションを整える
chown -R $(whoami):$(id -gn) "$RELEASE_DIR" || true
find "$RELEASE_DIR" -type d -exec chmod 755 {} +
find "$RELEASE_DIR" -type f -exec chmod 644 {} +

# 公開フォルダへ
mv "$RELEASE_DIR" "$WEB_ROOT"
```

補足:
- リリースを webroot の外に置くことで、`releases/` 配下のファイルが直接外部に露出することを防げます（`releases` の場所はホスティング環境に合わせて変更してください）。
- スクリプト側で `git archive` を試みる場合がありますが、ホスティング環境やプロトコルにより `git-upload-archive` が使えないことがあります。その場合は `git clone` にフォールバックします。
- 非公開リポジトリの場合は、サーバで Deploy Key を作成して GitHub に登録してください（セクション7参照）。

---

## 2) public の中身をウェブルートに移動する方法（あなたの指定）
ホスティングの都合で DocumentRoot を変更できない、または `public` を含めない URL にしたい場合は、`public` フォルダの中身をそのままウェブルート（例: `/virtual/xdaidaix/public_html/test02`）にコピーして運用すると分かりやすいです。ただしその際は `public/index.php` のパス（autoload と bootstrap）を修正する必要があります。

以下は安全に移行するための手順例（サーバで実行）。必ず本番前にバックアップしてください。

```bash
cp -a public public_backup
cp -a public/. .

sed -i "s|require __DIR__.'/../vendor/autoload.php';|require __DIR__.'/vendor/autoload.php';|g" index.php
sed -i "s|require_once __DIR__.'/../bootstrap/app.php';|require_once __DIR__.'/bootstrap/app.php';|g" index.php

rm -rf public_backup

# 4) .env は必ずウェブルート外、またはファイル権限を厳しくする
# （例: 600, 所有者はデプロイユーザ）
chmod 600 .env || true

# Laravel のキャッシュクリア
php82cli artisan config:clear || true
php82cli artisan cache:clear || true
php82cli artisan view:clear || true
php82cli artisan route:clear || true

# Laravel のキャッシュ再作成
php82cli artisan config:cache || true
php82cli artisan route:cache || true
php82cli artisan view:cache || true
```

注意点:
- `rsync` のパス `/path/to/your/repo/public/` はデプロイ時のリリースディレクトリ（`/virtual/.../releases/.../public`）に置き換えてください。README のデプロイ部分と合わせて運用するのが良いです。
- `sed` の変更は必ずバックアップ（`.bak`）を残すか、手動で確認してください。環境により require パスの形式が異なることがあります。

---

## 3) .htaccess とセキュリティ設定（重要）
`public` をウェブルートに移動する場合、いくつかのアクセス制御を強化する必要があります。以下は推奨の `.htaccess` 設定例をウェブルート（`/virtual/xdaidaix/public_html/test02/.htaccess`）に置く想定です。

1) .htaccessの修正

```apache
# BLOCK SENSITIVE FILES (safe for .htaccess context)
<FilesMatch "^(\.env|composer\.json|composer\.lock|package-lock\.json|README\.md)$">
    <IfModule mod_authz_core.c>
        Require all denied
    </IfModule>
    <IfModule !mod_authz_core.c>
        Order allow,deny
        Deny from all
    </IfModule>
</FilesMatch>

# Deny access to .git folder and non-public directories via Rewrite
<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^\.git/ - [F,L,NC]
    RewriteRule ^vendor/ - [F,L,NC]
    RewriteRule ^storage/ - [F,L,NC]
</IfModule>

# --- Laravel default rules (kept) ---
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Handle X-XSRF-Token Header
    RewriteCond %{HTTP:x-xsrf-token} .
    RewriteRule .* - [E=HTTP_X_XSRF_TOKEN:%{HTTP:X-XSRF-Token}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

2) 修正確認(403/404 になれば成功)
```bash
# .git HEAD (期待: 403 or 404)
curl -I 'http://xdaidaix.s323.xrea.com/test02/.git/HEAD'

# vendor/autoload.php (期待: 403 が良い)
curl -I 'http://xdaidaix.s323.xrea.com/test02/vendor/autoload.php'
```


2) 静的ファイルは通常通り配信（例: キャッシュ制御や gzip は別途）

3) `.git` ディレクトリや `.env` が公開されていた場合の緊急対応:
- 直ちに該当鍵・パスワード・APIキーをローテーションすること。
- 可能ならば影響のあるコミットを調査し、必要に応じて GitHub 上での鍵の再発行・パスワード変更を行う。

---

## 4) デプロイ後の注意点（public をウェブルート直下に置く場合）
- `vendor` や `bootstrap` など、`index.php` から参照されるファイルは `public` を移動した場所（今回の例では `test02` 直下）から正しく参照できるようパスを修正してください。
- `storage` や `bootstrap/cache` のパーミッションは適切に設定してください（例: ディレクトリ 775、ファイル 664 など）。
- 自動デプロイを行う場合は、デプロイスクリプトで `rsync` を使い、`.git` を除外した上で一時ディレクトリへ展開→パーミッション調整→原子的に置換する流れにしてください（`deploy/server_deploy.sh` はその例を含んでいます）。

---

## 5) 開発フロー: ローカル → GitHub → レンタルサーバ
ローカル側（開発者）:

```bash
git checkout -b feature/xyz
# ローカルで編集・確認
git add .
git commit -m "Fix: ..."
git push origin feature/xyz
# PR を作成して main にマージすることを推奨
```

サーバ側（手動 pull の例）:

```bash
ssh -p 22 xdaidaix@s323.xrea.com
cd ~/public_html/test02 || cd ~/test02
git fetch origin
git checkout main
git pull origin main
chmod +x deploy/server_deploy.sh
./deploy/server_deploy.sh main
```

または、付属の GitHub Actions ワークフローを用いて `rsync` でサーバへプッシュする方法もあります。そちらを使う場合は GitHub Secrets（例: `DEPLOY_KEY`）の設定が必要です（`README_DEPLOY.md` を参照）。

---

## 6) デプロイ後の作業
- キャッシュ再構築（Laravel）:

```bash
cd /virtual/xdaidaix/public_html/test02
php82cli artisan config:cache || true
php82cli artisan route:cache || true
php82cli artisan view:cache || true
```

- `storage` と `bootstrap/cache` の所有権・パーミッション確認:

```bash
chown -R xdaidaix:hpusers /virtual/xdaidaix/public_html/test02/storage
chmod -R 775 /virtual/xdaidaix/public_html/test02/storage
chmod -R 775 /virtual/xdaidaix/public_html/test02/bootstrap/cache
```

- ログ確認:

```bash
tail -n 200 /virtual/xdaidaix/public_html/test02/storage/logs/laravel.log
```

- ロールバック: `releases/` 配下の以前のリリースを webroot に再配置（rsync）することで可能。

例:

```bash
# 例: 古いリリースに戻す（安全に同期）
rsync -a --delete /virtual/xdaidaix/releases/test02/20250101000000/ /virtual/xdaidaix/public_html/test02/
```

---

## 7) サーバ側: SSH 鍵を生成して GitHub の Deploy Key として登録する
サーバ上（デプロイユーザー `xdaidaix` として）:

```bash
# 1) ed25519 鍵を作成（自動化のためパスフレーズ無しを想定）
ssh-keygen -t ed25519 -f ~/.ssh/deploy_key -C "deploy@xdaidaix" -N ''

# 権限を整える
chmod 600 ~/.ssh/deploy_key
chmod 644 ~/.ssh/deploy_key.pub
chmod 700 ~/.ssh

# 2) SSH 設定（任意）: GitHub でこの鍵を使うよう指定
cat >> ~/.ssh/config <<'EOF'
Host github.com
  HostName github.com
  User git
  IdentityFile ~/.ssh/deploy_key
  IdentitiesOnly yes
EOF
chmod 600 ~/.ssh/config

# 3) 公開鍵を表示してコピー
cat ~/.ssh/deploy_key.pub

# 4) GitHub 上で: リポジトリ -> Settings -> Deploy keys -> Add deploy key
# - Title: XREA deploy (read-only)
# - 公開鍵を貼り付け
# - 必要でなければ write access は付けない

# 5) SSH 接続テスト
ssh -T git@github.com
```

注意:
- Deploy Key はリポジトリ単位の設定です。複数リポジトリに対してはそれぞれ追加するか、別途管理方針を決めてください。
- 非公開リポジトリを HTTPS で扱う場合は Personal Access Token を使う方法もありますが、自動化時はシークレット管理に注意してください。

---

この内容を `DEPLOYMENT.md` に分割する、またはさらに自動化（ヘルスチェックや `vendor` のアーティファクト転送）を追加したい場合は指示ください。
