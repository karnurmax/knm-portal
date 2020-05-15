@extends('layouts.backend.app')

@section('title','Create Plugin')

@push('css')
<!-- Bootstrap Select Css -->
    <link href="/assets/backend/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
@endpush



@section('content')
 <div class="container-fluid">
            
  <form action="{{ route('admin.plugin.store') }}" method="POST" enctype="multipart/form-data">
                              @csrf
            <!-- #END# Vertical Layout -->
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ДОБАВИТЬ НОВЫЙ ПЛАГИН
                              
                            </h2>
          
 @if($errors->any())
    @foreach($errors->all() as $error)

   <div class="alert alert-danger" roles="alert">
     {{ $error }} 

     </div> 

    @endforeach

    @endif
                   
                        </div>
                        <div class="body">
                           
                                <div class="form-group form-float">
                                    <div class="form-line">
            <input type="text" id="title" class="form-control" name="title">
           <label class="form-label">Название Плагина </label>
                                    </div>
                                </div>

                     <div class="form-group">
                      <label for="image">Загрузить картинку</label>
                      <input type="file" name="image">   

                     </div>      

                     <div class="form-group">
                      <label for="file">Загрузить плагин</label>
                      <input type="file" name="plugin_file">   

                     </div>       

                            
        
                          
                        </div>
                    </div>
                </div>






<div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               КАТЕГОРИИ И ТЭГИ
                              
                            </h2>
                   
                        </div>
                        <div class="body">
                           
                                <div class="form-group form-float">
                                    <div class="form-line {{ $errors->has('categories') ? 'focused error' : '' }} ">
             
           <label for="category">Выбрать Категории </label>
           <select name="categories[]" id="category" class="form-control show-tick" data-live-search="true" multiple > 

            @foreach($categories as $category)
            <option value="{{ $category->id }}"> {{ $category->name }} </option>

            @endforeach

           </select> 
                                    </div>
                                </div>



                                <div class="form-group form-float">
                                   <div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }} ">
             
           <label for="tag">Выбрать Тэги </label>
           <select name="tags[]" id="tags" class="form-control show-tick" data-live-search="true" multiple > 

            @foreach($tags as $tag)
            <option value="{{ $tag->id }}"> {{ $tag->name }} </option>

            @endforeach

           </select>
                                    </div>
                                </div>

                            

                              

        <a class="btn btn-danger m-t-15 waves-effect" href="{{ route('admin.category.index') }} "> НАЗАД</a>                        
       <button type="submit" class="btn btn-primary m-t-15 waves-effect">ОТПРАВИТЬ</button>
                          
                        </div>
                    </div>
                </div>
 

            </div>





 <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                               ТЕКСТ ПЛАГИНА
                              
                            </h2>
                   
                        </div>
                        <div class="body">
                            
                        <textarea id="tinymce" name="body">  </textarea>        
                            
                        </div>
                    </div>
                </div>
            </div>
 
         </form>
            <!-- Vertical Layout | With Floating Label -->
            <!-- Horizontal Layout -->
         
            <!-- #END# Multi Column -->
        </div>

@endsection 



@push('js')
 <!-- Select Plugin Js -->
    <script src="/assets/backend/plugins/bootstrap-select/js/bootstrap-select.js"></script>
    <!-- TinyMCE -->
    <script src="/assets/backend/plugins/tinymce/tinymce.js"></script>
   
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
    tinyMCE.baseURL = "/assets/backend/plugins/tinymce";
});


 </script>


@endpush