<?php
require_once __DIR__ . '/../core/Model.php';
class WasteRecord extends Model {
  protected string $table = 'tb_wasterecord';
  public function find(int $id): ?array { $st=$this->db->prepare("SELECT * FROM {$this->table} WHERE rec_id=?"); $st->execute([$id]); return $st->fetch()?:null; }
  public function save(array $d, ?int $id=null): int|bool {
    if ($id) {
      $st=$this->db->prepare("UPDATE {$this->table} SET user_id=?, org_id=?, type_id=?, weight=?, was_image=?, status=?, note=? WHERE rec_id=?");
      return $st->execute([$d['user_id'],$d['org_id'],$d['type_id'],$d['weight'],$d['was_image'],$d['status'],$d['note'],$id]);
    } else {
      $st=$this->db->prepare("INSERT INTO {$this->table}(user_id,org_id,type_id,weight,was_image,status,note) VALUES (?,?,?,?,?,?,?)");
      $st->execute([$d['user_id'],$d['org_id'],$d['type_id'],$d['weight'],$d['was_image'],$d['status'],$d['note']]);
      return (int)$this->db->lastInsertId();
    }
  }
  public function delete(int $id): bool { $st=$this->db->prepare("DELETE FROM {$this->table} WHERE rec_id=?"); return $st->execute([$id]); }
  public function listWithFilters(array $f): array {
    $sql = "SELECT r.rec_id, r.user_id, r.org_id, r.type_id, t.type_name, r.weight, r.status, r.note, r.was_image, r.create_at
            FROM tb_wasterecord r LEFT JOIN tb_wastetypes t ON r.type_id=t.type_id WHERE 1=1";
    $params = [];
    if (!empty($f['user_id'])) { $sql.=' AND r.user_id=?'; $params[]=(int)$f['user_id']; }
    if (!empty($f['org_id']))  { $sql.=' AND r.org_id=?';  $params[]=(int)$f['org_id']; }
    if (!empty($f['type_id'])) { $sql.=' AND r.type_id=?'; $params[]=(int)$f['type_id']; }
    if (!empty($f['from']))    { $sql.=' AND r.create_at >= ?'; $params[]=$f['from'].' 00:00:00'; }
    if (!empty($f['to']))      { $sql.=' AND r.create_at <= ?'; $params[]=$f['to'].' 23:59:59'; }
    if (!empty($f['q']))       { $sql.=' AND (r.note LIKE ?)';  $params[]='%'.$f['q'].'%'; }
    $sql .= ' ORDER BY r.rec_id DESC';
    $st=$this->db->prepare($sql); $st->execute($params); return $st->fetchAll();
  }
}
