@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-between mb-3">
        <h2>Category List</h2>

        <button type="button" class="btn bg-gradient-primary" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
          Add Category
        </button>
    </div>

<div class="table-responsive">
    <table class="table table-flush" id="category-table">
      <thead class="thead-light">
        <tr>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SL</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
          
        </tr>
      </thead>
      <tbody>


        @php
        $serialNumber = 1; // Initialize the serial number counter
    @endphp
    
    @foreach ($category as $categories)
        <tr>
            <td class="text-sm font-weight-normal">{{ $serialNumber }}</td>
            <td class="text-sm font-weight-normal">{{ $categories->category_name }}</td>
            <td class="text-sm font-weight-normal">
              
              <button type="button"  class="btn bg-gradient-primary edit"  data-bs-toggle="modal" data-bs-target="#editCategoryModal"  onclick="editCategory({{ $categories->id }})" >
                Edit
              </button>
              
              <button type="button"  class="btn bg-gradient-danger edit" onclick="deleteCategory({{ $categories->id }}) "  >
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
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="addCategoryModal">Add Expense Category</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="{{route('store-category')}}" method="POST" id="cate-form" >
          @csrf
          <div class="input-group input-group-outline mb-3">
            <label class="form-label">Category Name</label>
            <input type="text" name="category_name" class="form-control" required value="{{ old('category_name') }}" required>
          </div>
        </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary" onclick="$('#cate-form').submit()">Save changes</button>

      </div>
    </div>
  </div>
</div>


<!--Edit Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-weight-normal" id="editCategoryModal">Edit Expense Category</h5>
        <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">


        <form action="{{route('update-category')}}" method="POST" id="cate-update-form" >
          @csrf
          <div class="input-group input-group-outline mb-3">
            <input type="hidden" name="category_id" id="category-id">

            <input type="text" name="category_name"  id = "category-name" class="form-control" required>
          </div>
        </form>



      </div>
      <div class="modal-footer">
        <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn bg-gradient-primary" onclick="$('#cate-update-form').submit()">Save changes</button>

      </div>
    </div>
  </div>
</div>


@endsection


@section('datatables')
<script>
    const dataTableBasic = new simpleDatatables.DataTable("#category-table", {
      searchable: true,
      fixedHeight: true
    });


    // ajax calling

    function editCategory(id) {

      $.ajax({
      url: '/edit-category/' + id ,
      type: 'GET',
      success: function(response) {


        $('#category-name').val(response.category_name);
        $('#category-id').val(response.id);
   
      }
    });
    };

    function deleteCategory(id){
      $.ajax({
        url: '/delete-category/' + id ,
        type: 'GET',
        success: function(response) {

      
          toastr.warning(response.message);
          window.location.reload();

        }
      })
    }

    



   
  </script>

@endsection