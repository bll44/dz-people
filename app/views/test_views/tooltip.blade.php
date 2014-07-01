@extends('layouts.master')

@section('content')


<button type="button" class="btn btn-default" data-toggle="tooltip" data-placement="left" title="tooltip on top">Tooltip on top</button>

<div class="divvy" data-toggle="tooltip" data-placement="left" title="tooltip on top">
hello
</div>

<script>

$("div").tooltip();

</script>

@stop