<style>
    body{
        margin:0;
    }
    .print{
        width: 5.7cm; height: 1cm;


    }
</style>
@foreach($details as $one)
    @for($i=0;$i<$one->amount;$i++)
    <div class="print">
    <img  src="data:image/png;base64,{{ \Milon\Barcode\DNS1D::getBarcodePNG($one->item->id, 'C39',1.2,30,array(1,1,1), true) }}" alt="barcode"   />
    </div>
{{--    <div style="page-break-after: always;">&nbsp;</div>--}}
{{--    <div style="page-break-before: always;">&nbsp;</div>--}}
    {{--<p style="page-break-before: always;">&nbsp;</p>

    {{--    <p>{{$one->item->barcode}}</p>--}}
    @if(checkEvenOdd(($count++)) == 'Even' )
        <div style="page-break-before: always; height: 1mm;">&nbsp;</div>
{{--        <div style="page-break-after: always;">&nbsp;</div>--}}
{{--        <div style="page-break-before: always;">&nbsp;</div>--}}
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
