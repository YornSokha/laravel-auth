@extends('layouts.app')

@section('title', 'EXPENSE')

@section('head')
    {{-- custom style--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
            integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.css"/>

    {{--    font awesome--}}
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.10.21/datatables.min.js"></script>
    {{--    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>--}}
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript"
            src="http://datatables.net/download/build/dataTables.tableTools.nightly.js?_=60133663e907c73303e914416ea258d8"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.2/js/buttons.colVis.min.js"></script>
@endsection


@section('template_fastload_css')

    .dataTables_wrapper .dt-buttons, .dataTables_filter {
    float:right;
    /*text-align:right;*/
    }
    div.dataTables_filter,
    div.dataTables_length,
    div.dt-buttons{
    display: inline-block;
    margin-left: 1em;
    }

@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="heading">mlmupc accounting revenue</h3>
                    </div>
                    <div class="panel-body">

                        <table id="revenu_table" class="display table table-hover table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th>លេខរៀង</th>
                                <th>ថ្ងៃខែឆ្នាំ</th>
                                <th>លេខបង្កាន់ដៃ</th>
                                <th>ម្ចាស់សំណើរ</th>
                                <th>អង្គភាព</th>
                                <th>ចំនួនទឹកប្រាក់</th>
                                <th>អត្ថន័យចំណូល</th>
                                <th>មាតិកាថវិកា</th>
                                <th>អ្នកបង់ប្រាក់</th>
                            </tr>
                            </thead>
                        </table>
                        <div class="modal fade" id="expenseModal" tabindex="-1" aria-labelledby="expenseModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="expenseModalLabel">New message</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="no_letter" class="col-form-label">លេខបង្កាន់ដៃ:</label>
                                                <input type="text" class="form-control" id="no_letter">
                                            </div>
                                            <div class="form-group">
                                                <label for="date_expense" class="col-form-label">ថ្ងៃខែឆ្នាំ​:</label>
                                                <input type="date" class="form-control" id="date_expense">
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="col-form-label">បរិយាយ:</label>
                                                <textarea class="form-control" id="description"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="expense_type" class="col-form-label">ប្រភេទចំណាយ:</label>
                                                <select name="expense_type" id="expense_type" class="form-control">
                                                    <option value="G">ទូទៅ</option>
                                                    <option value="P">បក្ស</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="riel" class="col-form-label">ប្រាក់រៀល:</label>
                                                <input type="number" class="form-control" id="riel">
                                            </div>
                                            <div class="form-group">
                                                <label for="dollar" class="col-form-label">ប្រាក់ដូល្លា:</label>
                                                <input type="number" class="form-control" id="dollar">
                                            </div>
                                            <div class="form-group">
                                                <label for="reciever" class="col-form-label">អ្នកទទួល:</label>
                                                <input type="text" class="form-control" id="reciever">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="save">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{--            delete modal--}}
                        <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Expense</h5>
                                    </div>
                                    <div class="modal-body">
                                        <p>Do you want to delete this recors?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                        <a class="btn btn-danger btn-ok" id="delete" data-dismiss="modal">Delete</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('footer_scripts')
    <script>
        $.noConflict();
        $(document).ready(function () {
            let button = '<button class="btn btn-primary">កែប្រែ</button>';
            let expenseTable = $('#revenu_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: "{{route('revenue.getRevenue')}}",
                dom: 'Blfrtip',
                buttons: {
                    buttons: [
                        {
                            extend: 'copy',
                            text: '<i class="fa fa-files-o"></i> Copy',
                            className: 'btn-outline-primary',
                        },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel-o"></i> Excel',
                            className: 'btn-outline-secondary'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Print',
                            className: 'btn-outline-danger'
                        },
                        // {
                        //     extend: 'pdf',
                        //     text: ' <i class="fa fa-file-pdf-o"></i> Pdf',
                        //     className: 'btn-outline-primary'
                        // },
                        // {
                        //     extend: 'colvis',
                        //     text: 'colvis',
                        //     className: 'btn-outline-danger',
                        // }
                    ],
                    dom: {
                        button: {
                            className: 'btn btn-sm'
                        },
                        // buttonLiner: {
                        //     tag: null
                        // }
                    }
                },
                columns: [
                    {data: 'id'},
                    {data: 'date_expense'},
                    {data: 'no_invoice'},
                    {data: 'owner'},
                    {data: 'organization'},
                    {data: 'riel'},
                    {data: 'description'},
                    {data: 'revenue_type'},
                    {data: 'payer'},
                ],
                createdRow: function(row, data, dataIndex, cells) {
                    $(row).addClass('expense');
                    let key = ['id', 'date_expense', 'no_invoice', 'owner', 'organization', 'riel', 'description', 'revenue_type', 'payer',];
                    let column = {};
                    $.each(key, function( index, value ) {
                        column[value] = $(row).children().eq(index).text();
                    });
                    $(row).attr({
                        'data-id' : column['id'],
                        'data-date_expense' : column['date_expense'],
                        'data-no_invoice' : column['no_invoice'],
                        'data-owner' : column['owner'],
                        'data-organization' : column['organization'],
                        'data-riel' : column['riel'],
                        'data-description' : column['description'],
                        'data-revenue_type' : column['revenue_type'],
                        'data-payer' : column['payer'],
                    });
                },
            });
            // expenseTable.buttons().container()
            //     .appendTo( '#expense_table_wrapper .col-md-6:eq(0)' );
            let expense = {}
            $('#revenu_table').on('click','.expense',function(e){
                let id = $(this).data('id');
                let date_expense = $(this).data('date_expense');
                let no_invoice = $(this).data('no_invoice');
                let owner = $(this).data('owner');
                let organization = $(this).data('organization');
                let riel = $(this).data('riel');
                let description = $(this).data('description');
                let revenue_type = $(this).data('revenue_type');
                let payer = $(this).data('payer');
                expense = {
                    id,
                    date_expense,
                    no_invoice,
                    owner,
                    organization,
                    description,
                    riel,
                    revenue_type,
                    payer,
                }

            });
            $('#expenseModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var recipient = button.data('whatever') // Extract info from data-* attributes
                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                var modal = $(this)
                modal.find('.modal-title').text('New message to ' + recipient)
                modal.find('.modal-body #no_letter').val(expense.no_letter)
                modal.find('.modal-body #date_expense').val(expense.date_expense)
                modal.find('.modal-body #description').val(expense.description)
                modal.find('.modal-body #expense_type').val(expense.expense_type)
                modal.find('.modal-body #dollar').val(expense.dollar)
                modal.find('.modal-body #riel').val(expense.riel)
                modal.find('.modal-body #reciever').val(expense.reciever)
            })
            $('#save').on('click', function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // AJAX request
                if(name != '' && email != '' || true){
                    $.ajax({
                        url: "{{ route('expense.updateExpense') }}",
                        method: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            id : expense.id,
                            no_letter : $('#no_letter').val(),
                            date_expense : $('#date_expense').val(),
                            description : $('#description').val(),
                            expense_type : $('#expense_type').val(),
                            dollar : $('#dollar').val(),
                            riel : $('#riel').val(),
                            reciever : $('#reciever').val(),
                        },
                        success: function (response) {
                            expenseTable.ajax.reload();
                            alert(response);
                        }
                    });
                }else{
                    alert('Fill all fields');
                }
            })

            $('#delete').on('click', function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // AJAX request
                if(expense.id != '') {
                    $.ajax({
                        url: "{{ route('expense.deleteExpense') }}",
                        method: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            id : expense.id,
                        },
                        success: function (response) {
                            expenseTable.ajax.reload();
                            alert(response);
                        }
                    });
                }
            })


            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });
        });
    </script>
@endsection
