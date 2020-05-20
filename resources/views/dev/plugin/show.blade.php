@extends('layouts.backend.app')

@section('title','Show Plugin')

@push('css')
 
@endpush



@section('content')
 <div class="container-fluid">
            
   <a href="{{ route('dev.plugin.index') }}" class="btn btn-danger wave-effect" >НАЗАД</a>

 @if($plugin->is_approved == false)
 <button type="button" class="btn btn-success pull-right">
<i class="material-icons">done</i>
<span>На утверждении</span>
  </button>

@else

 <button type="button" class="btn btn-success pull-right" disabled>
<i class="material-icons">done</i>
<span>Утвержден</span>
  </button>
 
 @endif

 <br>
 <br>


            <!-- #END# Vertical Layout -->
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                              {{ $plugin->title }}
                              <small>Опубликован автором  <strong><a href="">{{ $plugin->user->name }}</a> </strong> в {{ $plugin->created_at->toFormattedDateString() }}   </small>
                              
                            </h2>
   
                   
                        </div>
                        <div class="body">
                           
                               {!! $plugin->body !!}
                               
        
                          
                        </div>
                    </div>
                </div>






<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-cyan">
                            <h2>
                            КАТЕГОРИИ    
                              
                            </h2>
                   
                        </div>
                        <div class="body">
                         
                         @foreach($plugin->categories as $category)
                      <span class="label bg-cyan">{{ $category->name }}</span>
                         @endforeach  
                                
                          
                        </div>
                    </div>


                    <div class="card">
                        <div class="header bg-green">
                            <h2>
                            ТЭГИ   
                              
                            </h2>
                   
                        </div>
                        <div class="body">
                         
                         @foreach($plugin->tags as $tag)
                      <span class="label bg-green">{{ $tag->name }}</span>
                         @endforeach  
                                
                          
                        </div>
                    </div>




                    <div class="card">
                        <div class="header bg-amber">
                            <h2>
                           ЗАГРУЖЕННАЯ КАРТИНКА 
                              
                            </h2>
                   
                        </div>
                        <div class="body">
                         
                       <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('plugins_images/'.$plugin->image) }}">
                                
                          
                        </div>
                    </div>

                
                    <div class="card">
                        <div class="header bg-amber">
                            <h2>
                           ЗАГРУЖЕННЫЙ ПЛАГИН
                              
                            </h2>
                   
                        </div>
                        <div class="body">
                         
                        <span> {{ $plugin->plugin_file}}  </span>
                                
                          
                        </div>
                    </div>








                </div> 
            </div> 
          
        </div>

@endsection



@push('js')
 <!-- Select Plugin Js -->
    <script src="{{ asset('public/assets/backend/plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
    <!-- TinyMCE -->
    <script src="{{ asset('public/assets/backend/plugins/tinymce/tinymce.js') }}"></script>
   

 <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
 
 

   <script type="text/javascript">
   $(function () {
   
    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '{{ asset('public/assets/backend/plugins/tinymce') }}';
});



 function approvePlugin(id){
      const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You want to approve this plugin",
  type: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Approve it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.value) {
     
     event.preventDefault();
     document.getElementById('approval-form').submit();

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'The plugin remain Pending :)',
      'info'
    )
  }
})
    } 








 </script>


@endpush