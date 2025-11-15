
<?php
require_once __DIR__ . '/../core/Model.php';
class User extends Model {
  protected string $table = 'tb_users';
  public function find(int $id): ?array { $st=$this->db->prepare("SELECT * FROM {$this->table} WHERE user_id=?"); $st->execute([$id]); return $st->fetch()?:null; }
  public function findByEmail(string $email): ?array { $st=$this->db->prepare("SELECT * FROM {$this->table} WHERE email=?"); $st->execute([$email]); return $st->fetch()?:null; }
  public function existsEmail(string $email): bool { $st=$this->db->prepare("SELECT 1 FROM {$this->table} WHERE email=?"); $st->execute([$email]); return (bool)$st->fetchColumn(); }
  public function create(array $d): int { $st=$this->db->prepare("INSERT INTO {$this->table}(email,password,full_name,role) VALUES (?,?,?,?)"); $st->execute([$d['email'],$d['password'],$d['full_name'],$d['role']??'ประชาชน']); return (int)$this->db->lastInsertId(); }
  public function updateBasic(int $id, array $d): bool { $st=$this->db->prepare("UPDATE {$this->table} SET full_name=?, phone=?, address=? WHERE user_id=?"); return $st->execute([$d['full_name'],$d['phone'],$d['address'],$id]); }
  public function updatePassword(int $id, string $hash): bool { $st=$this->db->prepare("UPDATE {$this->table} SET password=? WHERE user_id=?"); return $st->execute([$hash,$id]); }
  public function all(): array { return $this->db->query("SELECT user_id,email,full_name,role,create_at FROM {$this->table} ORDER BY user_id DESC")->fetchAll(); }
  public function setRole(int $id, string $role): bool { $st=$this->db->prepare("UPDATE {$this->table} SET role=? WHERE user_id=?"); return $st->execute([$role,$id]); }
}
