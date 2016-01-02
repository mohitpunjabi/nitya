<table class="hidden">
    @include('orders.partials.form-row', [
        'isSample'  => true,
        'product'   => ['product', []],
        'unitPrice' => ['unit_price', null],
        'quantity'  => ['quantity', null]
    ])
</table>

<div class="row">
    <div class="col-md-12">
        <div class="well">
            <h2 class="media-heading">Billing details <small>(optional)</small></h2>
            <div class="row">

                <div class="col-md-6">
                    <div>
                        {!! Form::text('billing_name', null, ['tabindex' => 1, 'class' => 'form-control', 'placeholder' => 'Billing Name']) !!}
                        <label class="help-block"></label>
                        @if($errors->first('billing_name')) <div class="alert alert-danger">{{ $errors->first('billing_name') }}</div> @endif
                    </div>
                    <div>
                        {!! Form::text('billing_contact', null, ['tabindex' => 2, 'class' => 'form-control', 'placeholder' => 'Contact No.']) !!}
                        <label class="help-block"></label>
                        @if($errors->first('billing_contact')) <div class="alert alert-danger">{{ $errors->first('billing_contact') }}</div> @endif
                    </div>
                    <div>
                        {!! Form::email('billing_email', null, ['tabindex' => 3, 'class' => 'form-control', 'placeholder' => 'Email Address']) !!}
                        <label class="help-block"></label>
                        @if($errors->first('billing_email')) <div class="alert alert-danger">{{ $errors->first('billing_email') }}</div> @endif
                    </div>
                </div>

                <div class="col-md-6">
                    <div>
                        {!! Form::textarea('billing_address', null, ['tabindex' => 4, 'class' => 'form-control', 'rows' => '5', 'placeholder' => 'Billing address with pincode']) !!}
                        <label class="help-block"></label>
                        @if($errors->first('billing_address')) <div class="alert alert-danger">{{ $errors->first('billing_address') }}</div> @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h2 class="media-heading">Order details</h2>
                @if(!$errors->isEmpty())
                    <div class="alert alert-danger">
                        <p><strong>ERROR:</strong> Please fill all the fields correctly.</p>
                    </div>
                @endif
                <table id="itemsTable" class="table table-hover">
                    <thead>
                    <tr>
                        <th width="45%">Item</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th></th>
                    </tr>
                    </thead>

                    <tbody>
                    @if(isset($order))
                        <?php $i = 0; ?>
                        @foreach($order->products as $product)
                            @include('orders.partials.form-row', [
                                'isSample'  => false,
                                'product'   => ['products['.$i.']', [$product->id => '<strong>' . $product->design_no. ':</strong> ' . $product->name]],
                                'unitPrice' => ['unit_prices['.$i.']', $product->pivot->unit_price],
                                'quantity'  => ['quantities['.$i.']', $product->pivot->quantity]
                            ])
                        @endforeach
                    @endif
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="4">
                            <div class="text-center">
                                <button type="button" class="btn btn-sm btn-info" id="addButton"><i class="glyphicon glyphicon-plus"></i> Add an item</button>
                            </div>
                        </td>
                    </tr>

                    <tr valign="bottom">
                        <td colspan="2"></td>
                        <td>
                            <div>
                                {!! Form::label('shipping_charges', 'Shipping Charges') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">&#8377;</span>
                                    {!! Form::text('shipping_charges', null, ['class' => 'form-control', 'size' => '4', 'placeholder' => 'Shipping Charges']) !!}
                                </div>
                                @if($errors->first('shipping_charges')) <div class="alert alert-danger">{{ $errors->first('shipping_charges') }}</div> @endif
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    <tr valign="bottom">
                        <td colspan="2"></td>
                        <td>
                            <div>
                                {!! Form::label('tax', 'Tax') !!}
                                <div class="input-group">
                                    <span class="input-group-addon">&#8377;</span>
                                    {!! Form::text('tax', null, ['class' => 'form-control', 'size' => '4', 'placeholder' => 'Tax']) !!}
                                </div>
                                @if($errors->first('tax')) <div class="alert alert-danger">{{ $errors->first('tax') }}</div> @endif
                            </div>
                        </td>
                        <td></td>
                    </tr>
                    </tfoot>

                </table>
            </div>

        </div>
    </div>
</div>

<div>
    <button class="btn btn-block btn-lg btn-primary" type="submit" id="submitOrder">{{ $buttonText }}</button>
</div>


@section('script')
    <script type="text/javascript">
        $(function() {
            var select2Properties = {
                placeholder: 'Select an item',
                multiple: false,
                mini: true
            };

            var $sampleItem = $("#sampleItem");
            var $tbody = $("#itemsTable > tbody");

            var resetItemNames = function() {
                ['products', 'unit_prices', 'quantities'].forEach(function(elemName) {
                    $tbody.find('.' + elemName).each(function(i) {
                        $(this).attr('name', elemName + '[' + i + ']');
                    });
                });

            };

            var getNewItem = function() {
                var totalItems = $('.item').length;
                var $newItem = $sampleItem.clone().removeAttr('id');

                resetItemNames();

                return $newItem.addClass('item')
                               .show(200);

            };

            var addNewItem = function() {
                var $newItem = getNewItem();
                $tbody.append($newItem);
                $newItem.find('.product-select2')
                        .css('width', '100%')
                        .productSelect2(select2Properties);

                resetItemNames();
            };

            $('body').on('click', '.removeButton', function() {
                $(this).closest('tr').hide(200, function() {
                    $(this).remove();
                });
            });


            $("#addButton").click(addNewItem);

            $("#submitOrder").click(function(e) {
                var errorsExist = false;
                $('#itemsTable [name=products\\[\\]]').each(function() {
                    if($(this).val() == -1) {
                        $(this).closest('tr').addClass('bg-danger');
                        errorsExist = true;
                    }
                    else $(this).closest('tr').removeClass('bg-danger');
                });
                if($('.item').length == 0) {
                    alert("Please add at least 1 item in the order");
                    errorsExist = true;
                }
                if(errorsExist) e.preventDefault();
                else            $sampleItem.remove();
            });

            if($('.item').size() == 0) addNewItem();
            else                       $('.item').find('.product-select2').productSelect2(select2Properties);

            resetItemNames();

            $('form').on('keyup keypress', function(e) {
                var code = e.keyCode || e.which;
                if (code == 13) {
                    e.preventDefault();
                    return false;
                }
            });
        });
    </script>
@endsection