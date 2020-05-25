@extends('layouts.frontend.app')

@section('title','Tag')



@push('css')
<link href="/assets/frontend/css/category/styles.css" rel="stylesheet">

<link href="/assets/frontend/css/category/responsive.css" rel="stylesheet">



@endpush

@section('content')

<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>{{$tag->name}}</b></h1>
	</div><!-- slider -->
	<div style="font-size:50px; position:absolute;color:red; margin-left: -15%;"> Посты </div>
	<section class="blog-area section">
		<div class="container">

			<div class="row">

            @if($posts->count()>0)

			@foreach($posts as $post)

				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{Storage::disk('public')->url('post/'.$post->image)}}" alt="{{$post->title}}"></div>

							<div class="blog-info">

								<h4 class="title"><a href="{{route('post.details',$post->slug)}}"><b>{{$post->title}}</b></a></h4>

								<ul class="post-footer">
									<li><a href="#"><i class="ion-chatbubble"></i>{{$post->comments->count()}}</a></li>
									<!--<li><a href="#"><i class="ion-eye"></i>{{ $post->view_count }}</a></li>-->
								</ul>

							</div><!-- blog-info -->
						</div><!-- single-post -->
					</div><!-- card -->
				</div><!-- col-lg-4 col-md-6 -->

				@endforeach

                @else

				<div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
 <div class="blog-info">

 <h4 class="title">
<strong> К сожалению, пока нет постов :(</strong>
   </h4>

                    </div>

                        </div>

                      </div>
                    </div>

                @endif


				<div style="font-size:50px; position:absolute;color:red; margin-left: -15%;"> Плагины </div>
				@if($plugins->count()>0)

@foreach($plugins as $plugin)

	<div class="col-lg-4 col-md-6">
		<div class="card h-100">
			<div class="single-post post-style-1">

				<div class="blog-image"><img src="{{Storage::disk('public')->url('plugins_images/'.$plugin->image)}}" alt="{{$plugin->title}}"></div>

				<div class="blog-info">

					<h4 class="title"><a href="{{route('plugin.details',$plugin->slug)}}"><b>{{$plugin->title}}</b></a></h4>

					<ul class="post-footer">
						<li><a href="#"><i class="ion-chatbubble"></i>{{$plugin->plugin_comments->count()}}</a></li>
						<!--<li><a href="#"><i class="ion-eye"></i>{{ $plugin->view_count }}</a></li>-->
					</ul>

				</div><!-- blog-info -->
			</div><!-- single-post -->
		</div><!-- card -->
	</div><!-- col-lg-4 col-md-6 -->

	@endforeach

	@else

 <div class="col-lg-4 col-md-6">
                    <div class="card h-100">
                        <div class="single-post post-style-1">
 <div class="blog-info">

 <h4 class="title">
<strong> К сожалению, пока нет плагинов :(</strong>
   </h4>

                    </div>

                        </div>

                      </div>
                    </div>
	@endif




			</div><!-- row -->



		</div><!-- container -->
	</section><!-- section -->
@endsection



@push('js')


@endpush 
