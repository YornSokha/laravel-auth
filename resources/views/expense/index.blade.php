@extends('layouts.app')

@section('template_title')
    Showing Themes
@endsection
@section('head')
    {{-- custom style--}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
            integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
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
@section('template_linked_css')
{{--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">--}}
    <style>
        table#expense_table th[rowspan] {
            vertical-align: top;
            text-align: center;
        }
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
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <table id="expense_table" class="display table table-hover table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th rowspan="2">លេខរៀង</th>
                        <th rowspan="2">លេខលិខិត</th>
                        <th rowspan="2">ថ្ងៃខែឆ្នាំ</th>
                        <th rowspan="2">បរិយាយ</th>
                        <th rowspan="2">ប្រភេទចំណាយ</th>
                        <th colspan="2">ចំនួនទឹកប្រាក់</th>
                        <th rowspan="2">អ្នកទទួលប្រាក់</th>
                    </tr>
                    <tr>
                        <th>ប្រាក់រៀល</th>
                        <th>ប្រាក់ដុល្លា</th>
                    </tr>
                    </thead>
                </table>
                {{--            create modal--}}
                <div class="modal fade" id="expenseCreateModal" tabindex="-1" aria-labelledby="expenseCreateModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="expenseCreateModalLabel">New message</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form>
                                    <div class="form-group">
                                        <label for="no_letter_add" class="col-form-label">លេខលិខិត:</label>
                                        <input type="text" class="form-control" id="no_letter_add">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_expense_add" class="col-form-label">ថ្ងៃខែឆ្នាំ​:</label>
                                        <input type="date" class="form-control" id="date_expense_add">
                                    </div>
                                    <div class="form-group">
                                        <label for="description_add" class="col-form-label">បរិយាយ:</label>
                                        <textarea class="form-control" id="description_add"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="expense_type_add" class="col-form-label">ប្រភេទចំណាយ:</label>
                                        <select name="expense_type_add" id="expense_type_add" class="form-control">
                                            <option value="G">ទូទៅ</option>
                                            <option value="P">បក្ស</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="riel_add" class="col-form-label">ប្រាក់រៀល:</label>
                                        <input type="number" class="form-control" id="riel_add">
                                    </div>
                                    <div class="form-group">
                                        <label for="dollar_add" class="col-form-label">ប្រាក់ដូល្លា:</label>
                                        <input type="number" class="form-control" id="dollar_add">
                                    </div>
                                    <div class="form-group">
                                        <label for="reciever_add" class="col-form-label">អ្នកទទួល:</label>
                                        <input type="text" class="form-control" id="reciever_add">
                                    </div>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" id="save_add">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                {{--edit modal--}}
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
                                        <label for="no_letter" class="col-form-label">លេខលិខិត:</label>
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
                                <button type="button" class="btn btn-primary" id="save" data-dismiss="modal">Save</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade in" id="expense_operation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Edit or Remove?</h5>
                            </div>
                            <div class="modal-body text-center">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#expenseModal" data-whatever="@getbootstrap">Edit</button>
                                <a class="btn btn-danger" href="#" data-toggle="modal" data-target="#confirm-delete">Remove</a>
                            </div>
                            <div class="modal-footer">
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
@endsection

@section('footer_scripts')
    <script>
        $.noConflict();
        $(document).ready(function () {
            let button = '<button class="btn btn-primary">កែប្រែ</button>';
            let expenseTable = $('#expense_table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: "{{route('expense.getExpenses')}}",
                dom: 'Blfrtip',
                buttons: {
                    buttons: [
                        // {
                        //     extend: 'copy',
                        //     text: '<i class="fa fa-files-o"></i> Copy',
                        //     className: 'btn-primary',
                        // },
                        {
                            extend: 'excel',
                            text: '<i class="fa fa-file-excel-o"></i> Excel',
                            className: 'btn-success'
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i> Print',
                            className: 'btn-primary'
                        },
                        {
                            // extend: 'pdf',
                            text: ' <i class="fa fa-file-pdf-o"></i> Create expense',
                            className: 'btn-secondary btn-create-expense',
                        },
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
                    {data: 'no_letter'},
                    {data: 'date_expense'},
                    {data: 'description'},
                    {data: 'expense_type'},
                    {data: 'dollar'},
                    {data: 'riel'},
                    {data: 'reciever'},
                ],
                createdRow: function(row, data, dataIndex, cells) {
                    $(row).addClass('expense');
                    let key = ['id', 'no_letter', 'date_expense', 'description', 'expense_type', 'dollar', 'riel', 'reciever',];
                    let column = {};
                    $.each(key, function( index, value ) {
                        column[value] = $(row).children().eq(index).text();
                    });
                    $(row).attr({
                        'data-id' : column['id'],
                        'data-no_letter' : column['no_letter'],
                        'data-date_expense' : column['date_expense'],
                        'data-description' : column['description'],
                        'data-expense_type' : column['expense_type'],
                        'data-dollar' : column['dollar'],
                        'data-riel' : column['riel'],
                        'data-reciever' : column['reciever'],
                    });
                },
                initComplete: function () {
                    let btnCreate = $('.btn-create-expense');
                    btnCreate.attr({
                        "data-toggle":"modal",
                        "data-target":"#expenseCreateModal"
                    })
                }
            });
            let expense = {}
            let touchTime = 0;
            // to handle for both web and mobile click
            $('#expense_table').on('click', '.expense', function(e){
                if (touchTime === 0) {
                    // set first click
                    touchTime = new Date().getTime();
                } else {
                    // compare first click to this click and see if they occurred within double click threshold
                    if (((new Date().getTime()) - touchTime) < 800) {
                        // double click occurred
                        let id = $(this).data('id');
                        let no_letter = $(this).data('no_letter');
                        let date_expense = $(this).data('date_expense');
                        let description = $(this).data('description');
                        let expense_type = $(this).data('expense_type');
                        let dollar = $(this).data('dollar');
                        let riel = $(this).data('riel');
                        let reciever = $(this).data('reciever');
                        expense = {
                            id,
                            no_letter,
                            date_expense,
                            description,
                            expense_type,
                            dollar,
                            riel,
                            reciever,
                        }
                        $('#expense_operation').modal('show');
                        touchTime = 0;
                    } else {
                        // not a double click so set as a new first click
                        touchTime = new Date().getTime();
                    }
                }
            });
            $('#expenseModal').on('show.bs.modal', function (event) {
                $('#expense_operation').modal('hide');
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
                            // $('#expenseModal').modal('hide')
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
                        }
                    });
                }
            })


            $('#confirm-delete').on('show.bs.modal', function(e) {
                $('#expense_operation').modal('hide');
                $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
            });

            $('#save_add').on('click', function () {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                // AJAX request
                if($('#reciever_add').val() != '') {
                    $.ajax({
                        url: "{{ route('expense.createExpense') }}",
                        method: 'post',
                        data: {
                            _token: CSRF_TOKEN,
                            no_letter : $('#no_letter_add').val(),
                            date_expense : $('#date_expense_add').val(),
                            description : $('#description_add').val(),
                            expense_type : $('#expense_type_add').val(),
                            dollar : $('#dollar_add').val(),
                            riel : $('#riel_add').val(),
                            reciever : $('#reciever_add').val(),
                        },
                        success: function (response) {
                            expenseTable.ajax.reload();
                            alert(response);
                        }
                    });
                }
            })

        });
    </script>

@endsection