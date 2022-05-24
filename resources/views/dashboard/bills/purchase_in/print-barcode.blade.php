@foreach($details as $one)
    <div style="width: 3.7cm; height: 1.15cm;">
    <img src="data:image/png;base64,{{ \Milon\Barcode\DNS1D::getBarcodePNG($one->item->barcode, 'C39',3,40,array(1,1,1), true) }}" alt="barcode"   />
    </div>
{{--    <p>{{$one->item->barcode}}</p>--}}
    @if(checkEvenOdd(($loop->index + 1)) == 'Even' )
        <p style="page-break-after: always;">&nbsp;</p>
        <p style="page-break-before: always;">&nbsp;</p>
    @endif
@endforeach
{{--<p>1234</p>--}}
{{--<p style="page-break-after: always;">&nbsp;</p>--}}
{{--<p style="page-break-before: always;">&nbsp;</p>--}}
{{--<p>1234</p>--}}
