
/*

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               Adiciona via JQUERY uma tr com inputs para inserir mais telefones

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                               */
function addTel() {
    let countButtons = $('.telefones').length
    let tr = `<tr>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td><input maxlength="15" autocomplete="off"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                onkeyup="formataTel(event)" type="text"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                name="tel${countButtons + 1}" class="form-control telefones"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                placeholder="Telefone ${countButtons + 1}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        <td><input autocomplete="off" type="text"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                name="telDesc ${countButtons + 1}"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                class="form-control telefonesDescricao"
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                placeholder="Descrição ${countButtons + 1}">
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </td>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </tr>`
    $('#cadastraTel').append(tr)

}

/*

     Formata CPF vindo da requisição ajax de inserção

 */
function formataCpf(cpf) {
    //retira os caracteres indesejados...
    cpf = cpf.replace(/[^\d]/g, "");

    //realizar a formatação...
    return cpf.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4");
}

/*
    Formata o conteúdo do campo cpf da forma "XXX.XXX.XXX-XX"
*/
$('#cpf').on('keypress', function () {
    let cpfLength = $('#cpf').val().length
    if (cpfLength === 3 || cpfLength === 7) {
        this.value += '.'
    } else if (cpfLength === 11) {
        this.value += '-'
    }
})


/*
  Função baseada num evento que modifica o valor do input conforme a função mascaraTelefones
*/

function formataTel(event) {
    let input = event.target;
    input.value = mascaraTelefone(input.value)
}
/*
        Formata o conteúdo dos inputs de telefone da seguinte forma (XX) XXXXX-XXXX
    */
function mascaraTelefone(value) {
    if (!value) return ""
    value = value.replace(/\D/g, '')
    value = value.replace(/(\d{2})(\d)/, "($1) $2")
    value = value.replace(/(\d)(\d{4})$/, "$1-$2")
    return value
}

/*
    Event Listner que acionará a requisição de store
    Está composta nas seguintes etapas
        - Reune os inputs de telefones e descrição em variáveis
        - Elas foram montadas da seguinte maneira
            -Como foram geradas em um for que possui index de 1 a 5,o jquery irá busca-las na ordem em que foram geradas pelo forEach.
             Assim é possível monta-las novamente em um foreach javascript

        - Reune em um objeto allTelefones as variaveis telefones e telefonesDescricao

        -Após a finalização da requisição, serão buscados parametros como "msg" e "success" para descrever o retorno do Backend
        -Conforme o resultado, um popup irá aparecer indicando a mensagem
        -Caso tudo ocorra conforme esperado os novos dados serão inseridos na tabela de Dados Gravados
*/

$('#enviar').on('click', function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let telefones = {}
    let index = 1;
    for (telefone of $('.telefones')) {
        telefones[index] = telefone.value

        index++
    }
    index = 1;
    let telefonesDescricao = {};
    for (telefoneDescricao of $('.telefonesDescricao')) {
        telefonesDescricao[index] = telefoneDescricao.value

        index++
    }
    let allTelefones = Object.assign({}, telefones, telefonesDescricao)

    $.ajax({
        method: "POST",
        url: 'pessoa/salvar',
        data: {
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            telefones: telefones,
            descricao: telefonesDescricao,
            endereco: $('#endereco').val()
        }

    }).done(function (response) {
        console.log(response)
        if (response.success === false) {
            notificacao(response.msg)
        } else if (response.success == true) {
            document.getElementById("mainForm").reset();

            notificacao(response.msg)
            let tr = addTr(response.pessoa, response.telefones)
            $('#conteudo').append(tr)
        }


    })
})

function addTr(pessoa, telefones) {
    let tr =
        `<tr id="pessoa${pessoa.id}">
                <td class="text-center  align-middle">${pessoa.nome}</td>
                <td class="text-center  align-middle">${pessoa.endereco}</td>
                <td class="text-center  align-middle">${formataCpf(pessoa.cpf)}</td>
                <td class="text-center  align-middle">`


    for (telefone of telefones) {
        tr += `${telefone.telefone}  -  ${telefone.descricao}<br>`

    }
    tr +=
        `</td><td class="text-center"><button onclick="getPessoa(${pessoa.id})" type="button" class="btn btn-success"><i class="fas fa-edit"></i></button>
                <button onclick = "deletePessoa(${pessoa.id})" type="button" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                </button>
                </td></tr>`
    return tr;
}

function notificacao(message) {
    Swal.fire({
        text: message,
        target: '#custom-target',
        customClass: {
            container: 'position-absolute'
        },
        toast: true,
        position: 'top-right'
    })
}

function deletePessoa(idPessoa) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let url = `/pessoa/delete/${idPessoa}`
    $.ajax({
        method: 'DELETE',
        url: url
    }).done(function (response) {
        if (response.success == true) {
            console.log($('#pessoa' + idPessoa))
            $('#pessoa' + idPessoa).remove()

            notificacao(response.msg)
        } else {
            notificacao(response.msg)
        }
    })
}

function getPessoa(idPessoa) {
    let url = `/pessoa/${idPessoa}`
    $.ajax({
        method: 'GET',
        url: url
    }).done(function (response) {
        if (response.success == true) {
            console.log(response)
            $('#nome').val(`${response.pessoa.nome}`)
            $('#cpf').val(`${response.pessoa.cpf}`)
            $('#endereco').val(`${response.pessoa.endereco}`)
            let index = 0;
            let telefones1 = $('.telefones');
            let telefonesDescricao1 = $('.telefonesDescricao')

            for (telefone of response.pessoa.telefones) {
                telefones1[index].value = telefone.telefone;
                telefonesDescricao1[index].value = telefone.descricao
                index++
            }
            console.log($('#buttons').length)
            if ($('#buttons button').length == 1) {
                $('#enviar').addClass('disabled');
                let button = `<button id="update" onclick="updatePessoa(${response.pessoa.id})" type="button"
                class="btn btn-primary text-center ">Atualizar</button>
                <button class="btn btn-danger type="button" id="cancelUpdate" onclick="finalizaUpdate()" >
                <i class="fa fa-cancel"></i>
                </button>`
                $('#buttons').append(button)
            }



        } else {
            notificacao(response.msg)
        }
    })
}
function finalizaUpdate() {
    $('#cancelUpdate').remove()
    $('#update').remove()
    $('#enviar').removeClass('disabled');
    document.getElementById("mainForm").reset();

}

function updatePessoa(idPessoa) {
    let telefones = {}
    let index = 1;
    for (telefone of $('.telefones')) {
        telefones[index] = telefone.value

        index++
    }
    index = 1;
    let telefonesDescricao = {};
    for (telefoneDescricao of $('.telefonesDescricao')) {
        telefonesDescricao[index] = telefoneDescricao.value

        index++
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        method: 'PUT',
        url: `/pessoa/${idPessoa}`,
        data: {
            nome: $('#nome').val(),
            cpf: $('#cpf').val(),
            telefones: telefones,
            descricao: telefonesDescricao,
            endereco: $('#endereco').val()
        }
    }).done(function (response) {
        console.log(response)
        if (response.success == true) {
            $('#pessoa' + idPessoa).remove()
            let tr = addTr(response.pessoa, response.telefones);
            $('#conteudo').append(tr)
            finalizaUpdate()
            notificacao(response.msg)
        } else {
            notificacao(response.msg)
        }

    })
}
