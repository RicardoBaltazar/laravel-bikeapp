<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

//sempre seguindo um padrão de nome no singular e a palavra Controller
class UserController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
