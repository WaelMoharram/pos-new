<style>
    body{
        margin:0;
    }
    .print{
        width: 5.7cm; height: 2cm; margin-left: 1.5mm;


    }
</style>
@foreach($details as $one)
    @for($i=0;$i<$one->amount;$i++)
        <div class="print">
            {!!  \Milon\Barcode\DNS1D::getBarcodeHTML($one->item->barcode, 'C128',true) !!}
            <div style="width: 135px;font-size: 12px;">
                <span>{{$one->item->barcode}}</span>
            </div>
            <div style="width: 135px;font-size: 12px;">
                <span>{{$one->item->name}}</span>
            </div>

            {{--    <img  src="data:image/png;base64,{{ \Milon\Barcode\DNS1D::getBarcodePNG($one->item->barcode, 'C128',1.2,30,array(1,1,1), true) }}" alt="barcode"   />--}}
        </div>
        <div style="page-break-before: always; height: 1mm;">&nbsp;</div>


    @endfor
@endforeach
{{--<p>1234</p>--}}
{{--<p style="page-break-after: always;">&nbsp;</p>--}}
{{--<p style="page-break-before: always;">&nbsp;</p>--}}
{{--<p>1234</p>--}}
<script>
    window.print();
</script>
