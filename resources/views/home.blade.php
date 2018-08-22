@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <!-- The fileinput-button span is used to style the file input field as button -->
				        <span class="btn btn-success fileinput-button">
                            <i class="glyphicon glyphicon-plus"></i>
                            <span>Selecionar arquivos...</span>
                            <!-- The file input field used as target for the file upload widget -->
                            <input id="fileupload" type="file" name="documento"
                            data-token="{!! csrf_token() !!}"
                            data-user-id="{!! $user->id !!}">
                        </span>
                        <br>
                        <br>
                        <!-- The global progress bar -->
                        <div id="progress" class="progress">
                            <div class="progress-bar progress-bar-success"></div>
                        </div>

                        @if(Session::has('success'))
						<div class="alert alert-success">
							{!! Session::get('success') !!}
						</div>
				    @endif

				    <div class="alert alert-success hide" id="upload-success">
						Upload realizado com sucesso!
					</div>

				    <table class="table table-bordered table-striped table-hover">
				    	<thead>
				    		<tr>
				    			<th>Nome</th>
				    			<th>Enviado em</th>
				    			<th>Usuário</th>
				    			<th>Ações</th>
				    		</tr>
				    	</thead>
				    	<tbody>
				    		@foreach($user->files as $file)
				    		<tr>
				    			<td>{!! $file->name !!}</td>
				    			<td>{!! $file->created_at !!}</td>
				    			<td>{!! $user->name !!}</td>
				    			<td>
				    				<a href="{!! route('files.download', [$user->id, $file->id]) !!}" class="btn btn-xs btn-success">download</a>
                                    <a href="{!! route('files.destroy', [$user->id, $file->id]) !!}" class="btn btn-xs btn-danger">excluir</a>
				    			</td>
				    		</tr>
				    		@endforeach
				    	</tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
@parent
<script>
	;(function($)
	{
	  'use strict';
	  $(document).ready(function()
	  {
	  	var $fileupload     = $('#fileupload'),
	  		$upload_success = $('#upload-success');
	    $fileupload.fileupload({
	        url: '/upload',
	        formData: {_token: $fileupload.data('token'), userId: $fileupload.data('userId')},
	        progressall: function (e, data) {
	            // var progress = parseInt(data.loaded / data.total * 100, 10);
	            // $('#progress .progress-bar').css(
	            //     'width',
	            //     progress + '%'
	            // );
	        },
	        done: function (e, data) {
	        	// $upload_success.removeClass('hide').hide().slideDown('fast');
			    // setTimeout(function(){
			    	location.reload();
			    // }, 2000);
			}
	    });
	  });
	})(window.jQuery);
</script>
@stop
