@extends('layouts.master')

@section('content')


<h1>Display LDAP</h1>
<pre>
<?php

foreach($users as $user)
{
	print_r($user->attributes);
}

?>
</pre>


@stop