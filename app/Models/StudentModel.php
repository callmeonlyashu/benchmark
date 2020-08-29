<?php namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $db;
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

    public function __construct() 
    {
        $this->db = \Config\Database::connect();
    }

    /**
        * This function fetches all students data.
    */
    
    public function fetchStudents() 
    {
        
        
        $arrmixUserData = $this->db->table('student')
            ->where('is_deleted', 0)
            ->orderBy('created_at', 'DESC')
            ->get()
            ->getResult();
            
        return $arrmixUserData;
    }

    /**
        * This function fetches the second highest pocket money for all students.
    */

    public function fetchSecondHighestPocketMoney()
    {
        
        $arrmixUserData = $this->db->table('student')
            ->where('is_deleted', 0)
            ->orderBy('pocket_money', 'DESC')
            ->limit(2, 1)
            ->get()
            ->getResult()[0];

        /* $arrmixUserData = $this->db
        ->query( '
            SELECT
                first_name,
                MAX(pocket_money) AS pocket_money
            FROM 
                student
            WHERE 
                pocket_money < ( SELECT MAX(pocket_money) FROM student )'
        )->getResult(); */
            
        return $arrmixUserData;
    }

    
}
