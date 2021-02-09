<?php

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $generator \api\doc\generator\form\Generator */

echo $form->field($generator, 'name');
echo $form->field($generator, 'class');
echo $form->field($generator, 'title');
echo $form->field($generator, 'method')->dropDownList(['GET' => 'GET', 'POST' => 'POST', 'PUT' => 'PUT', 'DELETE' => 'DELETE']);
echo $form->field($generator, 'url');
echo $form->field($generator, 'enums')->textarea()->hint('Поле и класс енума через запятую. field:Enum,field1:Enum');
