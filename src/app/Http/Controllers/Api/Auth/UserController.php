<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');

        }

        if ($request->has('orderBy')) {
            $orderBy = $request->orderBy;
            $direction = $request->get('direction', 'asc');
            $query->orderBy($orderBy, $direction);
        }

        $users = $query->paginate(10);

        return response()->json($users);
    }
}


