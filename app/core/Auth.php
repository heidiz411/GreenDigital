<?php
class Auth {
    public static function user(): ?array { return $_SESSION['user'] ?? null; }
    public static function id(): ?int { return self::user()['user_id'] ?? null; }
    public static function check(): bool { return isset($_SESSION['user']); }
    public static function login(array $u): void {
        session_regenerate_id(true);
        $_SESSION['user'] = [
          'user_id'=>(int)$u['user_id'], 'email'=>$u['email'], 'full_name'=>$u['full_name'], 'role'=>$u['role'], 'avatar'=>$u['avatar']??null
        ];
    }
    public static function logout(): void {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
          $p = session_get_cookie_params();
          setcookie(session_name(), '', time()-42000, $p['path'], $p['domain'], $p['secure'], $p['httponly']);
        }
        session_destroy();
    }
    public static function requireLogin(): void { if (!self::check()) { header('Location: ?r=/login'); exit; } }
    public static function requireRole(array $roles): void { self::requireLogin(); if (!in_array(self::user()['role'] ?? '', $roles, true)) { http_response_code(403); echo 'Forbidden'; exit; } }
    public static function csrfToken(): string { if (empty($_SESSION['_csrf'])) $_SESSION['_csrf'] = bin2hex(random_bytes(16)); return $_SESSION['_csrf']; }
    public static function verifyCsrf(): void { $t = $_POST['_csrf'] ?? ''; if (!hash_equals($_SESSION['_csrf'] ?? '', $t)) { http_response_code(419); echo 'CSRF token mismatch'; exit; } }
}
