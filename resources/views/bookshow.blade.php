<?php use App\Models\Book; use App\Models\SubCategory; use App\Models\MainCategory;?>



@extends('layouts.master')
@section('css')
<!-- Internal Morris Css-->
<link href="{{URL::asset('assets/plugins/morris.js/morris.css')}}" rel="stylesheet">
@endsection
<!-- @section('page-header')
				breadcrumb
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Charts</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Morris-charts</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-info btn-icon ml-2"><i class="mdi mdi-filter-variant"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-danger btn-icon ml-2"><i class="mdi mdi-star"></i></button>
						</div>
						<div class="pr-1 mb-3 mb-xl-0">
							<button type="button" class="btn btn-warning  btn-icon ml-2"><i class="mdi mdi-refresh"></i></button>
						</div>
						<div class="mb-3 mb-xl-0">
							<div class="btn-group dropdown">
								<button type="button" class="btn btn-primary">14 Aug 2019</button>
								<button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split" id="dropdownMenuDate" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuDate" data-x-placement="bottom-end">
									<a class="dropdown-item" href="#">2015</a>
									<a class="dropdown-item" href="#">2016</a>
									<a class="dropdown-item" href="#">2017</a>
									<a class="dropdown-item" href="#">2018</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				breadcrumb
@endsection -->

@section('content')


@foreach($books as $index => $book)
				<div class="row row-sm">
					<div class="col-md-6">
						<div class="card mg-b-20">
							<div class="card-body">
								<p class="mg-b-20">Book Number: {{ $loop->index }}</p>
								<div class="main-content-label mg-b-5">
									Title: {{ $book->booktitle }}
								</div>
								
								<p class="mg-b-20">Author: {{ $book->bookauthor }}</p>
								<p class="mg-b-20">Sub category name:{{ SubCategory::find($book->sub_category_id)->sub_category_name }}</p>
								<p class="mg-b-20">Main category name:{{ MainCategory::find( SubCategory::find($book->sub_category_id)->main_category_id )->main_category_name}}</p>
								<div class="morris-wrapper-demo" id="morrisLine1">
		
					@php
					if (Auth::check()) 
						{
							$user = Auth::user();
							$exists = $user->user_favorite_books()->where('book_id', $book->id)->exists();
						}
					@endphp

					@if(isset($exists))
						@if(!$exists)
							<form action="{{ route('favorite', ['book_id' => $book->id]) }}" method="post">
								@csrf
									
								<button type="submit" class="btn btn-danger">Add favorite book</button>
							</form>
						@endif
						@if($exists)
							<form action="{{ route('favorite', ['book_id' => $book->id]) }}" method="post">
								@csrf
									
								<button type="submit" class="btn btn-danger">delete from favorite</button>
							</form>
						@endif
					@endif
					@if(!isset($exists))
						<form action="{{ route('favorite', ['book_id' => $book->id]) }}" method="post">
								@csrf
									
								<button type="submit" class="btn btn-danger">Add favorite book</button>
						</form>
					@endif
						<br>
			<hr>
			<hr>
			<hr>

						<form action="{{ route('store.rate', ['book_id' => $book->id]) }}" method="post">
							<div >
								@csrf
								<input style="width: fit-content;display: inline;" type="number" id="form1Example1" class="form-control" name="rate" min="0" max="5" step="1" />
								<label class="form-label" for="form1Example1" style="width: fit-content; display: inline;">add rate from one to five</label>
								<button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block"style=" display: inline;width: fit-content;">Add New rating</button>
							</div>
					
						</form>

				@can('create-sub-category')    
						<hr>
						<hr>
						<hr>
						<form action="{{ route('delete.book', ['id' => $book->id]) }}" method="post">
							@csrf
							@method('delete')
							<button type="submit" class="btn btn-danger">Delete This Book</button>
						</form>
				@endcan
				
								</div>
							</div>
						</div>
						
					</div>
					</div>
					@endforeach
					

					<!-- col-6 -->
					<!-- <div class="col-md-6">
						<div class="card mg-b-20">

							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Line Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-wrapper-demo" id="morrisLine2"></div>
							</div>
						</div>
					</div>
					col-6
				</div> -->
				<!-- /row -->

				<!-- row -->
				<!-- <div class="row row-sm">
					<div class="col-md-6">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Area Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-wrapper-demo" id="morrisArea1"></div>
							</div>
						</div>
					</div>col-6 -->
					<!-- <div class="col-md-6">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Area Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-wrapper-demo" id="morrisArea2"></div>
							</div>
						</div>
					</div>col-6
				</div> -->

				<!-- row -->
				<!-- <div class="row row-sm">
					<div class="col-md-6">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Stacked Bar Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-wrapper-demo" id="morrisBar3"></div>
							</div>
						</div>
					</div>col-6
					<div class="col-md-6">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Stacked Bar Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-wrapper-demo" id="morrisBar4"></div>
							</div>
						</div>
					</div>col-6 -->
				<!-- </div> -->
				<!-- /row -->


				<!-- /row -->

					<!-- row -->
				<!-- <div class="row row-sm">
					<div class="col-md-6">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Bar Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-wrapper-demo" id="morrisBar1"></div>
							</div>
						</div>
					</div>col-6
					<div class="col-md-6">
						<div class="card mg-b-20">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Bar Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-wrapper-demo" id="morrisBar2"></div>
							</div>
						</div>
					</div>col-6
				</div> -->
				<!-- /row -->

				<!-- row -->
				<!-- <div class="row row-sm">
					<div class="col-md-6">
						<div class="card mg-b-md-20">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Donut Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-donut-wrapper-demo" id="morrisDonut1"></div>
							</div>
						</div>
					</div> -->
					<!-- col-6
					<div class="col-md-6">
						<div class="card">
							<div class="card-body">
								<div class="main-content-label mg-b-5">
									Donut Chart
								</div>
								<p class="mg-b-20">Basic Charts Of Valex template.</p>
								<div class="morris-donut-wrapper-demo" id="morrisDonut2"></div>
							</div>
						</div>
					</div>col-6
				</div> -->
				<!-- row closed -->
			<!-- </div> -->
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Morris js -->
<script src="{{URL::asset('assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/morris.js/morris.min.js')}}"></script>
<!--Internal Chart Morris js -->
<script src="{{URL::asset('assets/js/chart.morris.js')}}"></script>
@endsection