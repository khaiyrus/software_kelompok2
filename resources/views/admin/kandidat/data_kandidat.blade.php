@extends('layouts.app')

@section('sidebar')
    @include('admin.side-bar')
@endsection

@section('content')
    <div class="row">
        
						<div class="col-12 col-md-6">
							<div class="card">
								<img class="card-img-top" src="img/photos/unsplash-1.jpg" alt="Unsplash">
								<div class="card-header">
									<h5 class="card-title mb-0">Card with image and links</h5>
								</div>
								<div class="card-body">
									<p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
									<a href="#" class="card-link">Card link</a>
									<a href="#" class="card-link">Another link</a>
								</div>
							</div>
						</div>
					</div>
@endsection
