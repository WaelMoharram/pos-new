
<a href="{{isset($route) ? $route : 'javascript:void(0);'}}" @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif class="btn btn-xs btn-{{$color}} text-teal mx-1 shadow" title="Details">
    <i class="fa fa-lg fa-fw {{$fa}}"></i>
</a>
