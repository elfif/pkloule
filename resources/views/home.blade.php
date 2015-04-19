@extends('app')

@section('content')
<div class="container">
    <div class="jumbotron">
        <h1>Récapitulatif général</h1>
    </div>
    
    <div class='col-sm-12' id='playersChart'></div>
    
    <div class="col-sm-12">
        <table class="table table-striped" id='datatable'>
            <thead>
                <tr>
                    <th></th>
                    <th>Bénéfice</th>
                    <th>Total Caves</th>
                    <th>Total Résultats</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tabResult as $result)
                <tr>
                    <th><a href="{{{ route('ShowPlayer', ['id' => $result['playerId']]) }}}">
                            {{{ $result['player'] }}}
                        </a>
                    </th>
                    <td>{{{ $result['benefice'] }}}</td>
                    <td>{{{ $result['cave'] }}}</td>
                    <td>{{{ $result['resultat'] }}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

@section('jsContent')
<script type='text/javascript'>
$(document).ready(function(){
    $('#playersChart').highcharts({
        data: {
            table: document.getElementById('datatable')
        },
        title: {
            text: ''
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
