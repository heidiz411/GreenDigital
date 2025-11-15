<?php
require_once __DIR__ . '/../core/Model.php';

class Organization extends Model
{
    protected string $table = 'tb_organizations';

    public function list(): array
    {
        return $this->db->query("SELECT org_id, org_name FROM {$this->table} ORDER BY org_name")->fetchAll();
    }
}
