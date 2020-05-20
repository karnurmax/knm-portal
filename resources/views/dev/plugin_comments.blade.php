@extends('layouts.backend.app')

@section('title','All plugin comments')

@push('css')
  <link href="/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush

@section('content')

<div class="container-fluid">
             @if(session('successMsg'))

     <div class="alert alert-success" roles="alert">
     {{ session('successMsg') }} 

     </div> 
     @endif 


            
            <!-- #END# Basic Examples -->
            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                             ВСЕ КОММЕНТАРИИ НА ПЛАГИНЫ
                             
                            </h2>
                           
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>КОММЕНТ ИНФО</th>
                                            <th>ПОСТ ИНФО</th>
                                            <th>ДЕЙСТВИЕ</th>
                                             
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>КОММЕНТ ИНФО</th>
                                            <th>ПОСТ ИНФО</th>
                                            <th>ДЕЙСТВИЕ</th>
                                        </tr>
                                    </tfoot>
                                    
                                    <tbody>


                                    @foreach($plugins as $key=>$plugin) 
                                @foreach($plugin-> plugin_comments as $key=>$plugin_comment)  
                                    	 <tr>




                                                        <td>
               <div class="media">

   <div class="media-body">
    <h4 class="media-heading">{{ $plugin_comment->user->name }}
   <small>{{ $plugin_comment->created_at->diffForHumans() }} </small> </h4>
   <p> {{ $plugin_comment->plugin_comment }} </p>
   <a target="/blank" href="{{ route('plugin.details',$plugin_comment->plugin->slug. '#plugin_comments') }}">Replay</a>
     
   </div>     
    </div> 
     </td> 




     <td> 
        <div class="media">
                 <div class="media-right">
 <a target="/blank" href="{{ route('plugin.details',$plugin_comment->plugin->slug ) }}">
  <img class="media-object" src="{{ Storage::disk('public')->url('plugin_images/'.$plugin_comment->plugin->image) }}" height="64" width="64">
  </a>

</div>

<div class="media-body">
 <a target="/blank" href="{{ route('plugin.details',$plugin_comment->plugin->slug ) }}">
   <h4 class="media-heading">{{ str_limit($plugin_comment->plugin->title), '40' }}  </h4> </a>
 
 <p>By <strong>{{ $plugin_comment->plugin->user->name }}</strong>  </p>
  </div>
  </div>

        </td> 







        <td> 
 <button class="btn btn-danger waves-effect" type="button" onclick="deletePluginComment({{ $plugin_comment->id }})">
                <i class="material-icons">delete</i>
              </button>

              <form id="delete-form-{{ $plugin_comment->id }}" action="{{ route('dev.plugin_comment.destroy',$plugin_comment->id) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
                              
              </form>


                       </td>   




                                            
                                        </tr>
                                 @endforeach
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
    <script src="/assets/backend/plugins/jquery-datatable/jquery.dataTables.js "></script>
    <script src="/assets/backend/plugins/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/dataTables.buttons.min.js "></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/buttons.flash.min.js "></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/jszip.min.js "></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/pdfmake.min.js"></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/vfs_fonts.js "></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/buttons.html5.min.js "></script>
    <script src="/assets/backend/plugins/jquery-datatable/extensions/export/buttons.print.min.js "></script>

    <!-- Custom Js -->
   
    <script src="/assets/backend/js/pages/tables/jquery-datatable.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
    <script type="text/javascript">
    function deletePluginComment(id){
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
