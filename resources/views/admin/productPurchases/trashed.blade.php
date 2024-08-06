@extends('admin.include.app')
@section('content')
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Trashed Items of Purchased  Products</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('productPurchases.create')}}" class="btn btn-primary">New Product Purchase</a>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="container-fluid">
        <div class="card">
            <form action="">
                @csrf
                <div class="card-header">
                    <div class="card-tools">
                        <div class="input-group input-group" style="width: 250px;">
                            <input type="text" name="keyword" value="{{Request::get('keyword')}}" class="form-control float-right" placeholder="Search">
        
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-default">
                                <i class="fas fa-search"></i>
                              </button>
                            </div>
                          </div>
                    </div>
                </div>

            </form>
            <div class="card-body table-responsive p-0">								
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Product Id</th>
                            <th width="80">Size</th>
                            <th>Color</th>
                            <th>Material</th>
                            <th>Selling Price</th>
                            <th>Purchasing Price</th>
                            <th>Quantity</th>
                            <th>Total Price</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       @php
                           $count = 1;
                       @endphp
                       @foreach ($productPurchases as $productPurchase)
                       <tr id="product-{{$productPurchase->id}}">
                        <td>{{$count}}</td>
                        <td>{{$productPurchase->product_id}}</td>
                        <td>{{$productPurchase->size_id}}</td>
                       <td>{{$productPurchase->color_id}}</td>
                       <td>{{$productPurchase->material_id}}</td>
                        <td>{{$productPurchase->selling_price}}</td>
                        <td>{{$productPurchase->purchasing_price}}</td>
                        <td>{{$productPurchase->quantity}}</td>
                        <td>{{$productPurchase->totalPrice}}</td>

                        <td>
                            <a href="{{route('productPurchases.restored',$productPurchase->id)}}" class="btn btn-info">
                               Restored
                            </a>
                            <a href="" onclick="PermanentDeleteItems({{$productPurchase->id}})"  class="text-danger w-4 h-4 mr-1">
                                
                            </a>
                        </td>
                    </tr>
                    @php
                        $count++;
                    @endphp
                       @endforeach
                       
                    </tbody>
                </table>										
            </div>
            <div class="card-footer clearfix">
               {{$productPurchases->links()}}
                
                {{-- <ul class="pagination pagination m-0 float-right">
                  <li class="page-item"><a class="page-link" href="#">«</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">»</a></li>
                </ul> --}}
            </div>
        </div>
    </div>
    <!-- /.card -->
</section>
<!-- /.content -->

@endsection

@section('customJs')
    <script>
        // function deleteProductPurchase(event,id)
        // {
        //     event.preventDefault();

        //     var url = "{{route('productPurchases.delete','ID')}}";
        //     var newUrl = url.replace("ID",id);


        //     if(confirm('Are you sure you want to delete this Purchase Item?'))
        // {
        //     $.ajax({
        //        url:newUrl,
        //        type:'delete',
        //        data:{},
        //        dataType:'json',
        //        success:function(response)
        //        {
        //             if(response['status'] == true)
        //             {
        //                 $("#product-"+id).remove();
        //             }
        //             else
        //             {
        //                 alert("Product Id is not deleted successfully");
        //             }
                    
               
        //        }

        //     })
        // }
        // }

        function PermanentDeleteItems(id)
        {
            if(confirm("Are you sure you want to delete this permamently")){
                window.location.href = '{{route("productPurchases.delete")}}';
            }
        }

        

        </script>
@endsection