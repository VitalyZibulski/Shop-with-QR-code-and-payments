<div class="col-md-6">
    <!-- Product Name Field -->
    <div class="form-group">
            <h3>
            {!! $qrcode->company_name !!}
<br/>
            @if(isset($qrcode->company_name))
                <small>By {!! $qrcode->company_name !!}</small>
            @endif
        </h3>
    </div>

<!-- Amount Field -->
<div class="form-group">
    {!! Form::label('amount', 'Amount:') !!}
    <h4>${!! $qrcode->amount !!}</h4>
</div>

<!-- Product Url Field -->
<div class="form-group">
    {!! Form::label('product_url', 'Product Url:') !!}
    <p>
        <a href="{!! $qrcode->product_url !!}" target="_blank">
        {!! $qrcode->product_url !!}
        </a>
    </p>
</div>

@if(!Auth::guest() && ($qrcode->user_id == Auth::user()->id || Auth::user()->role_id < 3))

<hr/>
<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', 'User Id:') !!}
    <p>{!! $qrcode->user_id !!}</p>
</div>

<!-- Website Field -->
<div class="form-group">
    {!! Form::label('website', 'Website:') !!}
    <p>{!! $qrcode->website !!}</p>
</div>

<!-- Callback Url Field -->
<div class="form-group">
    {!! Form::label('callback_url', 'Callback Url:') !!}
    <p>{!! $qrcode->callback_url !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>
        @if($qrcode->status == 1)
        Active
        @else
        Inactive
        @endif
    </p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $qrcode->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $qrcode->updated_at !!}</p>
</div>
@endif
</div>

<div class="col-md-5 pull-right">
    <!-- Qrcode Path Field -->
    <div class="form-group">
        {!! Form::label('qrcode_path', 'Scan your Qrcode and Pay with Our App:') !!}
        <p>
        <img src="{{asset($qrcode->qrcode_path)}}" alt="">
        </p>
    </div>
</div>
@if(!Auth::guest() && ($qrcode->user_id == Auth::user()->id || Auth::user()->role_id < 3))
    <div class="col-xs-12">
        <h3 class="text-center">Transactions done on this QRcode</h3>
        @include('transactions.table')
    </div>
@endif