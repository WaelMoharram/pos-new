<tr>
    <td>{!! $activity->created_at !!}</td>
    <td>{!! optional($activity->causer)->name !!}</td>
    <td>{!! __($activity->description) !!}</td>
    <td>{!! __($activity->subject_type) !!}</td>
    <td>{!! optional($activity->subject)->name ?? optional($activity->subject)->title !!}</td>
    <td>
        @if($activity->properties->toArray())
        <button data-toggle="modal" data-target="#show-details{{$activity->id}}" class="btn btn-md btn-info" >

            <i class="fa fa-eye"></i>
        </button>
        <div class="modal fade text-center " id="show-details{{$activity->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
                <div class="modal-content">

                    <div class="modal-body">
                        <table>
                            <tbody>
                            <tr>
                                <td>
                                    @if(count($activity->properties->toArray()) >0)
                                        <table>
                                            <tbody>
                                            @if(isset($activity->properties->toArray()['old']))
                                                @foreach($activity->properties->toArray()['old'] as $key=>$value)
                                                    <tr><td>{!! $key !!}  </td><td>  {!! $value !!}</td></tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    @endif
                                </td>
                                <td>
                                    @if(count($activity->properties->toArray()) >0)
                                        <table>
                                            <tbody>
                                            @if(isset($activity->properties->toArray()['attributes']))
                                                @foreach($activity->properties->toArray()['attributes'] as $key=>$value)
                                                    <tr><td>{!! $key !!}  </td><td>  {!! $value !!}</td></tr>
                                                @endforeach
                                            @endif
                                            </tbody>
                                        </table>
                                    @endif

                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
@endif
    </td>

</tr>

