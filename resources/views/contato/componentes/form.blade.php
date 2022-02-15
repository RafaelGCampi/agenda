<form name="section_form" onsubmit="store_contato(this)" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <input hidden class="form-control" name="id" id="id">
    </div>
    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="name">Nome:</label>
            <input class="form-control" name="nome" id="nome" type="text" required placeholder="Digite o nome">
        </div>

        <div class="form-group col-6">
            <label class="col-form-label" for="name">Email:</label>
            <input class="form-control" id="email" name="email" type="email" required
                placeholder="Digite o email">
        </div>
    </div>

    <div class="row">
        <div class="form-group col-6">
            <label class="col-form-label" for="name">Telefone:</label>
            <input class="form-control" id="telefone" name="telefone" type="text"  placeholder="Digite o telefone">
        </div>
        <div class="form-group col-6">
            <label class="col-form-label" for="endereco">Endereco:</label>
            <input class="form-control" id="endereco" name="endereco" type="text" placeholder="Digite o cro endereço">
        </div>
    </div>


    <div class="alert-danger" id="erro"></div>
    <button type="submit" style="float:right" class="btn btn-primary">Salvar</button>
</form>
