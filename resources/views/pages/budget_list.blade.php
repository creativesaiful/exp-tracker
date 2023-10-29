@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Budgets</h2>

        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
            Add Budget
        </button>
    </div>

    <div class="table-responsive">
        <table class="table table-flush" id="budget-table">
            <thead class="thead-light">
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SL</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget Category</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Period</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Month Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Year</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                </tr>
            </thead>
            <tbody>

                @php
                    $serialNumber = 1; // Initialize the serial number counter
                @endphp

                @foreach ($budgets as $budget)
                    <tr>
                        <td class="text-sm font-weight-normal">{{ $serialNumber }}</td>
                        <td class="text-sm font-weight-normal">{{ $budget->Category->category_name }}</td>
                        <td class="text-sm font-weight-normal">{{ $budget->period }}</td>
                        <td class="text-sm font-weight-normal">{{ $budget->month_name }}</td>
                        <td class="text-sm font-weight-normal">{{ $budget->year }}</td>
                        <td class="text-sm font-weight-normal amount" data-current="{{ $budget->budget_amount }}" >{{  $budget->budget_amount  }}</td>

                        <td class="text-sm font-weight-normal">

                            <button type="button" class="btn bg-gradient-primary edit" data-bs-toggle="modal"
                                data-bs-target="#editCategoryModal" onclick="editCategory()">
                                Edit
                            </button>

                            <button type="button" class="btn bg-gradient-danger edit" onclick="deleteBudget({{ $budget->id }}) ">
                                Delete
                            </button>

                        </td>
                    </tr>

                    @php
                        $serialNumber++; // Increment the serial number counter
                    @endphp
                @endforeach







            </tbody>
        </table>
    </div>




    <!-- Button trigger modal -->


    <!-- Modal -->
    <div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="addCategoryModal">Add Budget</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="budget-add-form">
                        @csrf
                        <div class="input-group input-group-static mb-4">
                            <label for="category" class="ms-0">Select Budget Category</label>
                            <select class="form-control" id="category" name="category_id" required>
                                <option selected> Select </option>
                                @foreach ($cate as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-static mb-4">
                            <label for="period" class="ms-0">Select Period</label>
                            <select class="form-control" id="period" name="period">

                                @foreach ($periods as $period)
                                    <option value="{{ $period }}">{{ ucfirst($period) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-static mb-4 month-section">
                            <label for="month" class="ms-0">Select Month</label>
                            <select class="form-control" id="month" name="month_name">
                                
                                @foreach ($months as $month)
                                    <option value="{{ $month }}">{{ ucfirst($month) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-static mb-4">
                            <label for="year" class="ms-0">Select Year</label>
                            <select class="form-control" id="year" name="year">
                                @foreach ($years as $year)
                                    <option value="{{ $year }}">{{ ucfirst($year) }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Amount </label>
                            <input type="text" name="budget_amount" class="form-control" required>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-primary" onclick="storeBudget()">Submit</button>

                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="editCategoryModal">Edit Expense Category</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <form action="{{ route('update-category') }}" method="POST" id="cate-update-form">
                        @csrf
                        <div class="input-group input-group-outline mb-3">
                            <input type="hidden" name="category_id" id="category-id">

                            <input type="number" name="category_name" id = "category-name" class="form-control"
                                required>
                        </div>
                    </form>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn bg-gradient-primary" onclick="$('#cate-update-form').submit()">Save changes</button> --}}

                    <button type="button" class="btn bg-gradient-primary" onclick="storeBudget()">Save changes</button>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('datatables')
    <script>
        const dataTableBasic = new simpleDatatables.DataTable("#budget-table", {
            searchable: true,
            fixedHeight: true
        });


        $('#period').change(function() {
            var period = $(this).val();
            if (period == 'monthly') {
                $('.month-section').show();
            } else {
                $('.month-section').hide();
            }
        });


        // ajax calling

        function storeBudget() {
            if (!validateForm()) {

            } else {
                $.ajax({
                    url: '/store-budget',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',

                    data: $('#budget-add-form').serialize(),
                    success: function(response) {
                        if (response.type === 'success') {
                            toastr.success(response.message);
                        } else {
                            toastr.error(response.message);
                        }
                        window.location.reload();
                    },

                });
            }




            function validateForm() {
                var category = $('#category').val();
                var period = $('#period').val();
                var month = $('#month').val();
                var year = $('#year').val();
                var budgetAmount = $('input[name="budget_amount"]').val();

                if (period === 'monthly') {
                    if (category === "Select" || period === "Select" || month === "Select" || year === "Select" ||
                        budgetAmount === "") {
                        toastr.error('Please fill all required fields'); 
                        return false;
                        
                    }
                } else {
                    if (category === "Select" || period === "Select" || year === "Select" || budgetAmount === "") {
                        toastr.error('Please fill all required fields');
                        return false;
                    }
                }

                return true;
            }





        }

        function deleteBudget(id){
      $.ajax({
        url: '/delete-budget/' + id ,
        type: 'GET',
        success: function(response) {

      
          toastr.warning(response.message);
          window.location.reload();

        }
      })
    }
    </script>
@endsection
