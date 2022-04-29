@extends('Layout.master')
   
@section('content')              
  <!-- Main Content -->

  <div class="card">
    <div class="card-header">
      <h4>Edit Sales Form</h4>
    </div>
    <div class="card-body">
 {{-- error report --}}
      @if (count($errors) > 0)
      <div class="alert alert-danger">
      <strong>Whoops!</strong> There were some problems with your input.
      <ul>
      @foreach ($errors->all() as $error)
      <li>{{ $error }} </li>
       
      @endforeach
      </ul>
      </div>
  @endif 
   {{-- end of error report --}}
    @foreach($data as $key)
  <form class="needs-validation" action="{{URL::to('/')}}/Sales/storesoldout" method="post"   enctype="multipart/form-data">
    {{ csrf_field() }}    
    <input type="hidden" name="id" value="{{ $key->id }}"  class="form-control" >  
     
      <div class="form-row">
        
        <div class="form-group col-md-6">
          <label >Date</label>
          <input type="date" class="form-control" name="date" value="{{date('Y-m-d')}}" readonly >
        </div>
        <div class="form-group col-md-6">
        <label >Price</label>
        <input type="text" class="form-control" value="{{$key->price}}" name="price" placeholder="Price"  required>
      </div>
      <div class="form-group col-md-6">
        <label>Sale Action</label>
        <select name="sale_action" class="form-control">
        {{-- <option value="sale" @if($key->sale_action == 'sale') selected='selected' @endif>Sale</option> --}}
        <option value="saleout" @if($key->sale_action == 'saleout') selected='selected' @endif>SaleOut</option>
        </select>
      </div>
        <div class="form-group col-md-6">
          <label >Party Name</label>
          <input type="text" class="form-control" name="party_name" value="" placeholder="Party Name" required>
        </div>
        <div class="form-group col-md-6">
          <label>Party Mobile No.</label>
          <input type="text" class="form-control" name="party_mob_no" value="" placeholder="Party Mobile No." required >
        </div>
        <div class="form-group col-md-6">
          <label >City</label>
          <input type="text" class="form-control" name="city" value=""  placeholder="City" required>
        </div>
        <div class="form-group col-md-6">
          
          <input type="hidden" class="form-control" name="brand"  value="{{$key->brand}}" >
        </div>
        <div class="form-group col-md-6">
         
          <input type="hidden" class="form-control" name="model_number" value="{{$key->model_number }}"  >
        </div>

        <div class="form-group col-md-6">
         
          <input type="hidden" class="form-control" name="invoice_num" value="{{$key->invoice_num}}"   >
        </div>

        <div class="form-group col-md-6">
         
          <input type="hidden" class="form-control" name="invoice_number" value="{{$key->invoice_number}}"   >
        </div>

        <div class="form-group col-md-6">
         
          <input type="hidden" class="form-control" name="invoice_date" value="{{$key->invoice_date}}"   >
        </div>

        <div class="form-group col-md-6">
         
          <input type="hidden" class="form-control" name="warranty_date" value="{{$key->warranty_date}}"   >
        </div>

        <div class="form-group col-md-6">
         
          <input type="hidden" class="form-control" name="warranty" value="{{$key->warranty}}"   >
        </div>

       
  
      </div>
    
    <div class="card-footer">
      <button class="btn btn-info">Submit</button>
       <a href="{{URL::to('/')}}/Purchase/purchase" class="btn btn-warning" >Cancle</a>
    </div>
  </div>
</Form>
  @endforeach
  
  
 


@endsection

 