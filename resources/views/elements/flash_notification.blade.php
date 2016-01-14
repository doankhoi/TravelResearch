@if ($errors->has())
    <div class="alert alert-dismissible alert-danger">
    	<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            <?php 
                $arr_errors = array_unique($errors->all()); 
            ?>
            @foreach ($arr_errors as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>
@elseif (Session::has('message'))
	<div class="alert alert-dismissible {{ Session::get('alertClass', 'alert-danger') }}" role="alert">{{ Session::get('message') }}
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
@endif
