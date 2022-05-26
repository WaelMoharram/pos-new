@foreach($details as $one)
    @for($i=0;$i<$one->amount;$i++)
    <div style="width: 3.8cm; height: 1.2cm;">
    <img style="margin: 4px;" src="data:image/png;base64,{{ \Milon\Barcode\DNS1D::getBarcodePNG($one->item->id, 'C39',1.4,47,array(1,1,1), true) }}" alt="barcode"   />
    </div>
{{--    <p>{{$one->item->barcode}}</p>--}}
    @if(checkEvenOdd(($count++)) == 'Even' )
        <div style="page-break-after: always;">&nbsp;</div>
    @endif
    @endfor
@endforeach
{{--<p>1234</p>--}}
{{--<p style="page-break-after: always;">&nbsp;</p>--}}
{{--<p style="page-break-before: always;">&nbsp;</p>--}}
{{--<p>1234</p>--}}
<script>
    window.print();
</script>
