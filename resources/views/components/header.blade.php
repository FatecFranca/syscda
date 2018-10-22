<div class="sticky-header mb-3">
    <header class="row">
        <div class="col-md-6">
            <h4 class="text-dark"><strong>{{ isset($page_title) ? $page_title : 'CDA' }}</strong></h4>
        </div>
        <div class="col-md-6 text-right">
            @if(isset($urlAction) && $urlAction)
                <a href="{{ $urlAction }}" class="btn btn-success">{{ $action['name'] }}</a>
            @else
                <button class="btn btn-success">{{ $action['name'] }}</button>
            @endif
        </div>
    </header>
</div>
