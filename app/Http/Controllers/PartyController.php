<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Party;
use Illuminate\Support\Facades\DB;

class PartyController extends Controller
{
    // Function to display the list of parties

    public function index(){

        // Fetch all parties from the database
               $parties = Party::select(
            'id',
            'party_type',
            'full_name',
            'phone_no',
            'address',
            'account_holder_name',
            'account_no',
            'bank_name',
            'ifsc_code',
            'branch_address',
            'created_at'
        )->orderBy('id', 'desc')->get(); 
        // Pass the parties to the view
        return view('party.index', compact('parties'));
    
    }

    
    #Function to show the form for adding a new party
    public function addParty()
    {
        return view('party.add');
    }

    #Function to create a new party
            public function createParty(Request $request)
        {
            // Valildation
            $request->validate([
                'party_type' => 'required',
                'full_name' => 'required',
                'phone_no' => 'required',
                'address' => 'required|max:255',
                'account_holder_name' => 'required',
                'account_no' => 'required',
                'bank_name' => 'required|max:255',
                'ifsc_code' => 'required|max:50',
                'branch_address' => 'required|max:255',
            ]);

            $param = $request->all();

            // Remove token from post data before inserting
            unset($param['_token']);
            Party::create($param);

            // Redirect to add party back
            return redirect()->route('manage-parties')->withStatus("Party created successfully");
        }
    #Function to show the form for editing a party
        public function editParty($party_id)
        {
            $data['party'] = Party::find($party_id);
            return view("party.edit", $data);
        }
    #Function to update a party
        public function updateParty($id, Request $request)
    {
        // Valildation
        $request->validate([
            'party_type' => 'required',
            'full_name' => 'required',
            'phone_no' => 'required',
            'address' => 'required|max:255',
            'account_holder_name' => 'required',
            'account_no' => 'required',
            'bank_name' => 'required|max:255',
            'ifsc_code' => 'required|max:50',
            'branch_address' => 'required|max:255',
        ]);

        // Update the record
        $param = $request->all();
        unset($param['_token']);
        unset($param['_method']);
        Party::where('id', $id)->update($param);
        return redirect()->route('manage-parties')->withStatus("Party updated successfully");
    }
//function to delete a party
    public function deleteParty(Party $party)
    {
        // Delete the party
        $party->delete();

        // Redirect to manage parties with success message
        return redirect()->route('manage-parties')->withStatus("Party deleted successfully");

    }



}
