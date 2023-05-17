<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="POST" action={{ route("editarSolucao", {{$id}}) }}>
        @csrf
        <input type="text" name="title" value={{ $title }}/>
        <textarea name="solution_text" value={{$solution_text}}></textarea>
        <input type="text" name="title" value={{ $title }}/>
    </form>    
</body>
</html>