<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Link bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
      <!-- Navbar do site -->
      <menu>
        <div class="navbar1 w-100">
          <nav class="navbar navbar1 navbar-expand-lg bg-body-tertiary">
              <div class="container-fluid">
                <a class="navbar-brand" href="#">Helpdesk Banco de Soluções</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                  </svg>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                      <a class="nav-link active" aria-current="page" href="#"></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled"></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled"></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link disabled"></a>
                    </li>
                  </ul>
                  <form class="d-flex" role="search">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                      <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                    </svg>
                      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                              Categorias
                            </a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item" href="#">Categoria 1</a></li>
                              <li><a class="dropdown-item" href="#">Categoria 2</a></li>
                              <li><hr class="dropdown-divider"></li>
                              <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                          </li>
                        </ul>
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
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
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                  <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Helpdesk Banco de Soluções</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                  </div>
                  <!-- SideBar -->
                  <div class="offcanvas-body">
                      <!-- Search -->
                      <form class="d-flex mt-3" role="search">
                        
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                          </svg>
                          Search
                        </button>
                      </form>
      
                      <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                          <!-- DropBox -->
                        <li class="nav-item dropdown">
                          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categorias
                          </a>
                          <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Categoria 1</a></li>
                            <li><a class="dropdown-item" href="#">Categoria 2</a></li>
                            <li>
                              <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Categoria 3</a></li>
                          </ul>
                        </li>
                      <li class="nav-item" style="margin-top: 20px;">
                              <p>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                  Adicionar Categoria
                                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-down-fill" viewBox="0 0 16 16">
  
                                    <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                                  </svg>
                                </a>
                              </p>
                              <div class="collapse" id="collapseExample">
                                <div class="card card-body">
                                  <form>
                                    <div class="mb-3">
                                      <label for="icategoria" class="form-label">Categoria: </label>
                                      <input type="text" class="form-control" id="icategoria" aria-describedby="emailHelp">
                                      <div id="emailHelp" class="form-text">Insira uma categoria diferente das existentes.</div>
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
      <section>
          <!-- Content com os conteudos -->
            <div class="card_container card w-100 mb-3">
                <div class="card card_content">
                    <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
                    <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
                    </div>
                </div>
                <div class="card card_content">
                  <div class="card-body">
                  <h5 class="card-title">Card title</h5>
                  <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
                  <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
                  </div>
              </div>
              <div class="card card_content">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
                <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
                </div>
            </div>
            <div class="card card_content">
              <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
              <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
              </div>
          </div>
          <div class="card card_content">
            <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
            <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
            </div>
        </div>
        <div class="card card_content">
          <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
          <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
          </div>
      </div>
              <div class="card card_content">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
                <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
                </div>
            </div>
            <div class="card card_content">
              <div class="card-body">
              <h5 class="card-title">Card title</h5>
              <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
              <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
              </div>
          </div>
              <div class="card card_content">
                <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Asperiores consequatur id cum ea aliquid exercitationem blanditiis, natus, impedit doloribus deleniti optio a fugit quis praesentium, odio veritatis earum ab hic?</p>
                <a href="jodit.html" class="btn btn-primary button-edit" target="_self">Editar</a>
                </div>
            </div>
      
            </div>
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
</body>
</html>