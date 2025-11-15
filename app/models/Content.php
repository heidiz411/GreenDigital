
<?php
require_once __DIR__ . '/../core/Model.php';
class Content extends Model {
  protected string $table = 'tb_contents';
  public function find(int $id): ?array { $st=$this->db->prepare("SELECT * FROM {$this->table} WHERE content_id=?"); $st->execute([$id]); return $st->fetch()?:null; }
  public function save(array $d, ?int $id=null): int|bool {
    if ($id) {
      $st=$this->db->prepare("UPDATE {$this->table} SET title=?, body=?, image_path=?, publish_at=?, expire_at=?, is_active=? WHERE content_id=?");
      return $st->execute([$d['title'],$d['body'],$d['image_path'],$d['publish_at'],$d['expire_at'],$d['is_active'],$id]);
    } else {
      $st=$this->db->prepare("INSERT INTO {$this->table}(title,body,image_path,publish_at,expire_at,is_active) VALUES (?,?,?,?,?,?)");
      $st->execute([$d['title'],$d['body'],$d['image_path'],$d['publish_at'],$d['expire_at'],$d['is_active']??1]);
      return (int)$this->db->lastInsertId();
    }
  }
  public function delete(int $id): bool { $st=$this->db->prepare("DELETE FROM {$this->table} WHERE content_id=?"); return $st->execute([$id]); }
  public function listAdmin(): array { return $this->db->query("SELECT content_id,title,publish_at,expire_at,is_active FROM {$this->table} ORDER BY content_id DESC")->fetchAll(); }
}
