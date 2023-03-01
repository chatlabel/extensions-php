<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Primeira Extensão</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>

  <script src="https://fileschat.sfo2.cdn.digitaloceanspaces.com/public/libs/wlclient.js"></script>

  <style>
    html,
    body {
      height: 100%;
      width: 100%;
    }

    .loader {
      width: 100%; 
      height: 100%; 
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #list-channel > {
      text-align: left;
    }

    .btn-primary{
      background-color: #192d3e;
      border-color: #192d3e;
    }
    .btn-primary:hover{
      background-color: #192d3e;
      border-color: #192d3e;
    }
  </style>
  <script>
    $(document).ready(() => {
      window.WlExtension.initialize({
        buttons: {
          'contacts-list': [
            {
              text: 'Botao Alert',
              callback: (wl) => {
                window.WlExtension.alert({
                  message: 'Mensagem de sucesso',
                  variant: 'success'
                });
              },
            },
            {
              text: 'Botao Confirm',
              callback: (wl) => {
                window.WlExtension.confirmDialog({
                  text: 'Texto...',
                  title: 'Dialog de confirmacao',
                  callback: (confirm) => {
                    console.log(confirm);
                    

                    window.WlExtension
                      .getInfoChannels()
                      .then((data)=> {
                        console.log(data);
                      })
                  }
                })
              },
            },
          ],
          'attendance-view': [
            {
              text: 'Ver Perfil',
              callback: (atendimento) => {
                window.WlExtension.modal({
                  url: `http://localhost/info-atendimento.php?atendimentoId=${atendimento.atendimentoId}`,
                  title: 'Perfil',
                  maxWidth: '500px',
                  height: '300px'
                });
              },
            }
          ],
          'attendance-list': [
            {
              text: 'Lista de ações',
              callback: () => {
                window.WlExtension.modal({
                  title: 'Lista de ações',
                  url: 'http://localhost/extension-demo/acoes.php',
                  maxWidth: '500px'
                });
              },
            }
          ]
        }
      })

      $('.loader').hide();

      $('#buscar-dados').click(() => {
        window.WlExtension.getInfoUser()
          .then((data) => {
            $('#list-organization').text(`Usuário ID: ${data.userId} \n Cód Sistema: ${data.systemKey}`)
          });
      });

      $('#buscar-canais').click(() => {
        window.WlExtension.getInfoChannels()
          .then((channels) => {
            channels.forEach((channel) =>{
              $('#list-channel').append(`<li> ${channel.descricao} | ${channel.status} </li>`);
            });
          });
      });

      $('#buscar-acoes').click(()=>{
        window.WlExtension.modal({
          title: 'Lista de ações',
          url: 'http://localhost/acoes.php',
          maxWidth: '500px'
        });
      });
    });
  </script>
</head>

<body>
  <div style="text-align:center">
    <button id="buscar-dados" class="btn btn-primary my-2"> Buscar dados empresa</button>
    <button id="buscar-canais" class="btn btn-primary my-2"> Buscar dados canais </button>
    <button id="buscar-acoes" class="btn btn-primary my-2"> Lista de funções </button>
  <div>

  <hr>
  <p id="list-organization"></p>
  <hr>
  <ul id="list-channel"></ul>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>
</html>