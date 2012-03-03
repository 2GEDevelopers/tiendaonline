<?php use_javascript('ketchup/jquery.ketchup.all.min.js') ?>
<?php use_stylesheet('ketchup/jquery.ketchup.css') ?>

<style>
    .errorSpan{
        padding-left: 0px;
        color:#da3236;      
    }

    .inputError{
        border-width: 2px;
        border-color: #da3236;        
    }

    .inputValido{
        border-width: 2px;
        border-color: #38b021; 
    }

</style>

<form id="registroForm" name="registroForm" action="" method="post" class="">
    <fieldset style="padding-top: 15px">
        <legend>Registro</legend>
        <span style="margin-left:44%"> <strong style="color:red">*</strong>campos obligatorios</span>

        <label for="email">Email:<strong style="color:red">*</strong></label>
        <?php echo $form['email']->render(array('class' => 'input-large', 'data-validate' => "validate(required, email)")) ?>
        <?php if ($form['email']->hasError()): ?>
            <span class="help-inline errorSpan"><strong><?php echo $form['email']->getError() ?></strong></span>
        <?php endif; ?>

        <label for="contrasena">Contrasena:<strong style="color:red">*</strong></label>
        <?php echo $form['contrasena']->render(array('class' => 'input-large', 'data-validate' => "validate(required, minlength(4))")) ?>
        <?php if ($form['contrasena']->hasError()): ?>
            <span class="help-inline errorSpan"><strong><?php echo $form['contrasena']->getError() ?></strong></span>
        <?php endif; ?>


        <label><strong>Te ha recomendado un amigo? </strong></label>
        <label for="padrino">Escribe aqui su email:</label>
        <?php echo $form['emailPadrino']->render(array('class' => 'input-large', 'data-validate' => "validate(emailInvalido)")) ?>
        <?php if ($form['emailPadrino']->hasError()): ?>
            <span class="help-inline errorSpan"><strong><?php echo $form['emailPadrino']->getError() ?></strong></span>
            <br>
        <?php endif; ?>
        <!-- Padrino no encontrado  -->
        <?php if ($sf_user->getFlash('401')): ?>
            <span class="help-inline errorSpan"><strong><?php echo $sf_user->getFlash('401') ?></strong></span>
            <br>
        <?php endif; ?>

        <button type="submit" class="btn pull-right">Registrate</button>
        <?php echo $form->renderHiddenFields() ?>
    </fieldset>
</form>

<script>
    
    /*$(document).ready(function() {
        var mensaje = 'hola';
    });*/
    
    //personalizar mensajes de ketchup
    $.ketchup.messages({
        required : 'Campo Obligatorio',
        email    : 'Email invalido',
        minlength: 'Tiene que ser mayor a {arg1} caracteres'
    });
    
    //validacion del email de padrino
    $.ketchup.validation('emailInvalido', 'Email Invalido' ,function(form, el, value) {

        if(value.length > 0) {
            if(this.isEmail(value)){     
                return true;
            }else {    
                return false;
            }
        } else {
            return true;
        }
    });

    
    $('#registroForm')
    .bind('fieldIsInvalid', function(event, form, el) {
        //do whatever if a field is invalid
        //form - the form where the el is located (jQuery Object)
        //el   - the element that is invalid (jQuery Object)
        el.removeClass('inputValido');
        el.addClass('inputError');
    })
    .bind('formIsValid', function(event, form) {
        //do whatever when the form is valid
        //form - the form that is valid (jQuery Object)
    })
    .bind('fieldIsValid', function(event, form, el) {
        //do whatever if a field is invalid
        //form - the form where the el is located (jQuery Object)
        //el   - the element that is invalid (jQuery Object)
        if((el.attr('id') == 'usuario_emailPadrino') && (el.val().length == 0)){      
            el.removeClass('inputValido');
            el.removeClass('inputError');
        }else{
            el.removeClass('inputError');
            el.addClass('inputValido');   
        }
    })
    .ketchup();
    
    //TODO edward: validar emails via ajax
    /*$('#registroForm').live('submit', function(){
        
        var email = $('#usuario_email').val();
        alert(email);
        
        $.ajax({
            url: 'http://www.tiendaonline.com.localhost/frontend.php/usuario/' + email,
            dataType: 'json',
            type: 'POST',
            success: function(data) {    
              
            }, 
            error: function(){
                alert('Algo anda mal');
            }           
        });
        
    });*/

</script>
