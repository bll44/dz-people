$printerPath = "\\phlprint01\PHL0506-WC5745"
$obj = New-Object -ComObject WScript.Network
$obj.AddWindowsPrinterConnection($printerPath)
$obj.SetDefaultPrinter($printerPath)