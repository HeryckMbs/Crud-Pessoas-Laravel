<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Laravel</title>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @notifyCss
    <!-- Styles -->
    <style>
        /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
        html {
            line-height: 1.15;
            -webkit-text-size-adjust: 100%
        }

        body {
            margin: 0
        }

        a {
            background-color: transparent
        }

        [hidden] {
            display: none
        }

        html {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, Segoe UI, Roboto, Helvetica Neue, Arial, Noto Sans, sans-serif, Apple Color Emoji, Segoe UI Emoji, Segoe UI Symbol, Noto Color Emoji;
            line-height: 1.5
        }

        *,
        :after,
        :before {
            box-sizing: border-box;
            border: 0 solid #e2e8f0
        }

        a {
            color: inherit;
            text-decoration: inherit
        }

        svg,
        video {
            display: block;
            vertical-align: middle
        }

        video {
            max-width: 100%;
            height: auto
        }

        .bg-white {
            --bg-opacity: 1;
            background-color: #fff;
            background-color: rgba(255, 255, 255, var(--bg-opacity))
        }

        .bg-gray-100 {
            --bg-opacity: 1;
            background-color: #f7fafc;
            background-color: rgba(247, 250, 252, var(--bg-opacity))
        }

        .border-gray-200 {
            --border-opacity: 1;
            border-color: #edf2f7;
            border-color: rgba(237, 242, 247, var(--border-opacity))
        }

        .border-t {
            border-top-width: 1px
        }

        .flex {
            display: flex
        }

        .grid {
            display: grid
        }

        .hidden {
            display: none
        }

        .items-center {
            align-items: center
        }

        .justify-center {
            justify-content: center
        }

        .font-semibold {
            font-weight: 600
        }

        .h-5 {
            height: 1.25rem
        }

        .h-8 {
            height: 2rem
        }

        .h-16 {
            height: 4rem
        }

        .text-sm {
            font-size: .875rem
        }

        .text-lg {
            font-size: 1.125rem
        }

        .leading-7 {
            line-height: 1.75rem
        }

        .mx-auto {
            margin-left: auto;
            margin-right: auto
        }

        .ml-1 {
            margin-left: .25rem
        }

        .mt-2 {
            margin-top: .5rem
        }

        .mr-2 {
            margin-right: .5rem
        }

        .ml-2 {
            margin-left: .5rem
        }

        .mt-4 {
            margin-top: 1rem
        }

        .ml-4 {
            margin-left: 1rem
        }

        .mt-8 {
            margin-top: 2rem
        }

        .ml-12 {
            margin-left: 3rem
        }

        .-mt-px {
            margin-top: -1px
        }

        .max-w-6xl {
            max-width: 72rem
        }

        .min-h-screen {
            min-height: 100vh
        }

        .overflow-hidden {
            overflow: hidden
        }

        .p-6 {
            padding: 1.5rem
        }

        .py-4 {
            padding-top: 1rem;
            padding-bottom: 1rem
        }

        .px-6 {
            padding-left: 1.5rem;
            padding-right: 1.5rem
        }

        .pt-8 {
            padding-top: 2rem
        }

        .fixed {
            position: fixed
        }

        .relative {
            position: relative
        }

        .top-0 {
            top: 0
        }

        .right-0 {
            right: 0
        }

        .shadow {
            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06)
        }

        .text-center {
            text-align: center
        }

        .text-gray-200 {
            --text-opacity: 1;
            color: #edf2f7;
            color: rgba(237, 242, 247, var(--text-opacity))
        }

        .text-gray-300 {
            --text-opacity: 1;
            color: #e2e8f0;
            color: rgba(226, 232, 240, var(--text-opacity))
        }

        .text-gray-400 {
            --text-opacity: 1;
            color: #cbd5e0;
            color: rgba(203, 213, 224, var(--text-opacity))
        }

        .text-gray-500 {
            --text-opacity: 1;
            color: #a0aec0;
            color: rgba(160, 174, 192, var(--text-opacity))
        }

        .text-gray-600 {
            --text-opacity: 1;
            color: #718096;
            color: rgba(113, 128, 150, var(--text-opacity))
        }

        .text-gray-700 {
            --text-opacity: 1;
            color: #4a5568;
            color: rgba(74, 85, 104, var(--text-opacity))
        }

        .text-gray-900 {
            --text-opacity: 1;
            color: #1a202c;
            color: rgba(26, 32, 44, var(--text-opacity))
        }

        .underline {
            text-decoration: underline
        }

        .antialiased {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale
        }

        .w-5 {
            width: 1.25rem
        }

        .w-8 {
            width: 2rem
        }

        .w-auto {
            width: auto
        }

        .grid-cols-1 {
            grid-template-columns: repeat(1, minmax(0, 1fr))
        }

        @media (min-width:640px) {
            .sm\:rounded-lg {
                border-radius: .5rem
            }

            .sm\:block {
                display: block
            }

            .sm\:items-center {
                align-items: center
            }

            .sm\:justify-start {
                justify-content: flex-start
            }

            .sm\:justify-between {
                justify-content: space-between
            }

            .sm\:h-20 {
                height: 5rem
            }

            .sm\:ml-0 {
                margin-left: 0
            }

            .sm\:px-6 {
                padding-left: 1.5rem;
                padding-right: 1.5rem
            }

            .sm\:pt-0 {
                padding-top: 0
            }

            .sm\:text-left {
                text-align: left
            }

            .sm\:text-right {
                text-align: right
            }
        }

        @media (min-width:768px) {
            .md\:border-t-0 {
                border-top-width: 0
            }

            .md\:border-l {
                border-left-width: 1px
            }

            .md\:grid-cols-2 {
                grid-template-columns: repeat(2, minmax(0, 1fr))
            }
        }

        @media (min-width:1024px) {
            .lg\:px-8 {
                padding-left: 2rem;
                padding-right: 2rem
            }
        }

        @media (prefers-color-scheme:dark) {
            .dark\:bg-gray-800 {
                --bg-opacity: 1;
                background-color: #2d3748;
                background-color: rgba(45, 55, 72, var(--bg-opacity))
            }

            .dark\:bg-gray-900 {
                --bg-opacity: 1;
                background-color: #1a202c;
                background-color: rgba(26, 32, 44, var(--bg-opacity))
            }

            .dark\:border-gray-700 {
                --border-opacity: 1;
                border-color: #4a5568;
                border-color: rgba(74, 85, 104, var(--border-opacity))
            }

            .dark\:text-white {
                --text-opacity: 1;
                color: #fff;
                color: rgba(255, 255, 255, var(--text-opacity))
            }

            .dark\:text-gray-400 {
                --text-opacity: 1;
                color: #cbd5e0;
                color: rgba(203, 213, 224, var(--text-opacity))
            }

            .dark\:text-gray-500 {
                --tw-text-opacity: 1;
                color: #6b7280;
                color: rgba(107, 114, 128, var(--tw-text-opacity))
            }
        }
    </style>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

        #custom-target {
            position: relative;
            width: 600px;
            height: 300px;
            border-style: solid;
        }

        .position-absolute {
            position: absolute !important;
        }

        h1 {
            font-size: 40px;
        }

        .spanDanger {
            padding: 4px;
            background-color: red;
            color: white;
            border-radius: 10px
        }
    </style>
</head>

<body class="antialiased dark:bg-gray-900 ">



    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 style="color: white">Cadastro de Pessoa</h1>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-end">

                        </div>
                    </div>

                </div>

                <!-- /.container-fluid -->
            </div>
            <div class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-body">
                            <form id="mainForm">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-12 form-group">


                                                <div class="mb-3">
                                                    <label for="">Nome</label>
                                                    <input class="form-control" name="nome" id="nome"
                                                        type="text" placeholder="Nome">
                                                </div>
                                                <div class="mb-3"><label for="">CPF</label>
                                                    <input class="form-control" autocomplete="off" maxlength="14"
                                                        name="cpf" id="cpf" type="text" placeholder="CPF">
                                                </div>
                                                <div class="mb-3"><label for="">Endereço</label>
                                                    <input class="form-control" autocomplete="off" name="endereco"
                                                        id="endereco" type="text" placeholder="Endereço">
                                                </div>
                                                <div id="buttons" class="mb-3 ">
                                                    <button id="enviar" type="button"
                                                        class="btn btn-primary text-center ">Gravar</button>

                                                </div>
                                            </div>
                                        </div>



                                    </div>
                                    <div class="col-md-5">
                                        <h3>Telefones </h3>
                                        <table
                                            class="table table-responsive table-bordered border-success table-striped">
                                            <thead>
                                                <tr class="table-dark">
                                                    <th>Telefone</th>
                                                    <th>Descrição</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cadastraTel">
                                                @for ($a = 1; $a <= 5; $a++)
                                                    <tr>

                                                        <td><input maxlength="15" autocomplete="off"
                                                                onkeyup="formataTel(event)" type="text"
                                                                name="tel{{ $a }}"
                                                                class="form-control telefones"
                                                                placeholder="Telefone {{ $a }}">
                                                        </td>
                                                        <td><input autocomplete="off" type="text"
                                                                name="telDesc{{ $a }}"
                                                                class="form-control telefonesDescricao"
                                                                placeholder="Descrição {{ $a }}">
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>

                                        </table>

                                    </div>
                                    <div class="col-md-1 d-flex column justify-content-center align-items-center">
                                        <label></label>
                                        <button onclick="addTel()" type="button"
                                            class="btn btn-success align-middle"><i class="fas fa-add"></i></button>

                                    </div>
                                </div>
                            </form>


                            <div class="row">
                                <div class="col-md-12">
                                    <h1> Dados Gravados</h1>
                                    <table class="table table-responsive ">
                                        <thead>
                                            <tr class="table-dark">
                                                <th class="text-center">Nome</th>
                                                <th class="text-center">Endereco</th>
                                                <th class="text-center ">CPF</th>
                                                <th class="text-center">Telefone - Descrição</th>
                                                <th class="text-center">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody id="conteudo">

                                            @foreach ($pessoasCadastradas as $pessoa)
                                                <tr id="pessoa{{ $pessoa->id }}">
                                                    <td class="text-center align-middle">{{ $pessoa->nome }}
                                                    </td>
                                                    <td class="text-center align-middle">{{ $pessoa->endereco }}
                                                    </td>
                                                    <td class="text-center  align-middle">
                                                        {{ formata_cpf($pessoa->cpf) }}</td>
                                                    <td class="text-center align middle">
                                                        @if (count($pessoa->telefones) > 0)
                                                            @foreach ($pessoa->telefones as $telefone)
                                                                {{ $telefone->telefone . '-' . $telefone->descricao }}
                                                                <br>
                                                            @endforeach
                                                        @else
                                                            <span class="spanDanger">Nenhum telefone cadastrado</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">

                                                        <button type="button"
                                                            onclick="getPessoa({{ $pessoa->id }})"
                                                            class="btn btn-success"><i
                                                                class="fas fa-edit"></i></button>
                                                        <button onclick="deletePessoa({{ $pessoa->id }})"
                                                            type="button" class="btn btn-danger"><i
                                                                class="far fa-trash-alt"></i></button>
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.
                    container-fluid -->

            </div>
        </div>
        <!-- Modal -->


    </div>

    <!-- Modal -->

    {{-- @include('notify::messages') --}}
    // Laravel 7 or greater
    <x:notify-messages />
    @notifyJs
    <script src="https://kit.fontawesome.com/01659e7f91.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/home.js') }}"></script>
</body>

</html>
