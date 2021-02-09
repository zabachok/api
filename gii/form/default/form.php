<?php
/**
 * @var $namespace string
 * @var $name string
 * @var $className string
 * @var $fields array
 * @var $labels array
 * @var $forms array
 */
?>
<?= '<?php' ?>

namespace zabachok\api\forms\<?= $namespace ?>;

use zabachok\api\dtos\<?= $namespace ?>\<?=ucfirst($name)?>Dto;
use zabachok\api\forms\NestedForm;
<?php foreach ($forms as $formName): ?>
use zabachok\api\forms\<?= $namespace ?>\<?= $formName ?>\<?= ucfirst($formName) ?>Form;
<?php endforeach; ?>

class <?= $className ?> extends NestedForm
{
<?php foreach ($fields as $field => $validation): ?>
    public $<?= $field ?>;
<?php endforeach; ?>
<?php if($forms): ?>
    public function getForms(): array
    {
        return [
<?php foreach ($forms as $formName): ?>
            '<?= $formName ?>' => <?= ucfirst($formName) ?>Form::class,
<?php endforeach; ?>
        ];
    }
<?php endif; ?>

    public function rules(): array
    {
        return [
<?= $generator->renderRules($fields) ?>
        ];
    }

    public function getDtoName(): string
    {
        return <?=ucfirst($name)?>Dto::class;
    }

    public function attributeLabels(): array
    {
        return [
<?php foreach ($labels as $field => $label): ?>
            '<?= $field ?>' => '<?= $label ?>',
<?php endforeach; ?>
        ];
    }
}
