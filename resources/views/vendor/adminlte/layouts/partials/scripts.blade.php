
<script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
<script src="{{ asset('/js/alertify.js') }}" type="text/javascript"></script>


<script src="{{ asset('/js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/messages_es.js') }}"></script>
<script src="{{ asset('/js/moment.js')}}" type="text/javascript" ></script>

<script type="text/javascript" charset="utf8" src="{{ asset('/js/DataTables/datatables.js') }}"></script>
<script src="{{ asset('/js/daterangepicker.js') }}" type="text/javascript" ></script>

<script src="{{ asset('/js/notify.js') }}" type="text/javascript"></script>
<!-- js fileinput-->

<script>
var _token=$('input[name=_token]').val();   

</script>
<script>
$(document).ready(function(){
    var url = window.location;
    $('ul.sidebar-menu a').filter(function() {
        $('#pri').removeClass('active');
        return this.href == url;
    }).parent().addClass('active');

    $('ul.treeview-menu a').filter(function() {
        return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');
});
</script>
