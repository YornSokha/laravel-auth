<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class RevenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('revenue.index0');

    }

    public function getRevenue(Request $request)
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
        $totalRecords = DB::table('mlmupc_accounting_revenues')->select('count(*) as allcount')->count();
        $totalRecordswithFilter = DB::table('mlmupc_accounting_revenues')->select('count(*) as allcount')->where('no_invoice', 'like', '%' . $searchValue . '%')->count();

        // Fetch records
        $records = DB::table('mlmupc_accounting_revenues')->orderBy($columnName, $columnSortOrder)
            ->where('mlmupc_accounting_revenues.no_invoice', 'like', '%' . $searchValue . '%')
            ->select('mlmupc_accounting_revenues.*')
            ->skip($start)
            ->take($rowperpage)
            ->get();

        $data_arr = array();

        foreach ($records as $record) {
            $id = $record->id;
            $date_expense = $record->date_expense;
            $no_invoice = $record->no_invoice;
            $owner = $record->owner;
            $organization = $record->organization;
            $description = $record->description;
            $riel = $record->riel;
            $revenue_type = $record->revenue_type;
            $payer = $record->payer;

            $data_arr[] = array(
                "id" => $id,
                "date_expense" => $date_expense,
                "no_invoice" => $no_invoice,
                "owner" => $owner,
                "organization" => $organization,
                "description" => $description,
                "riel" => $riel,
                "revenue_type" => $revenue_type,
                "payer" => $payer,
            );
        }
        dd($data_arr);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
