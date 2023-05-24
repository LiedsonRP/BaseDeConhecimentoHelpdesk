export function getCategorias(){
    $.ajax({
        type: "GET",
        url: "{{ route('mostrarCategorias') }}",        
        success: function( response ) {
          console.log(response);
          var categorias = [{"id": 1, "name": "software"},{"id": 1, "name": "pc"}];

          categorias.forEach(element => {
              $( "option" ).add( "<option value="+element.id+">"+element.name+"</option>" ).appendTo( "#icategoria-search" );
          });
        }
      });
}

export function postCategorias(){

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
    
}

export default getCategorias();
