@extends('layouts.backend.app')

@section('title','Developer Plugin')

@push('css')
  <link href="/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush

@section('content')

  <div class="container-fluid">
            <div class="block-header">
                 
                 <a class="btn btn-primary waves-effect" href="{{ route('dev.plugin.create') }}">
                 	<i class="material-icons">add</i>
                 	<span> Добавить новый плагин </span> </a>
    
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
                              ВСЕ ПЛАГИНЫ
                              <span class="badge bg-red">{{ $plugins->count() }} </span>
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
                                            <th>Ссылка для скачивания</th>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th><i class="material-icons">file_download</i></th>
                                            <th>На утверждении</th>
                                            <th>Время создания</th>
                                            <th>Время обновления</th>
                                           
                                            <th>Действие</th>
                                             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                             <th>ID</th>
                                            <th>Название</th>
                                            <th>Автор</th>
                                            <th>Ссылка для скачивания</th>
                                            <th><i class="material-icons">visibility</i></th>
                                            <th><i class="material-icons">file_download</i></th>
                                            <th>На утверждении</th>
                                            <th>Время создания</th>
                                            <th>Время обновления</th>
                                             
                                            <th>Действие</th>
                                        </tr>
                                    </tfoot>
                                    
                                    <tbody>
                                    	@foreach($plugins as $key=>$plugin)
                                    	 <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ str_limit($plugin->title,'15')  }}</td>
                                            <td>{{ $plugin->user->name  }}</td>
                                            <td>{{ $plugin->download_link  }}</td>
                                            <td>{{ $plugin->view_count  }}</td>
                                            <td>{{ $plugin->download_count  }}</td>
                                             <td> 
                               @if($plugin->is_approved == true)
                               <span class="badge bg-blue">Approved</span>
                               @else
                               <span class="badge bg-pink">Pending</span>

                               @endif 
                                </td>


                                                <td>{{ $plugin->created_at  }}</td>
                                                
                                                <td>{{ $plugin->updated_at  }}</td>
                                               
                                           
 

                                            <td class="text-center">

             <a href="{{ route('dev.plugin.show',$plugin->id) }}" class="btn btn-info waves-effect">
                <i class="material-icons">visibility</i>
              </a>
                                         
              <a href="{{ route('dev.plugin.edit',$plugin->id) }}" class="btn btn-info waves-effect">
              	<i class="material-icons">edit</i>
              </a>

       <button class="btn btn-danger waves-effect" type="button" onclick="deletePlugin({{ $plugin->id }})">
              	<i class="material-icons">delete</i>
              </button>

              <form id="delete-form-{{ $plugin->id }}" action="{{ route('dev.plugin.destroy',$plugin->id) }}" method="POST" style="display: none;">
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
    <script src="/assets/backend/plugins/jquery-datatable/jquery.dataTables.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js"></script>

    <!-- Custom Js -->
   
    <script src="/assets/backend/js/pages/tables/jquery-datatable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
    function deletePlugin(id){
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
