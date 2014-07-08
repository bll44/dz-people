@extends('layouts/master')

@section('content')

<button id="install-printer" onclick="vbscript:MyFunc()" type="button">Install Printer</button>

<script type="text/vbscript">

Sub MyFunc()
	MsgBox "Its working"
	Set WshNetwork = WScript.CreateObject("WScript.Network")
	PrinterPath = "\\phlprint01\PHL0506-WC5745"
	WshNetwork.AddWindowsPrinterConnection PrinterPath
End Sub

</script>

@stop