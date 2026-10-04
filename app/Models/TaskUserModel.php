<?php
namespace App\Models;
use CodeIgniter\Model;
class TaskUserModel extends Model {
    // Select taskStore because both databases contain a table named users.
    protected $DBGroup = 'taskStore';
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'full_name', 'email', 'created_at'];
}
