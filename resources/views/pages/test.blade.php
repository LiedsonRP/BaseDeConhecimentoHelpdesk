<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post" action="{{ route("cadCategoria") }}">
        @csrf
        <input type="text" name="name"/> 
        <button type="submit">Submit</button>
    </form>

    <form method="post" action="{{ route("cadSolucao") }}">
        @csrf        
        <input type="text" name="title" />
        <button type="submit">Submit</button>
    </form>

    <form method="post" action="{{ route("upload") }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="1"/>        
        <input type="file" name="files[]" multiple/> 
        <button type="submit">Submit</button>
    </form>

    @if (isset($files_url))
        @foreach ($files_url as $file)                
            <form method="post" action="{{ route("deleteFile", $id) }}">
                @csrf                                
                <input  name="file_name" value={{ (string) $file["file_name"] }} />
                <input type="text" value={{ $file["file_path"] }} />            
                <button type="submit">Deletar</button>
            </form>
            <br>        
        @endforeach
    @endif

</body>
</html>