@extends('layouts.backend.app')

@section('title', 'Edit category')

@push('css')


@endpush

@section('content')

<div class="container-fluid">




            <!-- #END# Vertical Layout -->
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ИЗМЕНИТЬ КАТЕГОРИЮ

                            </h2>


                            @if($errors->any())
                            @foreach($errors->all() as $error)
                                    <div class = "alert alert-danger" roles = "alert">
                                {{$error}}
                                </div>
                                @endforeach
                                @endif


                        </div>
                        <div class="body">
                            <form action = "{{route('admin.category.update', $category->id)}}" method = "POST" 
                            enctype = "multipart/form-data">
                            @csrf
                            @method('PUT')
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" id="name" class="form-control" name = "name"  value = "{{$category ->name}}">
                                        <label class="form-label">Название Категория</label>
                                    </div>
                                </div>



                                <div class="form-group">
                                <input type = "file" name = "image">
                                <span> {{$category ->image}}</span>
                                <img class="img-responsive thumbnail" src="{{ Storage::disk('public')->url('category/'.$category->image) }}"  style= "width:350px;height:228px "/>
                                    
                                </div>



                                <a  class = "btn btn-danger m-t-15 waves-effect" href="{{route('admin.category.index')}}">НАЗАД</a>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">ОТПРАВИТЬ</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Vertical Layout | With Floating Label -->
            <!-- Horizontal Layout -->

            <!-- #END# Multi Column -->
        </div>
@endsection

@push('js')


@endpush