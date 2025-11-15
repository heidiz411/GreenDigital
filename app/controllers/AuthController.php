<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/ForgotPassword.php';

class AuthController extends Controller
{
    public function login(): void
    {
        if (Auth::check()) {
            header('Location: ?r=/');
            return;
        }
        $pageTitle = 'เข้าสู่ระบบ';
        $this->view('auth/login.php', compact('pageTitle'));
    }

    public function doLogin(): void
    {
        Auth::verifyCsrf();
        $email = strtolower(trim((string)$this->input('email', '')));
        $pass = (string)$this->input('password', '');
        $user = (new User())->findByEmail($email);
        if (!$user || !password_verify($pass, (string)$user['password'])) $this->json(['success' => false, 'message' => 'อีเมลหรือรหัสผ่านไม่ถูกต้อง'], 401);
        Auth::login($user);
        $this->json(['success' => true, 'message' => 'เข้าสู่ระบบสำเร็จ']);
    }

    public function logout(): void
    {
        Auth::logout();
        header('Location:?r=/login');
    }

    public function register(): void
    {
        $pageTitle = 'สมัครสมาชิก';
        $this->view('auth/register.php', compact('pageTitle'));
    }

    public function doRegister(): void
    {
        Auth::verifyCsrf();
        $d = ['email' => strtolower(trim((string)$this->input('email', ''))), 'full_name' => trim((string)$this->input('full_name', '')), 'password' => (string)$this->input('password', ''), 'password_confirm' => (string)$this->input('password_confirm', ''), 'role' => 'ประชาชน'];
        if (!filter_var($d['email'], FILTER_VALIDATE_EMAIL)) $this->json(['success' => false, 'message' => 'อีเมลไม่ถูกต้อง'], 422);
        if (strlen($d['password']) < 8) $this->json(['success' => false, 'message' => 'รหัสผ่านอย่างน้อย 8 ตัวอักษร'], 422);
        if ($d['password'] !== $d['password_confirm']) $this->json(['success' => false, 'message' => 'ยืนยันรหัสผ่านไม่ตรงกัน'], 422);
        $m = new User();
        if ($m->existsEmail($d['email'])) $this->json(['success' => false, 'message' => 'อีเมลนี้ถูกใช้แล้ว'], 409);
        $id = $m->create(['email' => $d['email'], 'password' => password_hash($d['password'], PASSWORD_DEFAULT), 'full_name' => $d['full_name'], 'role' => $d['role']]);
        $this->json(['success' => true, 'message' => 'สมัครสมาชิกสำเร็จ', 'id' => $id]);
    }

    public function profile(): void
    {
        Auth::requireLogin();
        $pageTitle = 'โปรไฟล์ของฉัน';
        $this->view('auth/profile.php', compact('pageTitle'));
    }

    public function saveProfile(): void
    {
        Auth::requireLogin();
        Auth::verifyCsrf();
        $d = ['full_name' => trim((string)$this->input('full_name', '')), 'phone' => trim((string)$this->input('phone', '')), 'address' => trim((string)$this->input('address', ''))];
        (new User())->updateBasic(Auth::id(), $d);
        $_SESSION['user']['full_name'] = $d['full_name'];
        $this->json(['success' => true, 'message' => 'บันทึกโปรไฟล์สำเร็จ']);
    }

    public function changePassword(): void
    {
        Auth::requireLogin();
        Auth::verifyCsrf();
        $old = (string)$this->input('old_password', '');
        $new = (string)$this->input('new_password', '');
        if (strlen($new) < 8) $this->json(['success' => false, 'message' => 'รหัสผ่านใหม่อย่างน้อย 8 ตัวอักษร'], 422);
        $user = (new User())->find(Auth::id());
        if (!$user || !password_verify($old, $user['password'])) $this->json(['success' => false, 'message' => 'รหัสผ่านเดิมไม่ถูกต้อง'], 400);
        (new User())->updatePassword(Auth::id(), password_hash($new, PASSWORD_DEFAULT));
        $this->json(['success' => true, 'message' => 'เปลี่ยนรหัสผ่านสำเร็จ']);
    }

    public function forgot(): void
    {
        $pageTitle = 'ลืมรหัสผ่าน';
        $this->view('auth/forgot.php', compact('pageTitle'));
    }

    public function forgotVerify(): void
    {
        Auth::verifyCsrf();
        $email = strtolower(trim((string)$this->input('email', '')));
        $ans = trim((string)$this->input('answer', ''));
        $u = (new User())->findByEmail($email);
        if (!$u) $this->json(['success' => false, 'message' => 'ไม่พบบัญชี'], 404);
        $ok = (new ForgotPassword())->verifyAnswer((int)$u['user_id'], $ans);
        $this->json(['success' => $ok, 'message' => $ok ? 'ยืนยันสำเร็จ' : 'คำตอบไม่ถูกต้อง', 'user_id' => (int)$u['user_id']]);
    }

    public function resetPassword(): void
    {
        Auth::verifyCsrf();
        $uid = (int)$this->input('user_id', 0);
        $new = (string)$this->input('new_password', '');
        if ($uid <= 0 || strlen($new) < 8) $this->json(['success' => false, 'message' => 'ข้อมูลไม่ถูกต้อง'], 422);
        (new User())->updatePassword($uid, password_hash($new, PASSWORD_DEFAULT));
        $this->json(['success' => true, 'message' => 'ตั้งรหัสผ่านใหม่สำเร็จ']);
    }
}
