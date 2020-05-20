@extends('layouts.frontend.app')

@section('title','Plugins')



@push('css')
<link href="/assets/frontend/css/category/styles.css" rel="stylesheet">

<link href="/assets/frontend/css/category/responsive.css" rel="stylesheet">



@endpush

@section('content')

<div class="slider display-table center-text">
		<h1 class="title display-table-cell"><b>ВСЕ ПОСТЫ</b></h1>
	</div><!-- slider -->

	<section class="blog-area section">
		<div class="container">

			<div class="row">

			@foreach($plugins as $plugin)

				<div class="col-lg-4 col-md-6">
					<div class="card h-100">
						<div class="single-post post-style-1">

							<div class="blog-image"><img src="{{Storage::disk('public')->url('plugin_images/'.$plugin->image)}}" alt="{{$plugin->title}}"></div>

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




			</div><!-- row -->

        {{$plugins->links()}}

		</div><!-- container -->
	</section><!-- section -->
@endsection



@push('js')


@endpush 
