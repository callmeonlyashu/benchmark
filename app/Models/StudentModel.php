<?php namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table      = 'student';
    protected $primaryKey = 'id';

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
                'first_name', 
                'last_name',
                'email',
                'pocket_money',
                'password',
                'is_deleted',
                'age',
                'state',
                'zip',
                'country'
        ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = true;

    public function fetchStudents() 
    {
        $db = \Config\Database::connect();
        
        $arrmixUserData = $db->table('student')
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResult();
            
        return $arrmixUserData;
    }

    public function fetchSecondHighestPocketMoney()
    {
        $db = \Config\Database::connect();
        
        $arrmixUserData = $db->table('student')
            ->where('is_deleted', 0)
            ->orderBy('pocket_money', 'DESC')
            ->limit(2, 1)
            ->get()
            ->getResult()[0];
            
        return $arrmixUserData;
    }

    
}
