@extends('layouts.backend.app')

@section('title','Author Post')

@push('css')
  <link href="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css') }}" rel="stylesheet">
@endpush

@section('content')

  <div class="container-fluid">
            <div class="block-header">
                 
                 <a class="btn btn-primary waves-effect" href="{{ route('author.post.create') }}">
                 	<i class="material-icons">add</i>
                 	<span> Добавить новый пост </span> </a>
    
     @if(session('successMsg'))

     <div class="alert alert-success" roles="alert">
     {{ session('successMsg') }} 

     </div> 
     @endif            	


            </div>
            <!-- Basic Examples -->
            
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              ВСЕ ПОСТЫ
                              <span class="badge bg-red">{{ $posts->count() }} </span>
                            </h2>
                           
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                            <th>Автор</th>
                                           <!-- <th><i class="material-icons">visibility</i></th>-->
                                            <th>На утверждении</th>
                                            <th>Статус</th>
                                            <th>Создан </th>
                                           
                                            <th>Действие</th>
                                             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>ID</th>
                                            <th>Название</th>
                                            <th>Автор</th>
                                            <!--<th><i class="material-icons">visibility</i></th>-->
                                            <th>На утверждении</th>
                                            <th>Статус</th>
                                            <th>Создан</th>
                                             
                                            <th>Действие</th>
                                        </tr>
                                    </tfoot>
                                    
                                    <tbody>
                                    	@foreach($posts as $key=>$post)
                                    	 <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($post->title,'15')  }}</td>
                                            <td>{{ $post->user->name  }}</td>
                                            <!--<td>{{ $post->view_count  }}</td>-->
                                             <td> 
                               @if($post->is_approved == true)
                               <span class="badge bg-blue">Approved</span>
                               @else
                               <span class="badge bg-pink">Pending</span>

                               @endif 
                                </td>

                                              <td>

                               @if($post->status == true)
                               <span class="badge bg-blue">Published</span>
                               @else
                               <span class="badge bg-pink">Pending</span>

                               @endif
                                              </td>


                                                <td>{{ $post->created_at  }}</td>
                                               
                                           
 

                                            <td class="text-center">

             <a href="{{ route('author.post.show',$post->id) }}" class="btn btn-info waves-effect">
                <i class="material-icons">visibility</i>
              </a>
                                         
              <a href="{{ route('author.post.edit',$post->id) }}" class="btn btn-info waves-effect">
              	<i class="material-icons">edit</i>
              </a>

       <button class="btn btn-danger waves-effect" type="button" onclick="deletePost({{ $post->id }})">
              	<i class="material-icons">delete</i>
              </button>

    <form id="delete-form-{{ $post->id }}" action="{{ route('author.post.destroy',$post->id) }}" method="POST" style="display: none;">
              	@csrf
              	@method('DELETE')
              	
              </form>


                                             </td>
                                             
                                        </tr>
                                   @endforeach
                                    </tbody>


                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>

@endsection

@push('js')
 <!-- Jquery DataTable Plugin Js -->
    <script src=" {{ asset('public/assets/backend/plugins/jquery-datatable/jquery.dataTables.js') }}  "></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js') }} "></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js') }} "></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js') }} "></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js') }} "></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js') }} "></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js') }} "></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js') }} "></script>
    <script src="{{ asset('public/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js') }} "></script>

    <!-- Custom Js -->
   
    <script src="{{ asset('public/assets/backend/js/pages/tables/jquery-datatable.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
    function deletePost(id){
    	const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
     
     event.preventDefault();
     document.getElementById('delete-form-'+id).submit();

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
    }	

    </script>
@endpush
