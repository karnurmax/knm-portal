@extends('layouts.frontend.app')

@section('title','Posts')



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




			</div><!-- row -->

        {{$posts->links()}}

		</div><!-- container -->
	</section><!-- section -->
@endsection



@push('js')


@endpush 
