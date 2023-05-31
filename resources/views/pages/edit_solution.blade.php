<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Banco de Soluções</title>
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.24.2/jodit.es2018.min.css"
    />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jodit/3.24.2/jodit.es2018.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

     <!--Link Ajax-->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
     <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/und/popper.min.js"></script>
     <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href={{ asset("styles/edit_solution.css") }}>
   
</head>
<body>
    <section>
        <div class="container">
            <nav class="nav-link" style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href={{route("dashboard")}}>Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Editar</li>
                </ol>
              </nav>
              
              <form id="form_edit_solution" method="POST" action={{ route("editarSolucao", $solution["id"]) }}>
                @csrf
                @method("PUT")
                <div class="input_title_solution">
                  <input name="title" id="title-solution" type="text" value="{{ $solution["title"] }}"></input>
                  <label for="title-solution">
                    <img width="40" style="background: #000000" src="{{ asset('icons/editSolution.svg')}}" alt="">
                  </label>
                </div>

                  <div>Criado em: {{ $solution["created_at"] }}</div>
                    <div>Atualizado em: {{ $solution["updated_at"] }}</div>
                    <textarea id="editor" name="solution_text">{{ $solution["solution_text"] }}</textarea>
                    
                    <button type="submit" class="btn btn-success btn-adicionar">Enviar</button>
                    <div class="form-group col-md">
                      <select data-role="tagsinput" name="categories" id="addcategoria" class="form-select form-control" multiple aria-label="Default select example">
                        <option value=""></option>
                      </select>
                    </div>
                </form>
                <div>
                  Categoria:
                  @foreach ($solution["categories"] as $value)
                  <br>x
                  {{ $value["name"]}}
                  
                  @endforeach

                    <div class="alert alert-danger">{{ $errors }}</div>                  
                </div>
             <form class="form-jodit">
                <div class="input-categoria">
                  <select id="addcategoria" class="form-select" aria-label="Default select example">
                    <option selected>Selecionar Categorias</option>
                  </select>
                  <div class="input-group input-file">
                    <input type="file" class="form-control " id="inputGroupFile04" aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                    <button class="btn btn-outline-secondary" type="button" id="inputGroupFileAddon04">Adicionar</button>
                  </div>
                </div>
            </form>
             
        </div>
        <div class="navbar-link-imagens">
            <p>
                <a class="btn btn-secondary w-100" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                  Link Das imagens
                </a>
              </p>
              <div class="collapse" id="collapseExample">
                <div class="card card-body">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="#">Active</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">Link</a>
                        </li>
                      </ul>
                </div>
              </div>
        </div>
    </section>
    <script>
        var editor = Jodit.make('#editor');
    </script>
    <script>
      $.ajax({
          type: "GET",
          url: "{{ route('mostrarCategorias') }}",
          success: function(response) {                
              categorias = response;
              categorias.forEach(element => {
                //Adiciona as categorias ao icategoria-search
                  $("option").add("<option value=" + element.id + ">" + element.name + "</option>")
                      .appendTo("#addcategoria");

                  //Adcionas as categorias ao 
              });
          }
      });
  </script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#addcategoria').multiselect({
        includeSelectAllOption: true,
        buttonWidth: '200px'
      });
    });
  </script>
  <script>
    $.ajax({
            type: "GET",
            url: "{{ route('mostrarSolucoes') }}",
            success: function(response) {

                const card_solucao = response.data;
                console.log(card_solucao)
                
                card_solucao.forEach(element => {                    
                    const categories = element.categories;
                    $("#editor").append(`<p>Teste</p>`);
                  
                });

            }
        });
    </script>
</body>
</html>