<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerApiController extends Controller
{
    public function index()
    {
        return response()->json(Customer::all());
    }

    public function store(Request $request)
{
    try {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'location'       => 'required|string|max:255',
            'phone'          => 'required|string|max:15',
            'business_name'  => 'required|string|max:255',
            'type'           => 'required|in:Restaurant,Villa,Hotel',
            'size'           => 'required|in:Small,Medium,Large',
            'extra_note'     => 'nullable|string|max:1000',
            'is_important'   => 'required|boolean',
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);

    } catch (\Illuminate\Validation\ValidationException $e) {
        return response()->json([
            'message' => 'Validation failed',
            'errors' => $e->errors()
        ], 422);
    } catch (\Exception $e) {
        \Log::error('Customer store failed: ' . $e->getMessage());
        return response()->json(['message' => 'Server error'], 500);
    }
}
        public function destroy($id)
        {
            $customer = Customer::find($id);
            if (!$customer) {
                return response()->json(['message' => 'Customer not found'], 404);
            }
            $customer->delete();
            return response()->json(['message' => 'Customer deleted successfully']);
        }

}
