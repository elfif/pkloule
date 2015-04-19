@extends('app')

@section('content')

<div class="container">
    <div class="jumbotron">
        <h1>{{{ $player->nom }}} - - </h1>
    </div>
    <div class='row'>
        <div class='col-sm-3'>
            <h3>{{{ count($participations) }}} parties jouées</h3> 
        </div>
        <div class='col-sm-3'>
            <h3>Cave : {{{ $participations->sum('cave') }}} €</h3>
        </div>
        <div class='col-sm-3'>
            <h3>Résultat : {{{ $participations->sum('resultat') }}} €</h3>
        </div>
        <div class='col-sm-3'>
            <h3>Bénéfice : {{{ $participations->sum('diff') }}} €</h3>
        </div>
    </div>
    <br />
    <div class='col-sm-12' id='playerChart'></div>
    <br />
    <div class="col-sm-6">
        <table class="table table-striped" id='datatable'>
            <thead>
                <tr>
                    <th></th>
                    <th>Cave</th>
                    <th>Résultat</th>
                    <th>Bénéfice</th>
                </tr>
            </thead>
            <tbody>
                @foreach($participations as $p)
                <tr>
                    <th><a href="{{{ route('ShowPartie', ['id' => $p->partie->id]) }}}">
                            {{{ $p->partie->created_at->format('d/m/Y') }}} - {{{ $p->partie->lieu }}}
                        </a>
                    </th>
                    <td>{{{ $p->cave }}}</td>
                    <td>{{{ $p->resultat }}}</td>
                    <td>{{{ $p->diff }}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection('content')

@section('jsContent')
<script type='text/javascript'>
$(document).ready(function(){
    $('#playerChart').highcharts({
        data: {
            table: document.getElementById('datatable')
        },
        chart: {
            type: 'column'
        },
        yAxis: {
            allowDecimals: false,
            title: {
                text: '€'
            }
        },
        tooltip: {
            formatter: function () {
                return '<b>' + this.series.name + ' - ' + this.point.name.toLowerCase() + '</b> : ' +
                    this.point.y +'€';
            }
        }
    });
});
        
</script>
@endsection('jsContent')
