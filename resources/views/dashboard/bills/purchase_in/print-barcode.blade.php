@foreach($details as $one)
    <img src="data:image/png,{{ \Milon\Barcode\DNS1D::getBarcodePNG('4', 'C39+') }}" alt="barcode"   />
    <p>{{$one->item->barcode}}</p>
    @if(checkEvenOdd(($loop->index + 1)) == 'Even' )
        <p style="page-break-after: always;">&nbsp;</p>
        <p style="page-break-before: always;">&nbsp;</p>
    @endif
@endforeach
{{--<p>1234</p>--}}
{{--<p style="page-break-after: always;">&nbsp;</p>--}}
{{--<p style="page-break-before: always;">&nbsp;</p>--}}
{{--<p>1234</p>--}}
