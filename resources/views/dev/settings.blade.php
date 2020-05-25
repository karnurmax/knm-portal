@extends('layouts.backend.app')

@section('title', 'Settings')

@push('css')


@endpush


@section('content')
<div class="container-fluid">
<div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                НАСТРОЙКИ
                            </h2>
                            
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">work</i> ОБНОВИТЬ ПРОФИЛЬ
                                    </a>
                                </li>
                                <li role="presentation">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">change_history</i> ПОМЕНЯТЬ ПАРОЛЬ
                                    </a>
                                </li>


                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="home_with_icon_title">

                                @if(session('successMsg'))

<div class="alert alert-success" roles="alert">
{{ session('successMsg') }} 

</div> 
@endif  


 @if(session('loginerrorMsg'))

<div class="alert alert-danger" roles="alert">
{{ session('loginerrorMsg') }} 

</div> 
@endif  




                                <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">

                        </div>
                        <div class="body">
                            <form method = "POST" action = "{{route('dev.profile.update')}}" class="form-horizontal" enctype = "multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Имя пользователя</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="name" class="form-control" 
                                                placeholder="Enter your name" name = "name" value = "{{Auth::user()->name}}"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Email</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email" class="form-control" 
                                                placeholder="Enter your email" name = "email" value = "{{Auth::user()->email}}"> 
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Информация о пользователе</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                          <textarea rows = "5" name = "about" class = "form-control">
                                          {{Auth::user()->about}}
                                          </textarea>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>



                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="name">Изменить позицию</label>
                                    </div>
                                    <div class="col-lg-2 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">


                                           <select class="selectpicker" name = "role_id">
                                            <option value = "3">Программист</option>
                                            <option value = "2">Клиент</option>
                                            </select>


                                          <!--    <select class = "form-control" name = "role_id" >
                                           <option value = "3">Программист</option>
                                           <option value = "2">Клиент</option>
                                           </select> -->

            
                                        </div>
                                    </div>
                                </div>







                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">ОБНОВИТЬ</button>
                                    </div>
                                </div>
                            </f orm>
                        </div>
                    </div>
                </div>
            </div>
                                </div>









                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">



                                <form method="POST" action="{{ route('dev.password.update') }}" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="old_password">Старый пароль</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="name" class="form-control" placeholder="Введите Ваш старый пароль" name="old_password">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                 <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="password">Новый пароль</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="password" class="form-control" placeholder="Введите Ваш новый пароль" name="password">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                   <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="confirm_password">Подтвердить пароль</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="password" id="confirm_password" class="form-control" placeholder="Подтвердите новый пароль" name="password_confirmation">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            

 
                                
                                <div class="row clearfix">
                                    <div class="col-lg-offset-2 col-md-offset-2 col-sm-offset-4 col-xs-offset-5">
                                        <button type="submit" class="btn btn-primary m-t-15 waves-effect">ОБНОВИТЬ</button>
                                    </div>
                                </div>
                            </form>


                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
@endsection

@push('js')

@endpush


