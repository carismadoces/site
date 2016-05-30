function formataData(data){
    
    dia = data.getDate();
    mes = data.getMonth()+1;
    
    mes = new String(mes);
    
    if(mes.length < 2) mes = "0"+mes;
    
    ano = data.getFullYear();
    
    return dia+"/"+mes+"/"+ano;

}


function abrirModalSimples(conteudo, titulo){
    $.modal({
        content: conteudo,
        title: titulo,
        maxWidth: 500,
        buttons: {
            'Fechar': function(win) {win.closeModal();}
        }
    });
}

function abrirModalConfirmacao(url){
    $.modal({
        content: 'Deseja Realmente Realizar Essa Operação?',
        title: 'Confirmação',
        maxWidth: 500,
        buttons: {
            'Sim': function() {window.location.href = url},
            'Não': function(win) {win.closeModal();}            
        }
    });
}

function abrirModalConfirmacaoFuncao(){
	
	var argsPai = arguments;
    $.modal({
        content: 'Deseja Realmente Realizar Essa Operação?',
        title: 'Confirmação',
        maxWidth: 500,
        buttons: {
            'Sim': function(win) {
            	callDynamicFunction(argsPai);
            	win.closeModal();
            },
            'Não': function(win) {win.closeModal();}            
        }
    });
}

function callDynamicFunction(){
	var functionToCall = window[arguments[0][0]];
	return functionToCall(arguments[0]);
}

function abrirModalCarregando(conteudo){
    return $.modal({
        content: '<img src="include/images/ajax-loader.gif"/> '+conteudo,
        title: 'Carregango',
        maxWidth: 500,
        closeButton : false
    });
}

function getEndereco() {
    
    if($.trim($("#cepEnd").val()) != ""){
        			
             var winModal = abrirModalCarregando('Carregando Endereço...');                  
                                
            $.getScript("http://cep.republicavirtual.com.br/web_cep.php?formato=javascript&cep="+$("#cepEnd").val(), function(){

                if(resultadoCEP["resultado"] > 0){
                    // troca o valor dos elementos
                    $("#logradouroEnd").val(unescape(resultadoCEP["tipo_logradouro"])+" "+unescape(resultadoCEP["logradouro"]));
                    $("#bairroEnd").val(unescape(resultadoCEP["bairro"]));
                    $("#cidadeEnd").val(unescape(resultadoCEP["cidade"]));
                    $("#estadoEnd").val(unescape(resultadoCEP["uf"]));
                }else{
                    abrirModalSimples('Endereço não encontrado!!!','');
                    winModal.closeModal();                    
                }

                winModal.closeModal();

            });
    }
}

function limitarCampo(campo, limite, campoContador){
    $("#"+campo).keyup(function(){
        var tamanho = $(this).val().length;
        
        if(tamanho > limite)
            tamanho -= 1;
        
        var count = limite - tamanho;
        
        if(count <= 0)
            count = 0;
        
        $("#"+campoContador).text(count);
        
        if(tamanho >= limite){
            $(this).val($(this).val().substring(0, limite));
        }
        
    })
}