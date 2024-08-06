@extends('admin.include.app')
@section('content')
<section class="content-header">					
    <div class="container-fluid my-2">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Products</h1>
            </div>
            <div class="col-sm-6 text-right">
                <a href="{{route('attributeValues.create')}}" class="btn btn-primary">New Attribute</a>
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
                            <th width="80">Size</th>
                            <th>Color</th>
                            <th>Material</th>
                            <th width="100">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($attributeValues as $attributeValue)
                        <tr id="attributeValue-{{$attributeValue->id}}">
                            <td>{{$count}}</td>
                            <td>{{$attributeValue->size}}</td>
                            <td>{{$attributeValue->color}}</td>
                            <td>{{$attributeValue->material}}</td>										
                            
                            <td>
                                <a href="{{route('attributeValues.edit',$attributeValue->id)}}">
                                    <svg class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path>
                                    </svg>
                                </a>
                                <a href="" onclick="deleteAttributeValue({{$attributeValue->id}})" class="text-danger w-4 h-4 mr-1">
                                    <svg wire:loading.remove.delay="" wire:target="" class="filament-link-icon w-4 h-4 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path	ath fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                      </svg>
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
               {{$attributeValues->links()}}
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
        function deleteAttributeValue(id)
        {
            var url = "{{route('attributeValues.delete','ID')}}";
            var newUrl = url.replace("ID",id);
            if(confirm("Are you sure you want to delete this Attribute Value"))
        {
            $.ajax({
                url:newUrl,
                type:'delete',
                data:{},
                dataType:'json',
                success:function(response)
                {
                    if(response['status'] == true)
                {
                    $("#attributeValue-"+id).remove();
                }
                }
            })
        }
        }
    </script>
@endsection