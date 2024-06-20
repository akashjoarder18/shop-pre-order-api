<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class PreOrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::query();

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                ->orWhere('email', 'like', '%' . $request->search . '%');
        }

        if ($request->has('orderBy')) {
            $orderBy = $request->orderBy;
            $direction = $request->get('direction', 'asc');
            $query->orderBy($orderBy, $direction);
        }

        $preOrders = $query->with('product')->paginate(10);

        return response()->json($preOrders);
    }

    public function softDelete($id)
    {
        $item = Order::findOrFail($id);
        $item->delete();

        return response()->json(['message' => 'Item soft deleted successfully']);
    }

    public function restore($id)
    {
        $item = Order::withTrashed()->findOrFail($id);
        $item->restore();

        return response()->json(['message' => 'Item restored successfully']);
    }

    public function trashed()
    {
        $items = Order::onlyTrashed()->get();
        return response()->json($items);
    }
}


