
<div class="row">
    <div class="col-md-6">
        <div class="thumbnails-added clearfix">
            @if(isset($product))
                @foreach($product->images as $image)
                    <div class="thumbnail col-sm-3">
                        <img class="img img-responsive" src="{{ asset('img/sm/'.$image->name) }}"/>
                        <a href="{{ url('products/' . $product->id . '/removeImage/' . $image->id) }}" class="btn btn-xs btn-block btn-danger">&times; Remove</a>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="thumbnails clearfix">
        </div>

        <div>
            {!! Form::label('images[]', 'Images') !!}
            {!! Form::file('images[]', ['class' => 'form-control', 'multiple' => 'multiple', 'accept' => 'image/*', 'id' => 'product-images']) !!}
            <label class="help-block">Images of the product.</label>
            @if($errors->first('images')) <div class="alert alert-danger">{{ $errors->first('images') }}</div> @endif
        </div>
    </div>

    <div class="col-md-6">
        <div>
            {!! Form::checkbox('available', null, ['class' => 'form-control']) !!}
            {!! Form::label('available', 'This product is available') !!}
            <label class="help-block"></label>
            @if($errors->first('available')) <div class="alert alert-danger">{{ $errors->first('available') }}</div> @endif
        </div>

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
            {!! Form::label('length', 'Length') !!}
            {!! Form::text('length', null, ['class' => 'form-control', 'placeholder' => 'Length']) !!}
            <label class="help-block">Length (in inches) of the product</label>
            @if($errors->first('length')) <div class="alert alert-danger">{{ $errors->first('length') }}</div> @endif
        </div>

        <div>
            {!! Form::label('neckline', 'Neckline') !!}
            {!! Form::text('neckline', null, ['class' => 'form-control', 'placeholder' => 'Neckline']) !!}
            <label class="help-block"></label>
            @if($errors->first('neckline')) <div class="alert alert-danger">{{ $errors->first('neckline') }}</div> @endif
        </div>

        <div>
            {!! Form::label('fabric', 'Fabric') !!}
            {!! Form::text('fabric', null, ['class' => 'form-control', 'placeholder' => 'Fabric']) !!}
            <label class="help-block"></label>
            @if($errors->first('fabric')) <div class="alert alert-danger">{{ $errors->first('fabric') }}</div> @endif
        </div>

        <div>
            {!! Form::label('rinse_care', 'Rinse Care') !!}
            {!! Form::text('rinse_care', null, ['class' => 'form-control', 'placeholder' => 'Rinse Care']) !!}
            <label class="help-block"></label>
            @if($errors->first('rinse_care')) <div class="alert alert-danger">{{ $errors->first('rinse_care') }}</div> @endif
        </div>

        <div>
            {!! Form::label('catalogue_list', 'Catalogues') !!}
            {!! Form::select('catalogue_list[]', $catalogues, null, ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'catalogue_list']) !!}
            <label class="help-block small"><a href="{{ url('/catalogues/create') }}" target="_blank">+ Add new catalogues</a></label>
            @if($errors->first('catalogues')) <div class="alert alert-danger">{{ $errors->first('catalogues') }}</div> @endif
        </div>
    </div>
</div>

<div>
    <button class="btn btn-block btn-primary" type="submit">{{ $buttonText }}</button>
</div>

@section('script')
    <script type="text/javascript">
        $(function() {
            var $productImages = $("#product-images");
            var $thumbnails = $(".thumbnails");
            $productImages.change(function() {
                $thumbnails.html('');
                var files = $productImages[0].files;


                for(var i = 0; i < files.length; i++) {
                    var uploadFile = (function(file) {
                        var reader = new FileReader();
                        reader.onloadend = function() {
                            var $img = $('<div class="thumbnail col-sm-3"><img src="' + reader.result + '" class="img img-responsive" /></div>');
                            $thumbnails.append($img);
                        };

                        reader.readAsDataURL(file);
                    })(files[i]);
                    setTimeout(uploadFile, 0);
                }
            });
        });

        function previewFile() {
            var preview = document.querySelector('img');
            var file    = document.querySelector('input[type=file]').files[0];
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                preview.src = "";
            }
        }
    </script>
@endsection