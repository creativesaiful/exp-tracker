@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between mb-3">
        <h2>Expenses</h2>

        <button type="button" class="btn bg-gradient-info" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
            Add Expense
        </button>
    </div>



    <div class="table-responsive">
        <table class="table table-flush" id="expense-table">
            <thead class="thead-light">
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SL</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Eepense Category</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Method</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount</th>


                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>

                </tr>
            </thead>
            <tbody id="expense-body">
           
               
            


            </tbody>
        </table>
    </div>


    <!--Add Modal -->
    <div class="modal fade" id="addExpenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="addExpenseModal">Add Expense</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="expense-add-form">
                        @csrf
                        <div class="input-group input-group-static mb-4">
                            <label for="category" class="ms-0">Select Expense Category</label>
                            <select class="form-control" id="category_id" name="category_id" required>
                                <option selected> Select </option>
                                @foreach ($cate as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Description </label>
                            <input type="text" name="description" class="form-control" required>
                        </div>

                        <div class="input-group input-group-static mb-4">
                            <label for="category" class="ms-0">Select Payment Method</label>
                            <select class="form-control" id="payment_method" name="payment_method" required>
                                <option selected> Select </option>
                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div>






                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Amount </label>
                            <input type="number" id="expense_amount" name="expense_amount" class="form-control" required>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-primary" onclick="storeExpense()">Submit</button>

                </div>
            </div>
        </div>
    </div>



    <!--Edit Modal -->
    <div class="modal fade" id="editExpenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title font-weight-normal" id="editExpenseModal">Edit Expense</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="expense-edit-form">
                        @csrf
                        <input type="hidden" name="expense_id" id="expense-id">
                        <div class="input-group input-group-static mb-4">
                            <label for="category" class="ms-0">Select Expense Category</label>
                            <select class="form-control" id="edit_category_id" name="category_id" required>

                                @foreach ($cate as $cate)
                                    <option value="{{ $cate->id }}">{{ $cate->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Description </label>
                            <input type="text" id="edit_description" name="description" class="form-control"
                                required>
                        </div>

                        <div class="input-group input-group-static mb-4">
                            <label for="category" class="ms-0">Select Payment Method</label>
                            <select class="form-control" id="edit_payment_method" name="payment_method" required>

                                <option value="Cash">Cash</option>
                                <option value="Card">Card</option>
                                <option value="Cheque">Cheque</option>
                            </select>
                        </div> 






                        <div class="input-group input-group-outline mb-3">
                            <label class="form-label">Amount </label>
                            <input type="number" id="edit_expense_amount" name="expense_amount" class="form-control"
                                required>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn bg-gradient-primary" onclick="UpdateExpense()">Submit</button>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('datatables')
    <script>
        $(document).ready(function() {



            const dataTableBasic = new simpleDatatables.DataTable("#expense-table", {
                searchable: true,
                paging: true, // Enable pagination
                ordering: true, // En

            });

            showExpense();

            function showExpense() {
                $.ajax({
                    url: 'expenses/',
                    type: 'GET',
                    success: function(response) {
                        var Html = ''; // Initialize an empty string to accumulate HTML

                        for (var i = 0; i < response.length; i++) {


                            var createdAt = new Date(response[i].created_at);

                            Html += `
                    <tr>
                        <td> ${i+1} </td>
                        <td>${createdAt.toLocaleDateString('en-GB')}</td>
                        <td>${response[i].description}</td>
                        <td>${response[i].category.category_name}</td>
                        <td>${response[i].payment_method}</td>
                        <td class="amount">${response[i].expense_amount}</td>
                        <td>
                            
                            <button type="button" class="btn bg-gradient-info edit" data-bs-toggle="modal" data-bs-target="#editExpenseModal" onclick="editExpense(${response[i].id})">Edit</button>

                            <button type="button" class="btn bg-gradient-danger edit" onclick="deleteExpense(${response[i].id})">Delete</button>
                            



                          
                        </td>
                    </tr>
                `;
                        }


               

                        // Set the HTML of the #expense-table element after the loop
                        $('#expense-body').html(Html);
                    }
                });
            }

            //Add expesns
            function storeExpense() {
                var category_id = $('#category_id').val();
                var payment_method = $('#payment_method').val();
                var expense_amount = $('#expense_amount').val();


                if (category_id === "Select" || payment_method === "Select" || expense_amount === "") {
                    toastr.error('Please fill all required fields');
                    return false;
                } else {
                    $.ajax({
                        url: 'store-expense',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: $('#expense-add-form').serialize(),
                        success: function(response) {
                            showExpense();
                            $('#addExpenseModal').modal('hide');
                            $('#expense-add-form')[0].reset();
                            toastr.success(response.message);
                        }
                    })
                }


            }


            //Edit expesns
            function editExpense(id) {
                $.ajax({
                    url: 'edit-expense/' + id,
                    type: 'GET',
                    success: function(response) {
                        $('#expense-id').val(id);
                        $('#edit_description').val(response[0].description);
                        $('#edit_expense_amount').val(response[0].expense_amount);
                    }
                });
            }


            //update expeses
            function UpdateExpense() {
                var expense_id = $('#expense-id').val();
                var expense_amount = $('#edit_expense_amount').val();
                if (expense_amount === "") {
                    toastr.error('Please fill all required fields');
                } else {
                    $.ajax({
                        url: 'update-expense/' + expense_id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        data: $('#expense-edit-form').serialize(),
                        success: function(response) {
                            showExpense();
                            $('#editExpenseModal').modal('hide');
                            toastr.success(response.message);
                        }

                    })
                }
            }

            //    delete expens 

            function deleteExpense(id) {
                $.ajax({
                    url: 'expenses/' + id,
                    type: 'get',
                    success: function(response) {
                        showExpense();
                        toastr.warning(response.message);
                    }
                });
            }
          

        });
    </script>
@endsection
