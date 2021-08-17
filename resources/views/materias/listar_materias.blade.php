@extends('layout.layout')

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" >
@endsection

@section('head')
<div class="container-fluid d-flex align-self-center flex-wrap flex-sm-nowrap " >
    <div class="col ">
        <h4 class="font-weight-bold  ">Lista de Materias</h4>
    </div>
</div>

@endsection

@section('content')
<div class="kt-portlet kt-portlet--mobile">

    <div class="d-flex justify-content-between  pt-10 mt-15">
		<div class="mr-2"></div>
			<div>
				<a  href="{{route('materias_crear')}}" type="submit" class="btn btn-primary font-weight-bolder px-9 py-4"  style="margin:20px" >Agregar Materia</a>
			</div>
	</div>

    <div class="kt-portlet__body">
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Materia</th>
                    <th width="200">editar</th>
                    <th width="200">eliminar</th>
                </tr>
            </thead>
            
        </table>


    </div>




</div>

@endsection


@section('js')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap4.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "ajax":"{{route('tabla.materias')}}",
            "columns":[
                {data: 'materia'},
                {data: 'action'},
                {data: 'action2'}
            ],
            responsive: true,
            autoWidth: false,
            "language": {
            "lengthMenu": "Mostrar _MENU_ registros por página",
            "zeroRecords": "Nada encontrado - disculpa",
            "info": "Página _PAGE_ de _PAGES_",
            "infoEmpty": "No hay registros disponibles",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar",
            "paginate":{
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
        });
    } );
</script>

@endsection