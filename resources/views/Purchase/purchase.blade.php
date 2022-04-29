@extends('Layout.master')
   
@section('content')              
  <!-- Main Content -->

  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Purchase List</h4> &nbsp;&nbsp;&nbsp;
         {{-- date range filter start --}}
          <form action="{{URL::to('/')}}/purchasesearch" method="get">
               
            <div class="input-group mb-3">
                <input type="date" style="width: 150px;"   name="start_date" required=""> &nbsp; &nbsp;
                <input type="date" style="width: 150px;" name="end_date" required="">&nbsp;&nbsp;
                <button class="btn btn-warning" name="submit" value="Save" type="submit">GET</button>
            </div>
          </form>
          {{-- end of date range --}}
        </div>
        <br/>

       
        <div class="buttons" style="text-align: right; " >
            <a href="#" class="btn btn-icon icon-left btn-info" id="openmodel"><i class="fa fa-edit"></i> Bulk Edit</a>
          <a href="{{URL::to('/')}}/Purchase/addpurchase" class="btn btn-icon icon-left btn-info"><i class="fa fa-edit"></i> New Purchase</a>
         </div><br/>
         
        <div class="card-body">
          <div class="table-responsive">
              
            <table class="table table-striped" id="table-2" >
              <thead>
                <tr>
                    <th class="text-center">
                            <div class="custom-checkbox custom-checkbox-table custom-control">
                              <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad"
                                class="custom-control-input" id="checkbox-all" >
                              <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                            </div>
                            
                           
                          
                          
                          </th>
                         
                  <th class="text-center">
                   Id
                  </th>
                  <th style=" min-width:100px;" class="text-center">Date</th>
                  <th style=" min-width:90px;">Sale Action</th>
                  <th>Party Name</th>
                  <th>Mobile No.</th>
                  <th>City</th>
                  <th>Price</th>
                  <th>Brand</th>
                  <th>Model No</th>
                  <th>RAM/GB</th>
                  <th>Colour</th>
                  <th>Warranty</th>
                  <th style=" min-width:80px;">Warranty Date</th>
                  <th>IMEI Number</th>
                  <th>Image1</th>
                  <th>Image2</th>
                  <th>Invoice Number</th>
                  <th style=" min-width:80px;" >Invoice Date</th>
                  <th style=" min-width:80px;" >Invoice Number</th>
                  
                  <th style=" min-width:390px;">Action</th>
                  
                </tr>
              </thead>
              <tbody>
                <?php $count = 1; ?>
                @foreach($data as $key )
                
                <tr>
                   
               <td>  <input type="checkbox" name="select[]" id="check" value="{{$key->id}}"  data-checkboxes="mygroup" ></td>
           
                  <td> <?php echo $count; ?></td>
                  <td> {{ date('d-m-Y', strtotime($key->date)) }}</td>
                  <td >@if ($key->sale_action=='sale') <button class="btn btn-success" style=" width: 90px !important; " >Sale</button>  @elseif($key->sale_action=='saleout')  <button class="btn btn-danger" style=" width: 90px !important;" >Saleout</button> @else <button class="btn btn-light" style=" width: 90px !important;" >Purchase</button>   @endif</td>
                  <td>{{$key->party_name }}</td>
                  <td>{{$key->party_mob_no }}</td>
                  <td>{{$key->city }}</td>
                  <td>{{$key->price }}</td>
                  <td >{{$key->brand }}</td>
                  <td>{{$key->model_number }}</td>
                  <td>{{$key->RAM_GB }}</td>
                  <td>{{$key->colour }}</td>
                  <td>{{$key->warranty }}</td>
                  <td> @if ($key->warranty=='YES' ){{ date('d-m-Y', strtotime($key->warranty_date)) }}  @else   @endif</td>
                  <td>{{$key->IMEI_Number }}</td>
                  <td><img alt="image" class="avatar mr-2" src="{{ URL::to('/') }}/public/picture/{{ $key->image1 }}"></td>
                  <td><img alt="image" class="avatar mr-2" src="{{ URL::to('/') }}/public/picture/{{ $key->image2 }}"></td>
                  <td>{{$key->invoice_number }}</td>
                  <td>@if ($key->invoice_number=='YES' ){{ date('d-m-Y', strtotime($key->invoice_date)) }}  @else   @endif</td>
                  <td>@if ($key->invoice_number=='YES' ){{$key->invoice_num }} @else   @endif</td>
                  <td>@if ($key->sale_action == 'Purchase')
                  <a href="{{URL::to('/')}}/Purchase/editPurchase/{{$key->id}}" style=" width: 150px !important; " class="btn btn btn-success" >EDIT PURCHASE</a>
                  <a href="{{URL::to('/')}}/Sales/editSold/{{$key->id}}" style=" width: 140px !important; " class="btn btn btn-info" >EDIT FOR SOLD</a>
                    <a style=" width: 75px !important; " class="btn btn btn-warning" onclick="return confirm('Are you sure you want to delete this record !'); " href="{{URL::to('/')}}/Purchase/delete/{{$key->id}}">DELETE</a></td>
                @else
                     <!--<a href="{{URL::to('/')}}/Purchase/editSale/{{$key->id}}" style=" width: 100px !important; " class="btn btn btn-info" >EDIT SALE</a>-->
                    <a style=" width: 75px !important; " class="btn btn btn-warning" onclick="return confirm('Are you sure you want to delete this {{$key->party_name}} record !' ); " href="{{URL::to('/')}}/Purchase/delete/{{$key->id}}">DELETE</a></td>
                    @endif
                
                </tr>
               
                <?php $count++; ?> 

                @endforeach
                       
               
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection



   <!-- The Modal --> 
  
   <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
         
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Bulk Edit Modal </h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
       
        <div class="modal-body">
        <form id="CustomerForm" name="CustomerForm"   enctype="multipart/form-data">
          @csrf
          <div class="data-table">
           
            {{-- <div class="form-row">
                            <input type="hidden" class="form-control  " id ="id" name="id" value="" readonly>
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control"id="party_name" name="party_name" value="" placeholder="Party Name" readonly>
                            </div>
                        
                            <div class="form-group col-md-4">
                                <input type="text" class="form-control "  id="price"  name="price" value="" placeholder="Price" required="">
                            </div>
                        
                        
                            <div class="form-group col-md-4">
                                <select id="sale_action"  name="sale_action" class="form-control" >
                                <option value="">Purchase</option>
                                <option id="sale_action" value="Sale">Sale</option>
                               
                                </select>
                            </div>
              </div> --}}
                  
            </div>               
        </form>
        
        </div>
        <div class="modal-footer">
          <button type="button" id="btn-save" class="btn btn-primary ">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

      
<!--end model-->


 

        
          
 
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>


               

 <script>
        $(document).on('click','#openmodel',function(){
              $(".data-table").empty();
            var checkedRecords = [];
	        $("input[type='checkbox']:checked").each(function() {
	            checkedRecords[checkedRecords.length] = this.value;
	        });
	        if(!checkedRecords.length) {
	            alert("Please check one or muliple records to update")
	            return false;
	        }
	        $('#myModal').modal('show');
	        console.log(checkedRecords,'checkedRecords', '/Purchase/getBulkPurchaseData');
            $.ajax({
                type:"POST",
                url: '/Purchase/getBulkPurchaseData',
                data: { id: checkedRecords, "_token": "{{ csrf_token() }}" },
                dataType: 'json',
                
                success: function(res){
                    $('#id').val(res.id);
                    $('#party_name').val(res.party_name);
                    $('#price').val(res.price);
                    $('#city').val(res.city);
                    $('#party_mob_no').val(res.party_mob_no);
                    $('#sale_action').val(res.sale_action);
                    $('#date').val(res.date);
                    $('#warranty_date').val(res.warranty_date);
                    $('#invoice_date').val(res.invoice_date);
                    
                    var html = '';
                    console.log(res);     
                    res.forEach(function(data) {
                        html +='<div class="form-row">';
                      
                        html += '<div class="form-group col-md-2">';
                        html += '<input type="date" class="form-control" id="date" name="row['+data.id+'][date]" value="{{date('Y-m-d')}}" readonly >';
                        html += '</div>';

                        html += '<div class="form-group col-md-2">';
                        html += '<input type="hidden" class="form-control" id="" name="row['+data.id+'][id]" value="'+data.id+'" readonly>';
                        html += '<input type="text" class="form-control id="party_name" name="row['+data.id+'][party_name]" value="'+data.party_name+'" placeholder="Party Name" >';
                        html += '</div>';

                        html +='<div class="form-group col-md-2">';
                        html +='<input type="text" class="form-control  id="city"  name="row['+data.id+'][city]" value="'+data.city+'" placeholder="city" required="">';
                        html +='</div>';

                        html +='<div class="form-group col-md-2">';
                        html +='<input type="text" class="form-control  id="party_mob_no"  name="row['+data.id+'][party_mob_no]" value="'+data.party_mob_no+'" placeholder="Mobile_number" required="">';
                        html +='</div>';
                        
                        html +='<div class="form-group col-md-2">';
                        html +='<input type="text" class="form-control  id="price"  name="row['+data.id+'][price]" value="'+data.price+'" placeholder="Price" required="">';
                        html +='</div>';

                       
                        html +='<input type="hidden" class="form-control"  id="brand"  name="row['+data.id+'][brand]" value="'+data.brand+'" >';
                        html+='<input type="hidden" class="form-control" id="warranty" name="row['+data.id+'][warranty]" value="'+data.warranty+'" >';
                        
                        html +='<div class="form-group col-md-2">';
                        html +='<select name="row['+data.id+'][sale_action]"   class="form-control" >';
                        html +='<option id="sale_action" name="row['+data.id+'][sale_action]" value="Purchase">Purchase</option>';
                        html +=' <option id="sale_action" name="row['+data.id+'][sale_action]"   value="saleout" required="">SaleOut</option>';
                        html +='</select>';
                        html +='</div>';
                        
                        html+='<input type="hidden" class="form-control col-md-2" id="invoice_date" name="row['+data.id+'][invoice_date]" value="'+data.invoice_date+'" >';

                        html+='<input type="hidden" class="form-control col-md-2" id="warranty_date" name="row['+data.id+'][warranty_date]" value="'+data.warranty_date+'" >';
                       
                        html+='<input type="hidden" class="form-control col-md-2" id="invoice_num" name="row['+data.id+'][invoice_num]" value="'+data.invoice_num+'" >';

                        html+='<input type="hidden" class="form-control col-md-2" id="invoice_number" name="row['+data.id+'][invoice_number]" value="'+data.invoice_number+'" >';

                        html +='<input type="hidden" class="form-control col-md-2"  id="model_number"  name="row['+data.id+'][model_number]" value="'+data.model_number+'" >';
                       
                       

                        html +='</div>';
                       
                               
                    });
                    $(".data-table").append(html);
                
                }
            });
});

$(document).on('click','#btn-save',function(e) {
e.preventDefault();

    
   
            $.ajax({
            type:'POST',
            url: '/Purchase/storeBulkPurchaseData',
            
            data: $('#CustomerForm').serialize(),
           
            dataType: "json",
            
            success:function (data) {
             
            $('#CustomerForm').trigger("reset");
            $("#myModal").modal('hide');
            $("#id").val(data.id);
            $('#price').val(data.price);
            $('#party_name').val(data.party_name);
            $('#sale_action').val(data.sale_action);
            $('#city').val(data.city);
            $('#party_mob_no').val(data.party_mob_no);
            $('#brand').val(data.brand);
            $('#model_number').val(data.model_number);
            $('#invoice_number').val(data.invoice_number);
            $('#invoice_num').val(data.invoice_num);
            $('#invoice_date').val(data.invoice_date);
           $('#warranty_date').val(data.warranty_date);
            $('#warranty').val(data.warranty);
            $('#date').val(date);
           
            $("#btn-save").html('Submit');
            location.reload(true); 
            
          },
          
          
        });
});
 </script>
