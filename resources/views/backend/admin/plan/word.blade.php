<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <title>{{ strtoupper($plan->name)}} - {{ strtoupper($patient->full_name) }}</title>

</head>
<body>
<header>
    {!! $header !!}
</header>
<main>
    {!! $view_by_day !!}

    {!! $final_data !!}

</main>
</body>
</html>
