<div class="row">
    <div class="col-md-6">
        <div>
            {!! Form::label('images', 'Images') !!}
            {!! Form::text('images', null, ['class' => 'form-control', 'placeholder' => 'Images']) !!}
            <label class="help-block">Images of the product. TBD.</label>
            @if($errors->first('images')) <div class="alert alert-danger">{{ $errors->first('images') }}</div> @endif
        </div>
    </div>

    <div class="col-md-6">
        <div>
            {!! Form::label('design_no', 'Design No.') !!}
            {!! Form::text('design_no', null, ['class' => 'form-control', 'placeholder' => 'Design No.']) !!}
            <label class="help-block">Design number of the product</label>
            @if($errors->first('design_no')) <div class="alert alert-danger">{{ $errors->first('design_no') }}</div> @endif
        </div>

        <div>
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Name']) !!}
            <label class="help-block">Name of the product</label>
            @if($errors->first('name')) <div class="alert alert-danger">{{ $errors->first('name') }}</div> @endif
        </div>

        <div>
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'About the product description', 'rows' => 2]) !!}
            <label class="help-block small">A short description for the product. Will be used as meta for search engines.</label>
            @if($errors->first('short_description')) <div class="alert alert-danger">{{ $errors->first('short_description') }}</div> @endif
        </div>

        <div>
            {!! Form::checkbox('available', null, ['class' => 'form-control']) !!}
            {!! Form::label('available', 'This product is available') !!}
            <label class="help-block"></label>
            @if($errors->first('available')) <div class="alert alert-danger">{{ $errors->first('available') }}</div> @endif
        </div>
    </div>
</div>

<div>
    <button class="btn btn-block btn-primary" type="submit">{{ $buttonText }}</button>
</div>