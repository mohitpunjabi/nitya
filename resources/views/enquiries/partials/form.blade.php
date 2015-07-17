{!! Form::open(['route' => 'enquiries.store', 'id' => ((isset($id))? $id: 'standardContactForm') ]) !!}

@if(isset($product))
    {!! Form::hidden('product_id', $product->id, []) !!}
@endif

<div>
    {!! Form::text('name', Session::get('user_info.name', null), ['class' => 'form-control input-lg', 'placeholder' => 'Name', 'required' => 'required']) !!}
    <label class="help-block"></label>
    @if($errors->first('name')) <div class="alert alert-danger">{{ $errors->first('name') }}</div> @endif
</div>
<div>
    {!! Form::email('email', Session::get('user_info.email', null), ['class' => 'form-control input-lg', 'placeholder' => 'Email Address', 'required' => 'required']) !!}
    <label class="help-block"></label>
    @if($errors->first('email')) <div class="alert alert-danger">{{ $errors->first('email') }}</div> @endif
</div>
<div>
    {!! Form::text('contact', Session::get('user_info.contact', null), ['class' => 'form-control input-lg', 'placeholder' => 'Contact Number', 'required' => 'required']) !!}
    <label class="help-block"></label>
    @if($errors->first('contact')) <div class="alert alert-danger">{{ $errors->first('contact') }}</div> @endif
</div>
<div>
    {!! Form::textarea('message', Session::get('user_info.message', null), ['class' => 'form-control input-lg', 'placeholder' => 'Your message', 'rows' => 4, 'required' => 'required']) !!}
    <label class="help-block"></label>
    @if($errors->first('message')) <div class="alert alert-danger">{{ $errors->first('message') }}</div> @endif
</div>

<div class="row">
    <div class="col-xs-12">
        @if(isset($cancelButton) && $cancelButton)
            <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-envelope"></i> Submit</button>
            <a href="#" class="btn" id="cancelEnquiryBtn"><i class="glyphicon glyphicon-remove"></i> Cancel</a>
        @else
            <p>
                <button class="btn btn-lg btn-block btn-primary" type="submit"><i class="glyphicon glyphicon-envelope"></i> Submit</button>
            </p>
        @endif
    </div>
</div>
{!! Form::close() !!}