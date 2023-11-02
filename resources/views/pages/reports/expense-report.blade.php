@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}" />
@endsection
@section('content')
    <h3>Expense Reports</h3>


    <form method="POST" action="{{route('expense-report-filter')}}" id="expense-search">
        @csrf

        <div class="row my-2">
            <div class="col-1"></div>
            <div class="col-2">
                <div class="input-group input-group-static">
                    <label for="month" class="ms-0">Star Date</label>
                    <input class="form-control " placeholder="Please select Date" type="date" name="start_date"
                        id="start_date" required>
                </div>


            </div>

            <div class="col-2">
                <div class="input-group input-group-static">
                    <label for="month" class="ms-0">End Date</label>
                    <input class="form-control" placeholder="Please select Date" type="date" name="end_date"
                        id="end_date" required>
                </div>


            </div>




            <div class="col-md-2">

                <label for="">Select Category </label>

                <select class="form-select p-2" id="category_id" name="category_id">
                    <option disabled selected>Select Category</option>
                    @foreach ($cate as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2">
                <label for=""> Payment Method </label>
                <select class="form-select p-2" id="payment_method" name="payment">
                    <option disabled selected>Select Payment Method</option>
                    <option value="Cash">Cash</option>
                    <option value="Card">Card</option>
                    <option value="Cheque">Cheque</option>
                </select>
            </div>

            <div class="col-md-2 mt-4">
                <input type="submit" value="Submit" class="btn btn-primary">
                {{-- <input type="button" onclick="searchFilter()" value="Search" class="btn btn-primary"> --}}
            </div>
        </div>

    </form>

    <div class="table-responsive">

        <table class="table table-flush" id="expense-table">
    
            <thead class="thead-light">
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SL</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expense Category</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Payment Method</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>


                </tr>
            </thead>
            <tbody>



                @foreach ($result as $key => $res)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ date('d-M-Y', strtotime($res->created_at)) }}</td>
                        <td>{{ $res->description }}</td>
                        <td>{{ $res->Category->category_name }}</td>
                        <td>{{ $res->payment_method }}</td>
                        <td class="amount" data-current={{ $res->expense_amount}}>{{ $res->expense_amount }}</td>
                    </tr>
                @endforeach

                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td> <h4>Total Expense:</h4> </td>
                    <td  class="text-dark font-weight-bold amount" data-current ={{ $result->sum('expense_amount')}}> <h4>{{ $result->sum('expense_amount')}}</h4></td>
                    
                </tr>



            </tbody>
        </table>



    </div>
@endsection

@section('datatables')
    <script src="{{ asset('assets/js/dataTable.js') }}"></script>
    <script src ='https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js' ></script>
    <script src ='https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js' ></script>
    <script>


    $(document).ready(function() {
    $('#expense-table').DataTable( {
        searching: false,
         ordering:  false,
        dom: 'Bfrtip',
        "bPaginate": false,
        "bInfo": false,
        buttons: [
            {
                extend: 'print',
                text: 'Print',
                exportOptions: {
                    modifier: {
                        selected: null
                    }
                }
            }
 
           
        ]
    } );
} );

    </script>
@endsection
