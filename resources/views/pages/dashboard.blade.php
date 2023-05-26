<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Banco de Soluções</title>

    <!-- Link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!--Link Ajax-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>


    <link rel="stylesheet" href={{ asset('styles/dashboard.css') }}>

</head>

<body>
    <header id="header">
        <!-- Navbar do site -->
        <menu class="fixed-top w-100">
            <div class="navbar1 w-100">
                <nav class="navbar navbar1 navbar-expand-lg bg-body-tertiary">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Helpdesk Banco de Soluções</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                                <path
                                    d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                            </svg>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">     
                            </ul>
                            <form class="d-flex" role="search">
                                <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50"
                                    fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                    <path
                                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                </svg>
                                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                    <li class="nav-item dropdown">
                                        <a class="nav-link dropdown-toggle" href="#" role="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Categorias
                                        </a>
                                        <ul class="dropdown-menu" id="header-categorias">
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <input class="form-control me-2" type="search" placeholder="Search"
                                    aria-label="Search">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </nav>
            </div>
            <!-- SideBar do Site -->
            <div class="navbar2 bg-body-tertiary">
                <nav class="navbar navbar2  fixed-top">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#"></a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar"
                            aria-labelledby="offcanvasNavbarLabel">
                            <div class="offcanvas-header">
                                <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Helpdesk Banco de Soluções</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                                    aria-label="Close"></button>
                            </div>
                            <!-- SideBar -->
                            <div class="offcanvas-body">
                                <!-- Search -->
                                <h6>Pesquisar por:</h6>
                                <label for="ititulo-search">Tiítulo: </label>
                                <form class="d-flex mt-3" role="search">
                                    <input class="form-control me-2" id="ititulo-search" type="search"
                                        placeholder="Search" aria-label="Search">
                                    <button class="btn btn-outline-success" type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                            <path
                                                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                                        </svg>
                                        Search
                                    </button>
                                </form>

                                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                                    <label for="icategoria-search">Categoria: </label>
                                    <form>
                                        <!-- DropBox -->
                                        <select id="icategoria-search" class="form-select btn-terciary"
                                            aria-label="Default select example">
                                            <option selected>Categorias</option>
                                        </select>
                                    </form>
                                    <hr>
                                    <li class="nav-item" style="margin-top: 20px;">
                                        <p>
                                            <a class="btn btn-primary" data-bs-toggle="collapse"
                                                href="#collapseExample" role="button" aria-expanded="false"
                                                aria-controls="collapseExample">
                                                Adicionar Categoria
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    fill="currentColor" class="bi bi-caret-down-fill"
                                                    viewBox="0 0 16 16">

                                                    <path
                                                        d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z" />
                                                </svg>
                                            </a>
                                        </p>
                                        <div class="collapse" id="collapseExample">
                                            <div class="card card-body">
                                                <form name="cadCategory">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="icategoria" class="form-label">Categoria: </label>
                                                        <input name="name" type="text" class="form-control"
                                                            id="icategoria" aria-describedby="emailHelp">
                                                        <div id="emailHelp" class="form-text">Insira uma categoria
                                                            diferente das existentes.</div>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </menu>
    </header>
    <!-- Adicionar Solução -->

    <div class="fixed-top create_task_button">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor"
                class="bi bi-plus-circle" viewBox="0 0 16 16">
                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                <path
                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Título da Solução</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form name="cadTituloCategoria" method="POST" action="{{ route('cadSolucao') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="icategoria" class="form-label">Título da Solução: </label>
                                <input name="title" type="text" class="form-control" id="icategoria"
                                    aria-describedby="emailHelp">
                                <div class="form-text">Insira um título para a sua solução</div>
                            </div>
                    </div>
                    <div class="modal-footer modal-footer-createTitle">
                        <button type="button" class="btn btn-danger button-create-title-task"
                            data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success button-create-title-task">Criar Solução</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    <section>
        <!-- Content com os conteudos -->
        <div class="card_container card w-100 mb-3" id="cardContainer"></div>
        <!-- Paginacao -->

        <div class="paginacao">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </section>


    <!-- <script src="{{ asset('scripts/Ajax.js') }}" defer></script> -->
    
    <script>
        //script que adiciona as categorias do BD na aba de pesquia por categorias
        $.ajax({
            type: "GET",
            url: "{{ route('mostrarCategorias') }}",
            success: function(response) {                
                categorias = response;
                categorias.forEach(element => {
                  //Adiciona as categorias ao icategoria-search
                    $("option").add("<option value=" + element.id + ">" + element.name + "</option>")
                        .appendTo("#icategoria-search");

                    //Adcionas as categorias ao 
                });
            }
        });
    </script>

    <script>
        //script que cria o card de solucao
        $.ajax({
            type: "GET",
            url: "{{ route('mostrarSolucoes') }}",
            success: function(response) {

                const card_solucao = response.data;
                console.log(card_solucao)

                const categories = card_solucao.categories;
                
                card_solucao.forEach(element => {
                    console.log(element)
                    const categories = element.categories;
                    
                    //Novo array com os nomes das categorias
                    const categoryNames = categories.map(function(category) {
                        return category.name;
                    });

                    $("#cardContainer").append(`<div class='card card_content card_content_principal${element.id}'></div>`);
                    
                    $(`.card_content_principal${element.id}`).append(`<div class="card-body" id="card-body-principal${element.id}"></div>`);

                   var card_content = `
                    <h5 class="card-title">${element.title}</h5>
                    <div class="card-text">${element.solution_text}</div>
                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Categorias
                                </a>
                                <ul class="dropdown-menu" id="card_categorias_solucao">
                                    ${categoryNames.map(function(name) {
                                        return `<li><p class="dropdown-item">${name}</p></li>`;
                                    }).join("")}
                                </ul>
                            </li>
                        </ul>

                    <button href={{ route('cardView') }} class="btn btn-primary button-edit" target="_self">
                        <img src="{{ asset('icons/editSolution.svg') }}" alt="editSolution">
                        Editar
                    </button>
                    <button class="btn btn-danger button-edit">
                        <img src="{{ asset('icons/deleteSolution.svg') }}" alt="editSolution">
                        Deletar
                    </button>
                    `;
                    
                    $(`#card-body-principal${element.id}`).append(card_content);
                });

            }
        });
    </script>

    <script>
        $(function() {
            $('form[name="cadCategory"]').submit(function(event) {

                event.preventDefault();

                $.ajax({
                    method: "POST",
                    url: "{{ route('cadCategoria') }}",
                    data: $(this).serialize(),
                    dataType: "json",
                    success: function(response) {
                        alert("Cadastrado com sucesso");
                    }
                });
            });
        });
    </script>
</body>
</html>
