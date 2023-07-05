<link rel="stylesheet" href="/damask/components/modals/comparar_productos_detalle/styles.css">

<div class="modal fade" id="modalCompProductoDet" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white text-weight-bold text-center">
        <h1 class="modal-title fs-5 text-decoration-none" id="exampleModalToggleLabel">Comparativa de Productos...</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div class="modal-body">
        <div class="contProductsComparisionDet container-fluid content-articulos mx-auto text-center rounded">
            <div id = "contentLowerPrice" class="row p-2">
                <h2 class = "titleCompDet">Producto con el valor mas bajo</h2>
                
                <hr>

                <div id="lowerPrice">

                </div>
            </div>

            <div id = "contentHigherPrice" class="row p-2">
                <h2 class = "titleCompDet">Producto con el valor mas alto</h2>
                
                <hr>

                <div id="higherPrice">
                    
                </div>
            </div>

            <div id = "contentStadistics" class="row p-2">
                <h2 class = "titleCompDet">Estadisticas de los productos</h2>
                
                <hr>

                <div id="stadistics">
                    
                </div>
            </div>
        </div>
      </div>

      <div class="modal-footer text-center">
        <button type="button" class="btn btn-primary"
        data-bs-toggle="modal" data-bs-target="#modalCompProducto">Atras</button>
      </div>
    </div>
  </div>
</div>