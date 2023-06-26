document.querySelector("#deleteUser")?.addEventListener("click", function()
{
    fetch('app/model/User.php?action=delete')
    .then(response => response.json())
    .then(data => {
        console.log(data);
        alert('deletado');

        window.location.href = 'index.php';
    })
    .catch(error => {
        console.log(error);
        alert('Ocorreu um erro, ao excluir usuario');
    });
});

var contador = 1;
document.querySelector("#add-mais-telefone")?.addEventListener("click", function()
{
    var divOriginal = document.querySelector('.div-telefone');

    var divClonada = divOriginal.cloneNode(true);

    contador++;

    var cont_atual = contador - 1;
    var nome_ddd = '[name^="telefone['+(cont_atual)+'][ddd]"]';
    var nome_numero = '[name^="telefone['+(cont_atual)+'][numero]"]';

    divClonada.querySelectorAll(nome_ddd).forEach(function(elemento)
    {
        var name_atual = 'telefone['+(cont_atual)+'][ddd]';
        var novo_name = 'telefone['+(contador)+'][ddd]';
        var novoNome = elemento.getAttribute('name').replace(name_atual, novo_name);
        elemento.setAttribute('name', novoNome);
    });

    divClonada.querySelectorAll(nome_numero).forEach(function(elemento)
    {
        var name_atual = 'telefone['+(cont_atual)+'][numero]';
        var novo_name = 'telefone['+(contador)+'][numero]';
        var novoNome = elemento.getAttribute('name').replace(name_atual, novo_name);
        elemento.setAttribute('name', novoNome);
    });

    // Adiciona a div clonada ao documento
    document.querySelector("#container-telefone").appendChild(divClonada);
});

document.querySelectorAll(".deletePessoa")?.forEach(deletePessoa =>
    deletePessoa.addEventListener("click", function(e)
    {
        var id = e.target.dataset.id;
        fetch('app/model/Pessoa.php?action=delete',
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `id=${id}`,
          })
          .then(response => response.json())
          .then(data => {
              console.log(data);
              alert('deletado');
  
              window.location.href = 'listar-pessoa.php';
          })
          .catch(error => {
              console.log(error);
              alert('Ocorreu um erro, ao excluir usuario');
          });
    })
);