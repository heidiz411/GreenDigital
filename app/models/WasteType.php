<?php
require_once __DIR__ . '/../core/Model.php';

class WasteType extends Model
{
    protected string $table = 'tb_wastetypes';

    public function all(): array
    {
        return $this->db->query("SELECT type_id,type_name,type_unit,type_cash FROM {$this->table} ORDER BY type_id DESC")->fetchAll();
    }

    public function find(int $id): ?array
    {
        $st = $this->db->prepare("SELECT * FROM {$this->table} WHERE type_id=?");
        $st->execute([$id]);
        return $st->fetch() ?: null;
    }

    public function save(array $d, ?int $id = null): int|bool
    {
        if ($id) {
            $st = $this->db->prepare("UPDATE {$this->table} SET type_name=?, type_unit=?, type_cash=? WHERE type_id=?");
            return $st->execute([$d['type_name'], $d['type_unit'], $d['type_cash'], $id]);
        } else {
            $st = $this->db->prepare("INSERT INTO {$this->table}(type_name,type_unit,type_cash) VALUES (?,?,?)");
            $st->execute([$d['type_name'], $d['type_unit'], $d['type_cash']]);
            return (int)$this->db->lastInsertId();
        }
    }

    public function delete(int $id): bool
    {
        $st = $this->db->prepare("DELETE FROM {$this->table} WHERE type_id=?");
        return $st->execute([$id]);
    }
}
