   <!-- Modal Structure -->
   <div id="edit-{{ $produto->id }}" class="modal">
    <div class="modal-content">
      <h4><i class="material-icons">edit</i>Editar produto</h4>
      <form action = "{{ route('admin.produto.edit') }}" method="POST" enctype="multipart/form-data" class="col s12">
        @csrf
        @method('PUT')
        <div class="row">

        <input name='id' id="id" type="hidden" class="validate" value="{{ $produto->id }}">

          <div class="input-field col s6">
            <input name='nome' id="nome" type="text" class="validate">
            <label for="nome">Nome</label>
          </div>

          <div class="input-field col s6">
            <input name='preco' id="preco" type="number" class="validate">
            <label for="preco">Preço</label>
          </div>

          <div class="input-field col s12">
            <input name='descricao' id="descricao" type="text" class="validate">
            <label for="descricao">Descrição</label>
          </div>

          <div class="input-field col s12">
            <select name="id_categoria">
              <option value="" disabled selected>Escolha uma opção</option>
              @foreach ($categorias as $categoria)
                  <option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
              @endforeach
            </select>
            <label>Categoria</label>
          </div>          

            <div class="file-field input-field col s12">
              <div class="btn">
                <span>Imagem</span>
                <input name="imagem" type="file">
              </div>
              <div class="file-path-wrapper">
                <input class="file-path validate" type="text">
              </div>

            </div>
        </div> 
       
        <button type="submit" class="waves-effect waves-green btn green right">Editar</button><br>
      </div>
    
  </form>
  </div>