<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoanStatus extends Model
{
    const  PENDING_APPROVAL = 1;
    const  APPROVED = 2;
    const  DECLINED = 3;
    const  SENT = 4;
}
