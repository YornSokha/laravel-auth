<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $results = DB::table('mlmupc_accounting_expenses')->get();
//        return view('expense.index', compact('results'));
        return view('expense.index');
    }

    public function createExpense(Request $request)
    {
        $no_letter = $request->input('no_letter');
        $date_expense = $request->input('date_expense');
        $description = $request->input('description');
        $expense_type = $request->input('expense_type');
        $dollar = $request->input('dollar');
        $riel = $request->input('riel');
        $reciever = $request->input('reciever');

        if($no_letter != '' || true){
            $data = ['no_letter' => $no_letter, 'date_expense' => $date_expense, 'description' => $description, 'expense_type' => $expense_type, 'dollar' => $dollar, 'riel' => $riel, 'reciever' => $reciever,];

            // Call updateData() method of Page Model
            DB::table('mlmupc_accounting_expenses')->insert($data);
            echo 'Insert successfully.';
        }else{
            echo 'Fill all fields.';
        }
        exit;
    }

    public function getExpenses(Request $request)
    {

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        $totalRecords = DB::table('mlmupc_accounting_expenses')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = DB::table('mlmupc_accounting_expenses')->select('count(*) as allcount')->where('reciever', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = DB::table('mlmupc_accounting_expenses')->orderBy($columnName, $columnSortOrder)
            ->where('mlmupc_accounting_expenses.reciever', 'like', '%' . $searchValue . '%')
            ->select('mlmupc_accounting_expenses.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $no_letter = $record->no_letter;
            $date_expense = $record->date_expense;
            $description = $record->description;
            $expense_type = $record->expense_type;
            $riel = $record->riel;
            $dollar = $record->dollar;
            $reciever = $record->reciever;

            $data_arr[] = array(
                "id" => $id,
                "no_letter" => $no_letter,
                "date_expense" => $date_expense,
                "description" => $description,
                "expense_type" => $expense_type,
                "dollar" => $dollar,
                "riel" => $riel,
                "reciever" => $reciever
            );
        }
        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    public function updateExpense(Request $request)
    {
        $id = $request->input('id');
        $no_letter = $request->input('no_letter');
        $date_expense = $request->input('date_expense');
        $description = $request->input('description');
        $expense_type = $request->input('expense_type');
        $dollar = $request->input('dollar');
        $riel = $request->input('riel');
        $reciever = $request->input('reciever');

        if($no_letter != '' || true){
            $data = ['no_letter' => $no_letter, 'date_expense' => $date_expense, 'description' => $description, 'expense_type' => $expense_type, 'dollar' => $dollar, 'riel' => $riel, 'reciever' => $reciever,];

            // Call updateData() method of Page Model
            DB::table('mlmupc_accounting_expenses')->where('id', $id)->update($data);
            echo 'Update successfully.';
        }else{
            echo 'Fill all fields.';
        }
        exit;
    }

    public function deleteExpense(Request $request)
    {
        $id = $request->input('id');
        DB::table('mlmupc_accounting_expenses')->where('id', $id)->delete();
        exit;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
