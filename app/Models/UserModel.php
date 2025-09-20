<?php

namespace app\Models;

use CodeIgniter\Model;

class UserModel extends Model {
    protected $table      = 'user';
    protected $primaryKey = 'user_id';
    protected $useAutoIncrement = true;

    protected $returnType = 'object';

    protected $allowedFields = [
        'user_id', 'user_name', 'user_email',
        'user_pass', 'user_status', 'user_register_dt',
        'user_last_login_dt', 'user_recreate_pass'
    ];

    protected $useSoftDeletes = false;

    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'user_register_dt';
}