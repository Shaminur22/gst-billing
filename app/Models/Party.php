<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    //Table name
    protected $table = 'parties';

    //Primary key
    protected $primaryKey = 'id';

    //Fillable attributes
     protected $fillable = [
        'id',
        'party_type',
        'full_name',
        'phone_no',
        'address',
        'account_holder_name',
        'account_no',
        'bank_name',
        'ifsc_code',
        'zip_code',
        'state',
        'branch_address',
    ];
}
