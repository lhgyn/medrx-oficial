jQuery(document).ready(function($) {
/* BACK TO TOP BUTTON */
    if ( $("#back-to-top").length ) {
        var scrollTrigger = 100;
        var backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $("#back-to-top").addClass("show");
            } else {
                $("#back-to-top").removeClass("show");
            }
            backToTop();

            $(window).on("scroll", function () {
                backToTop();
            });
            $("#back-to-top").on("click", function (e) {
                e.preventDefault();
                $("html,body").animate({
                    scrollTop: 0
                }, 700);
            });
        };
    }
    


/* Collapse on Mobile - adiciona e remove classes onClicks */
    $(".collapse-button").click(function(event) {
        var parent = $(this).attr("data-id");
        $(".card-header").removeClass("collapse-open");
        $(".collapse-icon").removeClass("fa-minus");
        $(".collapse-icon").addClass("fa-plus");
        $("#icon-"+parent).toggleClass("fa-minus");
        $("#"+parent).toggleClass("collapse-open");
    });

/* Carrousel - produtos relacionados - pagina de produto */

        $(".owl-carousel.products").owlCarousel(
            {
                loop:true,
                autoplay: true,
                nav: true,
                navText: [
                    "<i class='fas fa-angle-left icon-nav-product'></i>",
                    "<i class='fas fa-angle-right icon-nav-product'></i>"
                ],
                responsiveClass:true,
                responsive:{
                    0:{
                        items:1,
                        nav:true
                    },
                    600:{
                        items:3,
                        nav:false
                    },
                    1000:{
                        items:6,
                        nav:true,
                        loop:false
                    }
                }
            }
        );

        $(".owl-carousel.slide-home").owlCarousel(
            {
                loop:true,
                center: true,
                items:1,
                nav: true,
                navText: [
                    "<i class='fas fa-angle-left icon-nav-home'></i>",
                    "<i class='fas fa-angle-right icon-nav-home'></i>"
                ],
                responsiveClass: true
            }
        );

/* MÁSCARAS DE CAMPOS E VALIDAÇÕES DO CHECKOUT */

    /**** variaveis para validação de campos */
    var name_hasError = null,
        last_name_hasError = null,
        cpf_hasError = null,
        phone_hasError = null,
        cep_hasError = null;


    /**** MÁSCARAS DE CAMPO */
    var SPMaskBehavior = function (val) {
      return val.replace(/\D/g, "").length === 11 ? "(00) 00000-0000" : "(00) 0000-00009";
    },
    spOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
    $("#billing_cpf").mask("000.000.000-00");
    $("#billing_postcode").mask("00000-000");
    $("#billing_phone").mask(SPMaskBehavior, spOptions);


    /**** VALIDAÇÃO DE NOMES */
    $("#billing_first_name").blur(function(event) {
        var name = $(this).val();
        var len = name.length;
        if(len < 2){
            $("#billing_first_name").css("border-color",  "red");
            name_hasError = 1;
        }
        else{
            $("#billing_first_name").css("border-color",  "limegreen");
            name_hasError = 0;
        }
    });
    $("#billing_last_name").blur(function(event) {
        var lastname = $(this).val();
        var len = lastname.length;
        if(len < 2){
            $("#billing_last_name").css("border-color",  "red");
            last_name_hasError = 1;
        }
        else{
            $("#billing_last_name").css("border-color",  "limegreen");
            last_name_hasError = 0;
        }
    });


    /****** VERIFICAÇÃO DE CPF *****/
    var validaCpf = {
        go: function(cpf){            
            if( cpf.length  > 0 && cpf.length  < 14 ){
                alert("cpf invalido");
                $("#billing_cpf").css("border-color",  "red");
                $("#billing_cpf").val("").focus();
                $("#billing_cpf").attr("placeholder", "Digite seu cpf válido");
                cpf_hasError = 1;
                return;
            }
    
            if( cpf.length  === 14 ) {
                if(valida_cpf_cnpj( cpf )){
                    $("#billing_cpf").css("border-color",  "limegreen");
                    cpf_hasError = 0;
                }else {
                    alert("cpf invalido");
                    $("#billing_cpf").css("border-color",  "red");
                    $("#billing_cpf").val("").focus();
                    $("#billing_cpf").attr("placeholder", "CPF Inválido");
                    cpf_hasError = 1;
                }            
            }
        }
    };


    $("#billing_cpf").focusout(function(event) {
        var cpf = $("#billing_cpf").val();
        console.log("cpf digitado: "+cpf);  
        validaCpf.go(cpf);
    });


    ////////////////////////////
    ///////***** VERIFICAÇÃO DE TELEFONE *****
    ///////////////////    
    var validaPhone = {
        go: function(phone){
            if(phone.length < 14){            
                $("#billing_phone").css("border-color",  "red");
                $("#billing_phone").val("").focus();
                $("#billing_phone").attr("placeholder", "Telefone Inválido"); 
                phone_hasError = 1; 
            }
            else
            {
                $("#billing_phone").css("border-color",  "limegreen");
                phone_hasError = 0;
            }
        }
    };

    // if($("#billing_phone").val() != ""){        
    //     var phone = $("#billing_phone").val(); 
    //     validaPhone.go(phone);
    // }
    $("#billing_phone").change(function(){  
        var phone = $("#billing_phone").val(); 
        validaPhone.go(phone);                
    });

    ////////////////////////////
    ///////***** VERIFICAÇÃO E AUTOCOMPLETE DE CEP *****
    ///////////////////

    var validaCep = {
        go: function(cep, len){
            if(len === 9){
                $.get("https://viacep.com.br/ws/"+cep+"/json", function(data) {
                    if(data.erro == true){
                        $("#billing_postcode").css("border-color",  "red");
                        $("#billing_postcode").attr("placeholder", "Cep Inválido");
                        $("#billing_postcode").val("").focus();
                        return;
                    }
                    autofillCep.go(data);        
                });
            }
        }
    };

    var autofillCep = {
        go: function(data){ 
            $("#billing_postcode").css("border-color",  "limegreen");
    
            $("#billing_address_1").val(data.logradouro);
            $("#billing_address_1").css("border-color",  "limegreen");

            if( $("#billing_number").val() != "" )
                $("#billing_number").css("border-color",  "limegreen");
    
            $("#billing_neighborhood").val(data.bairro);
            $("#billing_neighborhood").css("border-color",  "limegreen");                
                            
            $("#billing_city").css("border-color",  "limegreen");                
            $("#billing_city").val(data.localidade);
    
            $("#billing_state option[value="+data.uf+"]").prop("selected", true); 
            $("#select2-billing_state-container").attr("title", data.uf);
            $("#select2-billing_state-container").html(data.uf);
            $(".select2-selection--single").css("border-color",  "limegreen");
            $("#billing_state option").each(function () {
                if($(this).val() == data.uf){
                    $(this).prop("selected", true);
                }
            });
            cep_hasError = 0;
    
            $("#billing_number").focus();
        }
    };


    $("#billing_postcode").keyup(function(event) {
        var cep = $("#billing_postcode").val();
        var len = cep.length;
        if(len === 9){
            validaCep.go(cep, len);  
        }  
    });


    //var url = window.location.href;
    var url = window.location.href;
    if(url.indexOf('finalizar-compra') >= 0 ){
        
        var name = $("#billing_first_name").val();
        var lastname = $("#billing_first_name").val();
        if( name.length >= 2 ){
            $("#billing_first_name").css("border-color",  "limegreen");
        }
        if( lastname.length >= 2 ){
            $("#billing_last_name").css("border-color",  "limegreen");
        }
         /** Validação de dados quando logado */
         if( $("#billing_cpf").val() != "" ){
            var cpf = $("#billing_cpf").val();
            validaCpf.go(cpf);
        }
        if(  $("#billing_postcode").val() != "" ){        
            var cep = $("#billing_postcode").val();
            var len = cep.length;
            validaCep.go(cep, len);        
        }
        if($("#billing_phone").val() != ""){        
            var phone = $("#billing_phone").val(); 
            validaPhone.go(phone);
        }        
        if($("#billing_email").val() != ""){
            $("#billing_email").css("border-color",  "limegreen");
        }

    }

    // ******* FIM DA VALIDAÇÃO DE CEP *******************


    

    $(".button-tabs").click(function(event) {
        event.preventDefault();
        var item = $(this).attr("id");
        $(".tab-child").hide();
        $("#"+item).show();

        switch ($(this).attr("data-tab")) {
            case "tab-one":
                changeTabs.go( $(this).attr("data-tab"), "#btn-cart", "#btn-two" );
                
                $(".ball").removeClass("active");
                $("#checkout-step1").addClass("active");
                $("#icon-seta-step-left").css("display", "none");
                $("#icon-seta-step-right").css("display", "inline-block");
                $("#btn-two").removeClass("last-step");      
                break;
            case "tab-two":
                validateForm.validate($(this).attr("data-tab"), "#btn-one", "#btn-three");
                
                $(".ball").removeClass("active");
                $("#checkout-step1").addClass("active");
                $("#checkout-step2").addClass("active");

                var endereco = $("#billing_address_1").val();
                var numero = $("#billing_number").val();
                var bairro = $("#billing_neighborhood").val();
                var cidade = $("#billing_city").val();
                var estado = $("#select2-billing_state-container").text();
                
                var string = "<p><strong>Endereço:</strong> "+endereco+"</p> <p><strong>Número:</strong> "+numero+"</p> <p><strong>Bairro:</strong> "+bairro+"</p> <p><strong>Cidade/UF:</strong> "+cidade+"/"+estado+"</p>";
                $("#local-de-entrega").html(string);
                
                break;
            case "tab-three":
                changeTabs.go( $(this).attr("data-tab"), "#btn-two", "#btn-checkout" );                
                
                $(".ball").removeClass("active");
                $("#checkout-step1").addClass("active");
                $("#checkout-step2").addClass("active");
                $("#checkout-step3").addClass("active");
                $("#icon-seta-step-right").css("display", "none");
                $("#icon-seta-step-left").css("display", "inline-block");
                $("#btn-two").addClass("last-step");
                break;
            default:
                alert("erro");
                break;
        }

    });

    var changeTabs = {
        go: function(tab, btnleft, btnright){
            $(".tab-child").hide();
            $("#"+tab).show();
            $("#checkout-step-buttons a").hide();
            $(btnleft).show().css("float", "left"); //$(btnleft);
            $(btnright).show().css("float", "right"); //$(btnright);
        }        
    };

    var validateForm = {
        validate: function(tab, btnleft, btnright){
            changeTabs.go( tab, btnleft, btnright );
            if( $("#checkout-form").attr("data-status") == "loged" ){
               changeTabs.go( tab, btnleft, btnright );
               $("#checkout-step1").addClass("active");
               $("#checkout-step2").addClass("active");
            }else{
                if(name_hasError == 0 && last_name_hasError == 0 && cpf_hasError == 0 && phone_hasError == 0 && cep_hasError == 0){
                    changeTabs.go( tab, btnleft, btnright );
                    $(".ball").removeClass("active");
                    $("#checkout-step1").addClass("active");
                    $("#checkout-step2").addClass("active");
                }
                else{
                    //changeTabs.go( tab, btnleft, btnright )
                    changeTabs.go( "tab-one", "#btn-cart", "#btn-two" );
                    alert("Preencha o formulário corretamente");
                    console.log(
                        {"name":name_hasError, "lastname":last_name_hasError, "cpf":cpf_hasError, "phone":phone_hasError, "cep":cep_hasError}
                    );
                }
            }            
        }
    };


}); // END jQuery



function verifica_cpf_cnpj ( valor ) {

    // Garante que o valor é uma string
    valor = valor.toString();
    
    // Remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, "");

    // Verifica CPF
    if ( valor.length === 11 ) {
        return "CPF";
    } 
    
    // Verifica CNPJ
    else if ( valor.length === 14 ) {
        return "CNPJ";
    } 
    
    // Não retorna nada
    else {
        return false;
    }
    
} // verifica_cpf_cnpj

/*
 calc_digitos_posicoes
 
 Multiplica dígitos vezes posições
 
 @param string digitos Os digitos desejados
 @param string posicoes A posição que vai iniciar a regressão
 @param string soma_digitos A soma das multiplicações entre posições e dígitos
 @return string Os dígitos enviados concatenados com o último dígito
*/
function calc_digitos_posicoes( digitos, posicoes, soma_digitos ) {
    if( posicoes == '' || posicoes == null ){
        posicoes = 10;
    }
    if( soma_digitos == '' || soma_digitos == null ){
        soma_digitos = 0;
    }
    // Garante que o valor é uma string
    digitos = digitos.toString();

    // Faz a soma dos dígitos com a posição
    // Ex. para 10 posições:
    //   0    2    5    4    6    2    8    8   4
    // x10   x9   x8   x7   x6   x5   x4   x3  x2
    //   0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
    for ( var i = 0; i < digitos.length; i++  ) {
        // Preenche a soma com o dígito vezes a posição
        soma_digitos = soma_digitos + ( digitos[i] * posicoes );

        // Subtrai 1 da posição
        posicoes--;

        // Parte específica para CNPJ
        // Ex.: 5-4-3-2-9-8-7-6-5-4-3-2
        if ( posicoes < 2 ) {
            // Retorno a posição para 9
            posicoes = 9;
        }
    }

    // Captura o resto da divisão entre soma_digitos dividido por 11
    // Ex.: 196 % 11 = 9
    soma_digitos = soma_digitos % 11;

    // Verifica se soma_digitos é menor que 2
    if ( soma_digitos < 2 ) {
        // soma_digitos agora será zero
        soma_digitos = 0;
    } else {
        // Se for maior que 2, o resultado é 11 menos soma_digitos
        // Ex.: 11 - 9 = 2
        // Nosso dígito procurado é 2
        soma_digitos = 11 - soma_digitos;
    }

    // Concatena mais um dígito aos primeiro nove dígitos
    // Ex.: 025462884 + 2 = 0254628842
    var cpf = digitos + soma_digitos;

    // Retorna
    return cpf;
    
} // calc_digitos_posicoes

/*
 Valida CPF
 
 Valida se for CPF
 
 @param  string cpf O CPF com ou sem pontos e traço
 @return bool True para CPF correto - False para CPF incorreto
*/
function valida_cpf( valor ) {

    // Garante que o valor é uma string
    valor = valor.toString();
    
    // Remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, "");


    // Captura os 9 primeiros dígitos do CPF
    // Ex.: 02546288423 = 025462884
    var digitos = valor.substr(0, 9);

    // Faz o cálculo dos 9 primeiros dígitos do CPF para obter o primeiro dígito
    var novo_cpf = calc_digitos_posicoes( digitos );

    // Faz o cálculo dos 10 dígitos do CPF para obter o último dígito
    novo_cpf = calc_digitos_posicoes( novo_cpf, 11 );

    // Verifica se o novo CPF gerado é idêntico ao CPF enviado
    if ( novo_cpf === valor ) {
        // CPF válido
        return true;
    } else {
        // CPF inválido
        return false;
    }
    
} // valida_cpf

/*
 valida_cnpj
 
 Valida se for um CNPJ
 
 @param string cnpj
 @return bool true para CNPJ correto
*/
function valida_cnpj ( valor ) {

    // Garante que o valor é uma string
    valor = valor.toString();
    
    // Remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, "");

    
    // O valor original
    var cnpj_original = valor;

    // Captura os primeiros 12 números do CNPJ
    var primeiros_numeros_cnpj = valor.substr( 0, 12 );

    // Faz o primeiro cálculo
    var primeiro_calculo = calc_digitos_posicoes( primeiros_numeros_cnpj, 5 );

    // O segundo cálculo é a mesma coisa do primeiro, porém, começa na posição 6
    var segundo_calculo = calc_digitos_posicoes( primeiro_calculo, 6 );

    // Concatena o segundo dígito ao CNPJ
    var cnpj = segundo_calculo;

    // Verifica se o CNPJ gerado é idêntico ao enviado
    if ( cnpj === cnpj_original ) {
        return true;
    }
    
    // Retorna falso por padrão
    return false;
    
} // valida_cnpj

/*
 valida_cpf_cnpj
 
 Valida o CPF ou CNPJ
 
 @access public
 @return bool true para válido, false para inválido
*/
function valida_cpf_cnpj ( valor ) {

    // Verifica se é CPF ou CNPJ
    var valida = verifica_cpf_cnpj( valor );

    // Garante que o valor é uma string
    valor = valor.toString();
    
    // Remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, "");


    // Valida CPF
    if ( valida === "CPF" ) {
        // Retorna true para cpf válido
        return valida_cpf( valor );
    } 
    
    // Valida CNPJ
    else if ( valida === "CNPJ" ) {
        // Retorna true para CNPJ válido
        return valida_cnpj( valor );
    } 
    
    // Não retorna nada
    else {
        return false;
    }
    
} // valida_cpf_cnpj

/*
 formata_cpf_cnpj
 
 Formata um CPF ou CNPJ

 @access public
 @return string CPF ou CNPJ formatado
*/
function formata_cpf_cnpj( valor ) {

    // O valor formatado
    var formatado = false;
    
    // Verifica se é CPF ou CNPJ
    var valida = verifica_cpf_cnpj( valor );

    // Garante que o valor é uma string
    valor = valor.toString();
    
    // Remove caracteres inválidos do valor
    valor = valor.replace(/[^0-9]/g, "");


    // Valida CPF
    if ( valida === "CPF" ) {
    
        // Verifica se o CPF é válido
        if ( valida_cpf( valor ) ) {
        
            // Formata o CPF ###.###.###-##
            formatado  = valor.substr( 0, 3 ) + ".";
            formatado += valor.substr( 3, 3 ) + ".";
            formatado += valor.substr( 6, 3 ) + "-";
            formatado += valor.substr( 9, 2 ) + "";
            
        }
        
    }
    
    // Valida CNPJ
    else if ( valida === "CNPJ" ) {
    
        // Verifica se o CNPJ é válido
        if ( valida_cnpj( valor ) ) {
        
            // Formata o CNPJ ##.###.###/####-##
            formatado  = valor.substr( 0,  2 ) + ".";
            formatado += valor.substr( 2,  3 ) + ".";
            formatado += valor.substr( 5,  3 ) + "/";
            formatado += valor.substr( 8,  4 ) + "-";
            formatado += valor.substr( 12, 14 ) + "";
            
        }
        
    } 

    // Retorna o valor 
    return formatado;
    
} // formata_cpf_cnpj
