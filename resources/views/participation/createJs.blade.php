var url = '{{ $url }}';
var html = '{{ $html }}';
$('#NewParticipantLink').attr('href', url);
$('#participants').append(Encoder.htmlDecode(html));
handlePlayerFormCalculs();
