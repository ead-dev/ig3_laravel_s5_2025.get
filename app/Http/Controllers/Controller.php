<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Saison;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    protected $_saison;

    public function __construct()
    {
        $this->_saison = Saison::whereNull('closed_at')->first();

    }
}
