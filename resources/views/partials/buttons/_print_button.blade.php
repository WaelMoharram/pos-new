
<a target="_blank" href="{{isset($route) ? $route : 'javascript:void(0);'}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif class="btn btn-xs btn-default text-success mx-1 shadow" title="Details">
    <i class="fa fa-lg fa-fw fa-print"></i>
</a>
