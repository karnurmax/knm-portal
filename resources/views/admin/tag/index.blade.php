@extends('layouts.backend.app')

@section('title', 'Tag')

@push('css')

<link href="/assets/backend/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
@endpush


@section('content')

<div class="container-fluid">
            <div class="block-header">
                <a class = "btn btn-primary waves-effect" href = "{{route('admin.tag.create')}}">
                <i class = "material-icons">add</i>
                <span>Добавить новый ТЭГ</span></a>
                
        @if(session('successMsg'))
        <div class = "alert alert-success" roles = "alert">
        {{session('successMsg')}}

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
                                ВСЕ ТЭГИ
                                <span class = "badge bg-red">{{$tags->count()}}</span>
                            </h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                            <th>Количество постов</th>
                                            <th>Время создания</th>
                                            <th>Время последнего обновления</th>
                                            <th>Действие</th>

                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                            <th>Количество постов</th>
                                            <th>Время создания</th>
                                            <th>Время последнего обновления</th>
                                            <th>Действие</th>
                                        </tr>
                                    </tfoot>
                                   <tbody>
                                   @foreach($tags as $key=>$tag)
                                    <tr>
                                            <td>{{$key +1}}</td>
                                            <td>{{$tag->name}}</td>
                    <td><span class = "badge bg-info">{{$tag->posts->count()}}</span></td>
                                            <td>{{$tag->created_at}}</td>
                                            <td>{{$tag->updated_at}}</td>
                                            <td class = "text-center">
                                            
                        <a href = "{{route('admin.tag.edit',$tag->id)}}" class = "btn btn-info wave-effects">
                        <i class = "material-icons">edit</i></a>


                        <button class = "btn btn-danger wave-effects" type = "button" onClick = "deleteTag({{$tag->id}})">  
                        <i class = "material-icons">delete</i>
                        </button>

                        <form id = "delete-form-{{$tag->id}}"action = "{{route('admin.tag.destroy',$tag->id)}}" method = "POST"
                        style = "display:none;">
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
    <script src="/assets/backend/js/admin.js"></script>
    <script src="/assets/backend/js/pages/tables/jquery-datatable.js"></script>
    
    
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

    <script type  = "text/javascript">
    function deleteTag(id){

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
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
      event.preventDefault(); // to not update page
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


