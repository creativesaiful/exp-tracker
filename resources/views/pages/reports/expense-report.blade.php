@extends('layouts.app')

@section('content')
   
<div class="d-flex justify-content-between mb-3">
    <h2>Expense Reports</h2>
</div>

<div class="row">
    <div class="col-md-3 mb-3">
        <div class="input-group input-group-static">
            <input class="form-control datepicker" placeholder="Please select Date Range" type="text" onfocus="focused(this)" onfocusout="defocused(this)">
          </div>
    </div>

     
<div class="col-md-3 mb-3">
    <select class="form-select" aria-label="Default select example">
        <option selected>Select Category</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
</div>
<div class="col-md-3 mb-3">
    <select class="form-select" aria-label="Default select example">
        <option selected>Select Payment Method</option>
        <option value="1">One</option>
        <option value="2">Two</option>
        <option value="3">Three</option>
      </select>
</div>
</div>

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
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Remaining Budget</th>

            </tr>
        </thead>
        <tbody id="expense-body">


        </tbody>
    </table>
</div>

@endsection