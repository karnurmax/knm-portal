@extends('layouts.backend.app')

@section('title', 'Author Dashboard')

@push('css')


@endpush


@section('content')
<div class="container-fluid">
            <div class="block-header">
                <h2>ЛИЧНЫЙ КАБИНЕТ</h2>
            </div>

            <!-- Widgets -->
            <div class="row clearfix">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">ВСЕ ПОСТЫ</div>
                            <div class="number count-to" data-from="0" data-to="{{$posts->count()}}" data-speed="15" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">library_books</i>
                        </div>
                        <div class="content">
                            <div class="text">ПОСТЫ НА УТВЕРЖДЕНИИ</div>
                            <div class="number count-to" data-from="0" data-to="{{ $total_pending_posts}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
             <!--   <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">TOTAL VIEWS</div>
                            <div class="number count-to" data-from="0" data-to="{{$all_views}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>-->

            <!-- #END# Widgets -->

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h2>ПОПУЛЯРНЫЕ ПОСТЫ</h2>
                          
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                        <tr>
                                            <th>НАЗВАНИЕ</th>
                                            <!--<th>Views</th>-->
                                            <th>КОММЕНТЫ</th>
                                            <th>СТАТУС</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($popular_posts as $post)
                                        <tr>
                            <td>{{str_limit($post->title, 40)}}</td>
                           <!-- <td>{{$post->view_count}}</td>-->
                            <td>{{$post->comments_count}}</td>
                            <td>
                            @if($post->status == true)
                            <span class = "label bg-green">Published</span>

                            @else

                            <span class = "label bg-red">Pending</span>





                            @endif
                            </td>
                                           
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- #END# Task Info -->

            </div>
        </div>
@endsection

@push('js')
<script src="/assets/backend/js/pages/index.js"></script>
<!-- Jquery CountTo Plugin Js -->
<script src="/assets/backend/plugins/jquery-countto/jquery.countTo.js"></script>



<!-- Sparkline Chart Plugin Js -->
<script src="/assets/backend/plugins/jquery-sparkline/jquery.sparkline.js"></script>


@endpush


