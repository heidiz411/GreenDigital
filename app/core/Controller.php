<?php

abstract class Controller
{
    protected function view(string $contentView, array $data = []): void
    {
        // Extract data to variables for view
        extract($data, EXTR_SKIP);
        // Resolve content view to an absolute file path under app/views
        $contentViewPath = is_file($contentView)
            ? $contentView
            : __DIR__ . '/../views/' . ltrim($contentView, '/');
        require __DIR__ . '/../views/components/layout.php';
    }

    protected function json($payload, int $status = 200): void
    {
        http_response_code($status);
        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($payload);
        exit;
    }

    protected function input(string $key, $default = null)
    {
        return $_POST[$key] ?? $_GET[$key] ?? $default;
    }
}
