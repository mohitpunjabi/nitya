<tr @if($isSample) id="sampleItem" @else class="item" @endif>
    <td width="50%">
        <div>
            {!! Form::select($product[0], $product[1], null, ['class' => 'products product-select2 form-control', 'required' => 'required']) !!}
        </div>
    </td>

    <td>
        <div class="input-group">
            <span class="input-group-addon">&#8377;</span>
            {!! Form::text($unitPrice[0], $unitPrice[1], ['class' => 'unit_prices form-control', 'size' => '4', 'required' => 'required', 'placeholder' => 'Price']) !!}
        </div>
    </td>

    <td>
        <div>
            {!! Form::text($quantity[0], $quantity[1], ['class' => 'quantities form-control', 'size' => '4', 'required' => 'required', 'placeholder' => 'Quantity']) !!}
        </div>
    </td>

    <td>
        <button type="button" class="removeButton btn btn-sm btn-danger"><i class="glyphicon glyphicon-remove"></i></button>
    </td>
</tr>