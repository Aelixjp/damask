<link rel="stylesheet" href="/damask/components/modals/comparar_productos/styles.css">

<div class="modal fade" id="modalCompProducto" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white text-weight-bold text-center">
        <h1 class="modal-title fs-5 text-decoration-none" id="exampleModalToggleLabel">Comparar productos</h1>
        <button id="btnModCompClose" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <!-- Contenedor que encierra un mensaje para cuando no se han agregado todavia productos -->
        <div id="emptyProducts">
          <i class="d-block checkIcon bi bi-check-circle text-success"></i>
          <p class="my-4 text-secondary text-center fst-italic">Aquí apareceran tus productos una vez añadas productos a la lista de comparación...</p>
        </div>

        <div class="contProductsComparision container-fluid content-articulos mx-auto text-center rounded">
          <div id = "contentProductsComp" class="row p-2">
            
          </div>

          <div id = "compareProdSection" class="compareProdSection d-none">
            <hr>

            <div class="cardOperations justify-content-center my-3 mt-4">
              <button id = "btnCompareProd" class="btn btn-danger"
              data-bs-toggle="modal" data-bs-target="#modalCompProductoDet">Comparar Productos</button>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" aria-label="Close">Cerrar</button>
      </div>
    </div>
  </div>
</div>