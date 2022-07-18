<div class="col-12">
    <button id="target" type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">حفظ</button>
    <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">الفاء</button>
</div>


<script>
    $( "#target" ).click(function() {
        $( "#target" ).addClass( "disabled" );
    });
</script>
