@extends('app')

@section('content')
<h1 class='col-sm-offset-2'>Partie du {{{$partie->created_at->format('d-m-Y')}}} chez {{{$partie->lieu}}}</h1>
<div class='col-sm-10 col-sm-offset-1' id='playersChart'></div>
<div class='row'>
<div class='col-sm-4 col-sm-offset-1' id='cavesChart'></div>
<div class='col-sm-4 col-sm-offset-1' id='resultatsChart'></div>
</div>
@endsection('content')

@section('jsContent')
<script type='text/javascript'>
    var chartPlayersJson = JSON.parse(Encoder.htmlDecode('{{ $partie->getJsonPlayersChart() }}'));
    var chartCavesJson = JSON.parse(Encoder.htmlDecode('{{ $partie->getJsonCavesChart() }}'));
    var chartResultatsJson = JSON.parse(Encoder.htmlDecode('{{ $partie->getJsonRésultatsChart() }}'));
    
    $('#playersChart').highcharts(chartPlayersJson);
    $('#cavesChart').highcharts(chartCavesJson);
    $('#resultatsChart').highcharts(chartResultatsJson);
</script>
@endsection('jsContent')