
<?php
require_once __DIR__ . '/../core/Model.php';
class Report extends Model {
  protected string $table = 'tb_reports';
  public function create(array $d): int { $st=$this->db->prepare("INSERT INTO {$this->table}(rep_content, user_id, create_at) VALUES (?,?,NOW())"); $st->execute([$d['rep_content'],$d['user_id']]); return (int)$this->db->lastInsertId(); }
  public function unreadCount(): int { return (int)$this->db->query("SELECT COUNT(*) FROM {$this->table} WHERE is_read=0")->fetchColumn(); }
}
