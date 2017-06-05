@extends('admin.master')

@section('css')
	<link rel="stylesheet" href="{{ URL::to('/application/assets/admin/css/sweetalert.css') }}">
@endsection

@section('content')

	<div class="admin-section-title">
		<div class="row">
			<div class="col-md-8">
				<h3><i class="entypo-video"></i> Videos</h3><a href="{{ URL::to('admin/videos/create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
			</div>
			<div class="col-md-4">	
				<form method="get" role="form" class="search-form-full"> <div class="form-group"> <input type="text" class="form-control" value="<?= Input::get('s'); ?>" name="s" id="search-input" placeholder="Search..."> <i class="entypo-search"></i> </div> </form>
			</div>
		</div>
	</div>
	<div class="clear"></div>

	<div class="gallery-env">
		
		<table class="table">
				<thead>
					<tr>
						<td>Video Image</td>
						<td>Title</td>
						<td>Featured</td>
						<td>Slider</td>
						<td>User</td>
						<td>status</td>
						<td>Action</td>
					</tr>
				</thead>
			<tbody>
		@foreach($videos as $video)
				<tr>
					<td><a href="{{ URL::to('video/') . '/' . $video->id }}" target="_blank">
							<img width="50px" src="{{ Config::get('site.uploads_dir') . 'images/' . $video->image }}" /></a>
					</td>
					
					<td><a href="{{ URL::to('admin/videos/edit') . '/' . $video->id }}"><?php if(strlen($video->title) > 25){ echo substr($video->title, 0, 25) . '...'; } else { echo $video->title; } ?></a>
					</td>
					<td><input <?php if($video->featured == 1) echo "checked='checked'"; ?> type="checkbox" name=""></td>
					<td><input <?php if($video->sliders == 1) echo "checked='checked'"; ?> type="checkbox" name=""></td>
					<?php $status = ($video->active) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Pending</span>' ;?>
					<?php $name = ($video->name) ? $video->name : $video->username ;?>
					<td><a href="<?=url()?>/admin/user/edit/<?=$video->user_id?>">{{$name}}</a></td>
					<td><?php echo $status;?></td>
					<td><a href="{{ URL::to('admin/videos/edit') . '/' . $video->id }}">
								<i class="entypo-pencil"></i>
							</a>
							
							<a href="{{ URL::to('admin/videos/delete') . '/' . $video->id }}" class="delete">
								<i class="entypo-trash"></i>
							</a>
							<?php $message = ($video->active == '1') ? '<span class="label label-warning">Mark Pending</span>' : '<span class="label label-success">Mark Active</span>' ;?>
							<a href="{{ URL::to('admin/videos/update_status') . '/' . $video->id }}" class="update">
								<?=$message?>
							</a>
					</td>
				</tr>
			
		@endforeach
		</tbody>
		</table>
		<div class="clear"></div>

		<div class="pagination-outter"><?= $videos->appends(Request::only('s'))->render(); ?></div>
		
		
	</div>


	@section('javascript')
	<script src="{{ URL::to('/application/assets/admin/js/sweetalert.min.js') }}"></script>
	<script>

		$(document).ready(function(){
			var delete_link = '';

			$('.delete').click(function(e){
				e.preventDefault();
				delete_link = $(this).attr('href');
				swal({   title: "Are you sure?",   text: "Do you want to permanantly delete this video?",   type: "warning",   showCancelButton: true,   confirmButtonColor: "#DD6B55",   confirmButtonText: "Yes, delete it!",   closeOnConfirm: false }, function(){    window.location = delete_link });
			    return false;
			});
		});

	</script>

	@stop

@stop

