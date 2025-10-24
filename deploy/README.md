# サーバ側プル方式デプロイ手順（Secrets不要）

目的: GitHub Secrets を使わずに、サーバ側からリポジトリを pull して差分デプロイする方法を説明します。

前提
- サーバに `git` が入っていることが望ましい（なくても shallow clone + rsync で対応可能）。
- サーバから GitHub へ接続可能であること（推奨: GitHub のリポジトリにサーバの公開鍵を "Deploy key" として登録する）。
- サーバでこのスクリプトを実行するユーザがデプロイ先ディレクトリ（例: `/home/xdaidaix/www/test02`）に書き込み権限を持っていること。

手順
1. サーバに公開鍵を登録
   - GitHub リポジトリ > Settings > Deploy keys にサーバの公開鍵を追加（Read-only 推奨）。
   - 例: サーバで `ssh-keygen -t ed25519 -f ~/.ssh/deploy_key` を実行し、`~/.ssh/deploy_key.pub` を GitHub に登録。

2. ディレクトリ構成を作る
   - 例: `/home/xdaidaix/www/test02/releases` と `/home/xdaidaix/www/test02/current` を用意

3. スクリプトの設定
   - `deploy/server_deploy.sh` の先頭にある `REPO`、`DEPLOY_PATH` を実プロジェクトに合わせて編集します。
   - 必要なら `RUN_COMPOSER` や `RUN_ARTISAN` を true/false に切り替えます。

4. 手動実行テスト

```bash
# サーバ上で
cd ~
chmod +x /home/xdaidaix/www/test02/deploy/server_deploy.sh
/home/xdaidaix/www/test02/deploy/server_deploy.sh main
```

5. 自動化（任意）
- サーバ側で cron に追加して定期 pull/デプロイする、もしくは GitHub Webhook + 受信用のシンプルな webhook handler を用意してデプロイをトリガーできます（Webhook の場合は受け口に認証を入れてください）。

注意点
- GitHub に公開リポジトリではない場合、Deploy Key の扱いに注意してください。Deploy Key はリポジトリ単位です。
- `.env` や `storage`、`vendor` は公開しない、もしくは `current` に置かれた既存のものを上書きしないよう除外設定を運用してください。
- セキュリティ: サーバの SSH 鍵を安全に保管・制限し、必要なら IP 制限や GitHub の webhook secret を併用してください。

トラブルシューティング
- SSH が GitHub に繋がらない場合、`ssh -T git@github.com` を実行して確認してください。
- パーミッションエラーはファイル所有者と umask を確認してください。

---

この方式だと GitHub Secrets を使わず、サーバ管理者側で公開鍵を登録してもらうだけで差分デプロイができます。必要なら webhook ハンドラや systemd/Tiny service を使った自動トリガーも作ります。