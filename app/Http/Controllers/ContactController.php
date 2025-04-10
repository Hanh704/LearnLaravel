<?php

namespace App\Http\Controllers;

use App\Mail\ContactThankyou;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('client.contact');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);
        
        $contactData = $request->only(['name', 'email', 'phone', 'message']);
        
        // Thêm user_id nếu người dùng đã đăng nhập
        if (auth()->check()) {
            $contactData['user_id'] = auth()->id();
        }
        
        $contact = Contact::create($contactData);
        
        // Gửi email cảm ơn
        Mail::to($request->email)->send(new ContactThankyou($contact));
        
        return redirect()->back()->with('success', 'Cảm ơn bạn đã liên hệ với chúng tôi. Chúng tôi sẽ phản hồi sớm nhất có thể!');
    }
}
