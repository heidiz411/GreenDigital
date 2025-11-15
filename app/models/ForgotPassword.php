
<?php
require_once __DIR__ . '/../core/Model.php';
class ForgotPassword extends Model {
  protected string $table = 'tb_forgotpassword';
  public function verifyAnswer(int $userId, string $answer): bool {
    $st=$this->db->prepare("SELECT answer FROM {$this->table} WHERE user_id=? ORDER BY forgot_id DESC LIMIT 1");
    $st->execute([$userId]); $row=$st->fetch();
    if (!$row) return false;
    return hash_equals(mb_strtolower(trim($row['answer'])), mb_strtolower(trim($answer)));
  }
}
