<form id="registroForm" name="registroForm" action="" method="post" class="">
    <fieldset style="padding-top: 15px">
        <legend>Registro</legend>
        <span style="margin-left:44%"> <strong style="color:red">*</strong>campos obligatorios</span>
        
        <label for="email">Email:<strong style="color:red">*</strong></label>
        <?php echo $form['email']->render(array('class' => 'input-large')) ?>
        
        <label for="contrasena">Contrasena:<strong style="color:red">*</strong></label>
        <?php echo $form['contrasena']->render(array('class' => 'input-large')) ?>
        
        <span> <strong>Te ha recomendado un amigo? </strong></span>
        <label for="padrino">Escribe aqui su email:</label>
        <?php echo $form['emailPadrino']->render(array('class' => 'input-large')) ?>
        
        <button type="submit" class="btn pull-right">Registrate</button>
        <?php echo $form->renderHiddenFields() ?>
    </fieldset>
</form>
