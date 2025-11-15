<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Auth.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/WasteType.php';
require_once __DIR__ . '/../models/WasteRecord.php';
require_once __DIR__ . '/../models/Content.php';
require_once __DIR__ . '/../models/Report.php';

class ApiController extends Controller
{
    public function __construct()
    {
        Auth::requireLogin();
    }

    public function users(): void
    {
        Auth::requireRole(['แอดมิน', 'รัฐบาล']);
        $rows = (new User())->all();
        $this->json(['data' => $rows]);
    }

    public function contents(): void
    {
        Auth::requireRole(['แอดมิน', 'รัฐบาล']);
        $rows = (new Content())->listAdmin();
        $this->json(['data' => $rows]);
    }

    public function wasteTypes(): void
    {
        $rows = (new WasteType())->all();
        $this->json(['data' => $rows]);
    }

    public function wasteRecords(): void
    {
        $f = ['user_id' => $this->input('user_id', null), 'org_id' => $this->input('org_id', null), 'type_id' => $this->input('type_id', null), 'from' => $this->input('from', null), 'to' => $this->input('to', null), 'q' => $this->input('q', null)];
        if (Auth::user()['role'] === 'ประชาชน') {
            $f['user_id'] = Auth::id();
        }
        $rows = (new WasteRecord())->listWithFilters($f);
        $this->json(['data' => $rows]);
    }

    public function adminStats(): void
    {
        Auth::requireRole(['แอดมิน', 'รัฐบาล']);
        $db = Database::connection();
        $users = (int)$db->query("SELECT COUNT(*) FROM tb_users")->fetchColumn();
        $records = (int)$db->query("SELECT COUNT(*) FROM tb_wasterecord")->fetchColumn();
        $reports = (int)$db->query("SELECT COUNT(*) FROM tb_reports")->fetchColumn();
        $orgs = (int)$db->query("SELECT COUNT(*) FROM tb_organizations")->fetchColumn();
        $this->json(compact('users', 'records', 'reports', 'orgs'));
    }

    public function adminNotifications(): void
    {
        Auth::requireRole(['แอดมิน', 'รัฐบาล']);
        $db = Database::connection();
        $newUsers = (int)$db->query("SELECT COUNT(*) FROM tb_users WHERE DATE(create_at)=CURDATE()")->fetchColumn();
        $unread = (int)$db->query("SELECT COUNT(*) FROM tb_reports WHERE is_read=0")->fetchColumn();
        $this->json(['new_users' => $newUsers, 'unread_reports' => $unread, 'total' => $newUsers + $unread]);
    }

    public function chartWasteByType(): void
    {
        $db = Database::connection();
        $rows = $db->query("SELECT t.type_name, SUM(r.weight) total FROM tb_wasterecord r JOIN tb_wastetypes t ON r.type_id=t.type_id GROUP BY t.type_id ORDER BY total DESC")->fetchAll();
        $labels = array_column($rows, 'type_name');
        $data = array_map('floatval', array_column($rows, 'total'));
        $colors = array_map(fn() => sprintf('#%06X', mt_rand(0, 0xFFFFFF)), $labels);
        $this->json(compact('labels', 'data', 'colors'));
    }

    public function chartWasteByMonth(): void
    {
        $db = Database::connection();
        $rows = $db->query("SELECT DATE_FORMAT(create_at,'%Y-%m') m, SUM(weight) total FROM tb_wasterecord GROUP BY m ORDER BY m")->fetchAll();
        $labels = array_column($rows, 'm');
        $data = array_map('floatval', array_column($rows, 'total'));
        $this->json(compact('labels', 'data'));
    }

    public function exportWasteCsv(): void
    {
        $f = ['user_id' => $this->input('user_id', null), 'org_id' => $this->input('org_id', null), 'type_id' => $this->input('type_id', null), 'from' => $this->input('from', null), 'to' => $this->input('to', null), 'q' => $this->input('q', null)];
        if (Auth::user()['role'] === 'ประชาชน') {
            $f['user_id'] = Auth::id();
        }
        $rows = (new WasteRecord())->listWithFilters($f);
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=waste_records.csv');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['rec_id', 'user_id', 'org_id', 'type_id', 'type_name', 'weight', 'status', 'note', 'was_image', 'create_at']);
        foreach ($rows as $r) fputcsv($out, [$r['rec_id'], $r['user_id'], $r['org_id'], $r['type_id'], $r['type_name'], $r['weight'], $r['status'], $r['note'], $r['was_image'], $r['create_at']]);
        fclose($out);
        exit;
    }

    public function exportUsersCsv(): void
    {
        Auth::requireRole(['แอดมิน', 'รัฐบาล']);
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=users.csv');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['user_id', 'email', 'full_name', 'role', 'create_at']);
        $rows = (new User())->all();
        foreach ($rows as $r) fputcsv($out, $r);
        fclose($out);
        exit;
    }
}
