<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeViewCommand extends Command
{
    /**
     * コマンド名と引数・オプション定義
     */
    protected $signature = 'make:view 
                            {name : The name of the view (e.g. master/customer)} 
                            {--extends= : Layout file to extend (e.g. layouts.app)} 
                            {--section= : Section name (e.g. content)}';

    /**
     * コマンドの説明
     */
    protected $description = 'Create a new Blade view file (supports nested directories and layout inheritance)';

    /**
     * 実行内容
     */
    public function handle()
    {
        $name = $this->argument('name');

        // resources/views以下のパス
        $path_index = resource_path('views/' . str_replace('.', '/', $name) . '/index.blade.php');
        $path_edit = resource_path('views/' . str_replace('.', '/', $name) . '/edit.blade.php');
        $directory = dirname($path_index);

        // フォルダ作成
        if (!File::isDirectory($directory)) {
            File::makeDirectory($directory, 0755, true);
            $this->info("📁 Directory created: {$directory}");
        }

        // ファイル存在チェック(index)
        if (File::exists($path_index)) {
            $this->error("⚠️ View already exists: {$path_index}");
            return;
        }

        // ファイル存在チェック(edit)
        if (File::exists($path_edit)) {
            $this->error("⚠️ View already exists: {$path_edit}");
            return;
        }

        // 内容生成
        $content = <<<BLADE
        @extends('adminlte::page')

        @section('title', 'Dashboard')

        @section('content_header')
            <h1>Dashboard</h1>
        @stop

        @section('content')
            <p>Welcome to this beautiful admin panel.</p>
        @stop

        @section('css')
            <link rel="stylesheet" href="/css/admin_custom.css">
        @stop

        @section('js')
            <script> console.log('Hi!'); </script>
        @stop

        BLADE;

        // ファイル作成
        File::put($path_index, $content);
        File::put($path_edit, $content);

        $this->info("✅ View created: {$path_index}");
        $this->info("✅ View created: {$path_edit}");
    }
}
