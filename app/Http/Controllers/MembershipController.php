<?php

namespace App\Http\Controllers;
use App\MemberProcessor;
use Illuminate\Http\Request;
use App\MyDataModel;

class MembershipController extends Controller
{
    public function storeData(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string',
            'address' => 'required|string',
            'contact_number' => 'required|string',
            'gender' => 'required|in:Male,Female',
            'birthday' => 'required|date',
            'membership_type' => 'required|in:VIP,Gold,General',
        ]);

        session(['membership_data' => $validatedData]);

        $memberProcessor = new MemberProcessor($validatedData);

        session(['member_processor' => $memberProcessor]);

        return redirect('/memberView');
    }

    public function displayData(Request $request)
    {
        $memberProcessor = session('member_processor');

        if (!$memberProcessor) {
            return redirect('/');
        }

        $dataModel = new MyDataModel($memberProcessor);

        return view('memberView', ['dataModel' => $dataModel]);
    }
}
