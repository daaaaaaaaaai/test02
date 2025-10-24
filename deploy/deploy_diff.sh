#!/bin/bash
# === GitHub 差分デプロイスクリプト ===
# 対象リポジトリ: daaaaaaaaaaai/test02
# ブランチ: main

# 設定
REPO_OWNER="daaaaaaaaaai"
REPO_NAME="test02"
HOME_DIR="/virtual/xdaidaix"
DEST_DIR="$HOME_DIR/public_html/test02"
LAST_COMMIT_FILE="$DEST_DIR/.last_commit"

# ディレクトリ作成
mkdir -p "$DEST_DIR"

# 最新コミット取得
LATEST_COMMIT=$(git ls-remote https://github.com/$REPO_OWNER/$REPO_NAME.git HEAD | awk '{print $1}')

# 前回コミット取得
if [ -f "$LAST_COMMIT_FILE" ]; then
    LAST_COMMIT=$(cat "$LAST_COMMIT_FILE")
else
    LAST_COMMIT=""
fi

echo "前回コミット: ${LAST_COMMIT:-なし}"
echo "最新コミット: $LATEST_COMMIT"

# 差分チェック
if [ "$LAST_COMMIT" = "$LATEST_COMMIT" ]; then
    echo "差分なし。フル取得に切り替えます。"
    ZIP_URL="https://github.com/$REPO_OWNER/$REPO_NAME/zipball/$LATEST_COMMIT"
else
    echo "差分取得中: $LAST_COMMIT → $LATEST_COMMIT"
    ZIP_URL="https://github.com/$REPO_OWNER/$REPO_NAME/zipball/$LATEST_COMMIT"
fi

# ZIP ダウンロード
TMP_ZIP=$(mktemp)
if curl -L -o "$TMP_ZIP" "$ZIP_URL"; then
    echo "ZIP取得成功"
else
    echo "❌ ZIPの取得に失敗しました"
    exit 1
fi

# 展開
unzip -o "$TMP_ZIP" -d "$DEST_DIR"
rm "$TMP_ZIP"

# 最新コミットを保存
echo "$LATEST_COMMIT" > "$LAST_COMMIT_FILE"

echo "✅ 更新完了: $LATEST_COMMIT"
