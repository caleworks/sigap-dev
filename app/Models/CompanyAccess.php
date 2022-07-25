<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CompanyAccess extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function grantedUsers($id)
    {
        $grantedUsers = DB::table('company_accesses')
            ->join('users', 'company_accesses.user_id', '=', 'users.id')
            ->join('companies', 'company_accesses.company_id', '=', 'companies.id')
            ->select('company_accesses.id', 'users.name', 'users.email', 'companies.company_name', 'company_accesses.created_at')
            ->where('company_accesses.company_id', $id);
        
        return $grantedUsers;
    }
 

    
}
