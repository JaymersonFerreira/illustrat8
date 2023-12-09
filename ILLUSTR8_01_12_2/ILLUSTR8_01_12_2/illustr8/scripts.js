function onOff() {
  document
    .querySelector("#modal")
    .classList
    .toggle("hide")

  document
    .querySelector("body")
    .classList
    .toggle("hideScroll")

  document
    .querySelector("#modal")
    .classList
    .toggle("addScroll")



}


function previewFoto() {
  var imagem = document.querySelector('input[name=foto]').files[0];
  var preview = document.getElementById('imgFoto');

  var reader = new FileReader();

  reader.onloadend = function () {
      preview.src = reader.result;
  }

  if (imagem) {
      reader.readAsDataURL(imagem);
  } else {
      preview.src = "";
  }
}


function previewImagem() {
  var imagem = document.querySelector('input[name=IMAGEM]').files[0];
  var preview = document.getElementById('imgForm');

  var reader = new FileReader();

  reader.onloadend = function () {
      preview.src = reader.result;
  }

  if (imagem) {
      reader.readAsDataURL(imagem);
  } else {
      preview.src = "";
  }
}

function confirmExclusao(){
		if(confirm("Tem certeza que deseja excluir sua conta?")){
			location.href="excluir_conta.php";
}
}

function confirmExclusaoPost(){
		if(confirm("Tem certeza que deseja excluir este post?")){
			location.href="excluirPost.php";
}
}

function confirmExclusaoComentario(){
		if(confirm("Tem certeza que deseja excluir este comentário?")){
			location.href="excluirComentario.php";
}
}

//desativa o botão direito do mouse
document.onmousedown=disableclick;
function disableclick(event)
{
  if(event.button==2)
   {
     return false;    
   }
}

//desativa o arrastar imagem
function myGeeks() {
  $('#img').attr('draggable', false);
}