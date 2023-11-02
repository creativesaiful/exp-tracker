@extends('layouts.app')
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}" />
@endsection
@section('content')
    <h3>Expense Reports</h3>


    <form method="POST" action="#" id="expense-search">
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
                <input type="button" onclick="searchFilter()" value="Search" class="btn btn-primary">
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
            <tbody id="expense-tbody">



                @foreach ($result as $key => $res)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ date('Y-m-d', strtotime($res->created_at)) }}</td>
                        <td>{{ $res->description }}</td>
                        <td>{{ $res->Category->category_name }}</td>
                        <td>{{ $res->payment_method }}</td>
                        <td>{{ $res->expense_amount }}</td>
                    </tr>
                @endforeach





            </tbody>
        </table>



    </div>
@endsection

@section('datatables')
    <script src="{{ asset('assets/js/dataTable.js') }}"></script>
    <script src ='https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js' ></script>
    <script src ='https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js' ></script>
    <script>
    




        function searchFilter() {

            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var category_id = $('#category_id').val();
            var payment = $('#payment_method').val();

            if (start_date != '' && end_date != '') {
                $.ajax({
                    url: 'expense-report-filter',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        start_date: start_date,
                        end_date: end_date,
                        category_id: category_id,
                        payment: payment,

                    },

                    success: function(response) {
                        console.log(response.result);
                        var html = '';
                        $.each(response.result, function(key, value) {
                            html += `<tr> 
                    <td>${key+1}</td>
                     <td>${value.created_at }</td>
                    <td>${value.description}</td>
                    <td>${value.category['category_name']}</td>
                    <td>${value.payment_method}</td>
                    <td>${value.expense_amount}</td>
                    `

                        });

                        $('#expense-tbody').html(html);
                        //reload datatable
                        $('#expense-table').DataTable().ajax.reload();
                    }

                })
            }
        }
    </script>
@endsection
