<a href="{{isset($route) ? $route : 'javascript:void(0);'}}"
   @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif class="btn  btn-outline-success">
    <i class="fa fa-money"></i> @if(isset($buttonText)) {{$buttonText }} @endif
</a>
