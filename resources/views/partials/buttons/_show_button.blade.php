<a href="{{isset($route) ? $route : 'javascript:void(0);'}}"
   @if(isset($tooltip) ) {{tooltip($tooltip)}} @endif class="btn btn-secondary">
    <i class="fa fa-eye"></i> @if(isset($buttonText)) {{$buttonText }} @endif
</a>
