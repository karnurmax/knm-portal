@extends('layouts.frontend.app')

@section('title')

{{$plugin->title}}
@endsection

@push('css')
<link href="/assets/frontend/css/single-post/styles.css" rel="stylesheet">

<link href="/assets/frontend/css/single-post/responsive.css" rel="stylesheet">

<style>
	.header-bg{
 height: 100%;
 width: 100%;

 background-image: url({{ Storage::disk('public')->url('plugins_images/'.$plugin->image)  }});
 background-size: cover;
	}
    .favorite_post{
        color: blue;
    }
</style>

@endpush

@section('content')
<div class="header-bg">

	</div><!-- slider -->

	<section class="post-area section">
		<div class="container">

			<div class="row">

				<div class="col-lg-8 col-md-12 no-right-padding">

					<div class="main-post">

						<div class="blog-post-inner">

							<div class="post-info">


								<div class="middle-area">
									<a class="name" href="#"><b>{{$plugin->user->name}}</b></a>
									<h6 class="date"> on {{ $plugin->created_at->diffForHumans() }}</h6>
								</div>

							</div><!-- post-info -->

							<h3 class="title"><a href="#"><b>{{$plugin->title}}</b></a></h3>

							<p class  = "para">{!! html_entity_decode($plugin->body) !!}</p>
							<br>
							<br>
							<br>
							<h5 class="download_link"><a class="btn btn-primary waves-effect" href="{{route('plugin.download_file',$plugin->slug)}}"><b>Скачать плагин</b></a></h5>
							
							
                            <ul class="tags">

								@foreach($plugin->tags as $tag)
								<li><a href="{{route('tag.plugins', $tag->slug)}}">{{ $tag->name }}</a></li>
								 
								 @endforeach
							</ul>

						</div><!-- blog-post-inner -->

						<div class="post-icons-area">
							<ul class="post-icons">
                            
                            <li><a href="#"><i class="ion-chatbubble"></i>{{$plugin->plugin_comments->count()}}</a></li>
							<!--<li><a href="#"><i class="ion-eye"></i>{{ $plugin->view_count }}</a></li>-->
							
                            </ul>


















							<!-- <ul class="icons">
								<li>SHARE : </li>
								<li><a href="#"><i class="ion-social-facebook"></i></a></li>
								<li><a href="#"><i class="ion-social-twitter"></i></a></li>
								<li><a href="#"><i class="ion-social-pinterest"></i></a></li>-->
							</ul>
						</div>

    

					</div><!-- main-post -->
				</div><!-- col-lg-8 col-md-12 -->

				<div class="col-lg-4 col-md-12 no-left-padding">

					<div class="single-post info-area">

						<div class="sidebar-area about-area">
							<h4 class="title"><b>ОБ АВТОРЕ</b></h4>
							<p>{{$plugin->user->about}}</p>
						</div>



						</div><!-- subscribe-area -->

						<div class="tag-area">

							<h4 class="title"><b>КАТЕГОРИИ</b></h4>
							<ul>
                            @foreach($plugin->categories as $category)
								<li><a href="{{route('category.plugins',$category->slug)}}">{{ $category->name }}</a></li>
								 @endforeach

							</ul>

						</div><!-- subscribe-area -->

					</div><!-- info-area -->

				</div><!-- col-lg-4 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section><!-- post-area -->


	<section class="recomended-area section">
		<div class="container">
			<div class="row">

            @foreach($randomplugins as $randomplugin)

				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{Storage::disk('public')->url('plugins_images/'.$randomplugin->image)}}" alt="{{$randomplugin->title}}">
                            </div>

							<div class="blog-info">

								<h4 class="title"><a href="{{route('plugin.details',$randomplugin->slug)}}"><b>{{$randomplugin->title}}</b></a></h4>

								<ul class="post-footer">
									<li><a href="#"><i class="ion-chatbubble"></i>{{$randomplugin->plugin_comments->count()}}</a></li>
									<!-- <li><a href="#"><i class="ion-eye"></i>{{ $randomplugin->view_count }}</a></li>-->
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-md-6 col-sm-12 -->

            @endforeach 



			</div><!-- row -->

		</div><!-- container -->
	</section>

	<section class="comment-section">
		<div class="container">
			<h4><b>КОММЕНТАРИЙ ПОСТА</b></h4>

			@if(session('successMsg'))
        <div class = "alert alert-success" roles = "alert">
        {{session('successMsg')}}

        </div>
        @endif


			<div class="row">

				<div class="col-lg-8 col-md-12">
					<div class="comment-form">

                    @guest
                       <p> Для того,чтобы оставить комментарий, нужно войти как пользователь <a href="{{ route('login')}}">ВОЙТИ </a> </p>
                    @else
                     
                          <form method="POST" action=" {{ route('plugin_comment.store',$plugin->id) }}">
                          	@csrf

							<div class="row"> 

								<div class="col-sm-12">
									<textarea name="plugin_comment" rows="2" class="text-area-messge form-control"
										placeholder="Enter your comment" aria-required="true" aria-invalid="false"></textarea >
								</div><!-- col-sm-12 -->
								<div class="col-sm-12">
									<button class="submit-btn" type="submit" id="form-submit"><b>НАПИСАТЬ КОММЕНТАРИЙ</b></button>
								</div><!-- col-sm-12 -->

							</div><!-- row -->
						</form>


                    @endguest


					</div><!-- comment-form -->

					<h4><b>КОММЕНТАРИИ({{ $plugin->plugin_comments->count() }})</b></h4>

					 @if($plugin->plugin_comments->count() > 0 )
            
             @foreach($plugin->plugin_comments as $plugin_comment)
					<div class="commnets-area ">

						<div class="plugin_comment">

							<div class="post-info">



								<div class="middle-area">
									<a class="name" href="#"><b>{{ $plugin_comment->user->name }}</b></a>
									<h6 class="date">on {{ $plugin_comment->created_at->diffForHumans() }} </h6>
								</div>

								 

							</div><!-- post-info -->

							<p>{{ $plugin_comment->plugin_comment }} </p>

						</div>

					</div><!-- commnets-area -->

					@endforeach

					<!--<a class="more-comment-btn" href="#"><b>VIEW MORE COMMENTS</a>-->

					 @else

					 <div class="commnets-area ">
				<p> Пока нет комментов, Вы можете оставить один из первых комментов </p>
			</div>

				@endif


				</div><!-- col-lg-8 col-md-12 -->

			</div><!-- row -->

		</div><!-- container -->
	</section>

@endsection



@push('js')


@endpush 
