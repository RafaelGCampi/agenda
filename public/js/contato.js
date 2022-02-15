window.onload = function () {
    list();
};

function list(data = null) {
    $("#list tbody").html(
        '<div class="spinner-border" style="position: absolute;display: block;top: 25%;left: 50%;" role="status"><span class="sr-only"></span></div>'
    );
        $.ajax({
            url: "/contatos/list",
            type: "GET",
            success: function (data) {
                list_tbody(data)
            },
            error: function (data) {
                $("#list tbody").html(
                    $("<tr>").append(
                        $("<td colspan=4>").html(
                            $("<center>").html(
                                $("<b>").text(
                                    "Não foram encontrados contatos."
                                )
                            )
                        )
                    )
                );
            },
        });
}

function list_tbody(data) {
    $("#list tbody").html("");
    if (data.length > 0) {
        data.forEach(function (contato, key) {
            popula_tabela(contato);
        });
    } else {
        $("#list tbody").html(
            $("<tr>").append(
                $("<td colspan=4>").html(
                    $("<center>").html(
                        $("<b>").text("Não foram encontrados contatos.")
                    )
                )
            )
        );
    }
}

function popula_tabela(contato) {
    $("#list tbody").append(`<tr>
                        <td>${contato.nome}</td>
                        <td>${contato.email}</td>
                        <td>${contato.telefone}</td>
                        <td>${contato.endereco}</td>
                        <td><div class="contatos-list">
                        <button class="btn btn-primary" onclick="contato_open_edit(this, ${contato.id})" title="Editar contato">Editar</button>
                        <button class="btn btn-danger" onclick="delete_contato(this, ${contato.id})" title="Excluir contato">Deletar</button>
                          </div></td>
                        </tr>`);
}

function store_contato(el) {
    event.preventDefault();
    let formData = new FormData(el);
    let button = $(el).find("button");
    button.attr("disabled", true);
    button.html("Salvando...");
    $.ajax({
        url: "/contatos/store",
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function (result) {
            alert("Registro salvo com sucesso !");

            button.attr("disabled", false);
            button.html("Salvar");
            if ($("#id").val() >= 1) {
                $("#modal-geral").modal("hide");
            } else {
                limpa_form();
            }
            list();
        },
        error: function (erro) {
            if (!erro.responseJSON) {
                $("#erro").html(erro.responseText);
            } else {
                $("#erro").html("");
                $.each(erro.responseJSON.errors, function (key, value) {
                    $("#erro").attr("hidden", false);
                    $("#erro").append(value + "<br>");
                    // console.log(erro.responseJSON);
                });
            }

            button.html("Salvar");
            button.attr("disabled", false);
        },
    });
    return false;
}

function contato_open_create() {
    $("#modal-geral").modal("show");
    $("#modal-body-geral").html("Carregando....");
    $("#modal-geral-title").html("Criação de contatos");
    $(".modal-content").css("width", "800px");
    $("#modal-body-geral").load("/contatos/form", () => {
    });
}

function limpa_form() {
    $("input").val("");

function delete_contato(button, id_contato) {
    if (confirm("Deseja deletar contato?")) {
        $.ajax({
            url: "/contatos/delete/" + id_contato,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            method: "DELETE",
            cache: false,
            contentType: false,
            processData: false,
            success: function (result) {
                list();
                $(button).html("Deletar");
                $(button).attr("disabled", false);
            },
            error: function (erro) {
                if (!erro.responseJSON) {
                    console.log(erro.responseText);
                    $("#erro").html(erro.responseText);
                } else {
                    $("#erro").html("");
                    $.each(erro.responseJSON.errors, function (key, value) {
                        $("#erro").attr("hidden", false);
                        $("#erro").append(value + "<br>");
                        // console.log(erro.responseJSON);
                    });
                }

                $(button).html("Deletar");
                $(button).attr("disabled", false);
            },
        });
    }
}

function contato_open_edit(button, id_contato) {
    $.ajax({
        url: "/contatos/sedit/" + id_contato,
        type: "GET",
        success: function (contato) {
            $("#modal-geral").modal("show");
            $("#modal-body-geral").html("Carregando....");
            $("#modal-geral-title").html("Edição de contatos");
            $(".modal-content").css("width", "800px");
            $("#modal-body-geral").load("/contatos/form", () => {
                console.log('contato',contato);
                $("#id").val(contato.id);
                $("#nome").val(contato.nome);
                $("#email").val(contato.email);
                $("#telefone").val(contato.telefone);
                $("#endereco").val(contato.endereco);

            });
        },
        error: function (error) {},
    });
}


