<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    public function index(Request $request){
   
        if ($request->ajax()) {
        $transactions = DB::select("SELECT transactions.*,
           users.id AS user_id, (users.name) AS user_name
            FROM transactions
            LEFT JOIN users ON transactions.user_id = users.id");
        //dd($transactions);
            $data_table_render= DataTables::of($transactions)
            ->addColumn('DT_RowIndex',function ($row){
                //return '<input type="checkbox" name="customer_ids[]" value="'.$row->id.'">';
            })
            //add edit and delte option
                ->addColumn('action',function ($row){
                    //$edit_url=route('editCustomer',$row->id);
                return '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editTransaction"><i class="fa fa-eyedropper"></i></a></a> '."&nbsp&nbsp;".
                     '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteTransaction"><i class="fa fa-close"></i></a>';
            })
            ->rawColumns(['DT_RowIndex','action'])
            ->addIndexColumn()
            ->make(true);
        return $data_table_render;
        }
     
        return view('transaction.all_transaction');
    }

    public function store(Request $request){
        $user_id=Auth::user()->id;
        Transaction::updateOrCreate(['id' => $request->id],
                ['user_id'=>$user_id, 'item' => $request->item, 'total' => $request->total, 'purchase_date' => $request->purchase_date, 'mobile'=>$request->mobile, 'status'=>1]);        
   
        return response()->json(['success'=>'Transaction saved successfully.']);
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        return response()->json($transaction);
    }

    // public function updateCustomer(Request $request, $id)
    // {
    // $transaction = Transaction::find($id);
    //     $transaction->item = $request->item;
    //     $transaction->total = $request->total;
    //     return response()->json(['success'=>'Transaction Updated successfully.']);
    // }

    public function destroy($id)
    {
        Transaction::find($id)->delete();
     
        return response()->json(['success'=>'Transaction deleted successfully.']);
    }
}