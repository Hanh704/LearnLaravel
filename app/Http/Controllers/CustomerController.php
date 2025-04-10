<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index()
    {
        $query = Customer::query();
        $query->orderBy('id', 'desc');
        $customers = $query->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }

    public function create()
    {
        return view('admin.customers.create');
    }
    public function store(Request $request)
    {
        $validateData = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'phone' => 'required|unique:customers',
            'address' => 'required|nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'required|date',
        ], [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được vượt quá :max ký tự',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute không đúng định dạng',
            'mimes' => ':attribute không đúng định dạng',
            'max' => ':attribute không được vượt quá :max ký tự',
            'numeric' => ':attribute phải là số',
            'lt' => ':attribute phải nhỏ hơn :lt',
            'integer' => ':attribute phải là số nguyên',
            'min' => ':attribute phải lớn hơn :min',
            'date' => ':attribute phải là ngày',
            'boolean' => ':attribute phải là true hoặc false',
            'interger' => ':attribute phải là số nguyên',
            'exists' => ':attribute không hợp lệ',
        ], [
            'name' => 'Họ và tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'avatar' => 'Avatar',
        ]);

        // Xử lý ảnh
        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('images/avatars', 'public');
            $validateData['avatar'] = $imagePath;
        }
        // dd($_POST);
        Customer::create($validateData);
        return redirect()->route('admin.customers.index');
    }

    public function edit($id)
    {
        $customers = Customer::findOrFail($id);
        return view('admin.customers.edit', compact('customers'));
    }

    public function update(Request $request, $id)
    {
        $customers = Customer::findOrFail($id);
        $validateData = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,' . $id,
            'phone' => 'required|unique:customers,phone,' . $id,
            'address' => 'required|nullable',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'birthday' => 'required|date',
        ], [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được vượt quá :max ký tự',
            'unique' => ':attribute đã tồn tại',
            'image' => ':attribute không đúng định dạng',
            'mimes' => ':attribute không đúng định dạng',
            'max' => ':attribute không được vượt quá :max ký tự',
            'numeric' => ':attribute phải là số',
            'lt' => ':attribute phải nhỏ hơn :lt',
            'integer' => ':attribute phải là số nguyên',
            'min' => ':attribute phải lớn hơn :min',
            'date' => ':attribute phải là ngày',
            'boolean' => ':attribute phải là true hoặc false',
            'interger' => ':attribute phải là số nguyên',
            'exists' => ':attribute không hợp lệ',
        ], [
            'name' => 'Họ và tên',
            'email' => 'Email',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'avatar' => 'Avatar',
        ]);

        // Xử lý ảnh
        if ($request->hasFile('avatar')) {
            $imagePath = $request->file('avatar')->store('images/avatars', 'public');
            $validateData['avatar'] = $imagePath;
            // Xóa ảnh cũ 
            if($customers->avatar) {
                Storage::disk('public')->delete($customers->avatar);
            }
        }

        $customers->update($validateData);
        return redirect()->route('admin.customers.index');
    }
}
