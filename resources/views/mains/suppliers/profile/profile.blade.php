@extends('mains.suppliers.show')

@section('profile')
<x-suppliers.profileindex :supplier="$supplier"/>
@endsection

@push('scripts')
    <script>
        function supplierProfileModal(Route) {
            $.ajax({
                type: "get",
                url: Route,
                success: function (res) {
                    console.log(res);
                    $('#suplierProfileModelBody').html(res);
                },
                error : function(err){
                    alert(err.statusText);
                }
            });
        }
    </script>
@endpush