<?php
namespace App\Models;
use CodeIgniter\Model;
class TaskModel extends Model {
    // Tasks live in the separate TSA1-derived task database, not the POS database.
    protected $DBGroup = 'taskStore';
    protected $table = 'tasks';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['title', 'status', 'task_date', 'created_at'];
    public function forDate(string $date): array {
        // Filter in SQL so the Today page receives only tasks scheduled for this date.
        return $this->where('task_date', $date)->orderBy('id', 'ASC')->findAll();
    }
    public function allByDate(): array {
        return $this->orderBy('task_date', 'ASC')->orderBy('id', 'ASC')->findAll();
    }
}
