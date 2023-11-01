@extends('layouts.app')

@section('content')
   
<div class="d-flex justify-content-between mb-3">
    <h2>Budget Reports</h2>
</div>

<div class="row">


     
<div class="col-md-3 mb-3">
    <select class="form-select" aria-label="Default select example">
        <option selected>Select Report type</option>
        <option value="1">Monthly</option>
        <option value="2">Yearly</option>
      </select>
</div>

<div class="col-md-3 mb-3">
    <div class="input-group input-group-static">
        <input class="form-control datepicker" placeholder="Please select Date Range" type="text" onfocus="focused(this)" onfocusout="defocused(this)">
      </div>
</div>

</div>

<div class="table-responsive">
    <table class="table table-flush" id="expense-table">
        <thead class="thead-light">
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SL</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget Category</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Budget Amount</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Expense Amount</th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"> Budget Limit Exceeded</th>

            </tr>
        </thead>
        <tbody id="expense-body">


        </tbody>
    </table>
</div>

@endsection

@section('datatables')

@endsection